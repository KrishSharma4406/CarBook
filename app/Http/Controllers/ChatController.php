<?php

namespace App\Http\Controllers;

use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\RideBooking;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChatController extends Controller
{
    /**
     * Chat inbox — list all conversations
     */
    public function index()
    {
        $userId = Auth::id();

        $conversations = ChatConversation::where('offerer_id', $userId)
            ->orWhere('booker_id', $userId)
            ->with(['offerer', 'booker', 'ride', 'latestMessage'])
            ->orderByDesc('last_message_at')
            ->get();

        // Attach unread count and other user info
        $conversations->each(function ($conversation) use ($userId) {
            $conversation->unread_count = $conversation->unreadCount($userId);
            $conversation->other_user = $conversation->getOtherUser($userId);
        });

        return view('frontend.webviews.chat', compact('conversations'));
    }

    /**
     * Show a specific conversation
     */
    public function show(ChatConversation $conversation)
    {
        $userId = Auth::id();

        if (!$conversation->isParticipant($userId)) {
            abort(403);
        }

        // Load relationships
        $conversation->load(['offerer', 'booker', 'ride']);

        // Get all conversations for sidebar
        $conversations = ChatConversation::where('offerer_id', $userId)
            ->orWhere('booker_id', $userId)
            ->with(['offerer', 'booker', 'ride', 'latestMessage'])
            ->orderByDesc('last_message_at')
            ->get();

        $conversations->each(function ($conv) use ($userId) {
            $conv->unread_count = $conv->unreadCount($userId);
            $conv->other_user = $conv->getOtherUser($userId);
        });

        // Get messages visible to this user
        $messages = $conversation->messages()
            ->visibleTo($userId)
            ->with('sender')
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark messages as read
        $conversation->messages()
            ->where('sender_id', '!=', $userId)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

        $otherUser = $conversation->getOtherUser($userId);

        return view('frontend.webviews.chat', compact(
            'conversations',
            'conversation',
            'messages',
            'otherUser'
        ));
    }

    /**
     * Start a conversation from a ride booking
     */
    public function startConversation(RideBooking $rideBooking)
    {
        $userId = Auth::id();
        $ride = $rideBooking->ride;

        // The offerer is the ride creator, the booker is the booking user
        $offererId = $ride->user_id;
        $bookerId = $rideBooking->user_id;

        // Only the offerer or booker can start a conversation
        if ($userId != $offererId && $userId != $bookerId) {
            abort(403);
        }

        // Find existing or create new conversation
        $conversation = ChatConversation::firstOrCreate(
            [
                'ride_id' => $ride->id,
                'offerer_id' => $offererId,
                'booker_id' => $bookerId,
            ],
            [
                'last_message_at' => now(),
            ]
        );

        return redirect()->route('chat.show', $conversation);
    }

    /**
     * Send a text message
     */
    public function sendMessage(Request $request, ChatConversation $conversation)
    {
        $userId = Auth::id();

        if (!$conversation->isParticipant($userId)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'message' => 'required_without:attachment|nullable|string|max:5000',
            'attachment' => 'nullable|file|max:10240', // 10MB max
        ]);

        $data = [
            'conversation_id' => $conversation->id,
            'sender_id' => $userId,
            'message' => $request->message,
        ];

        // Handle attachment
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/chat-attachments'), $filename);

            $data['attachment_path'] = '/uploads/chat-attachments/' . $filename;
            $data['attachment_name'] = $file->getClientOriginalName();
            $data['attachment_type'] = $file->getClientMimeType();
        }

        $message = ChatMessage::create($data);

        // Update conversation timestamp
        $conversation->update(['last_message_at' => now()]);

        // Load sender
        $message->load('sender');

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $message->id,
                'message' => $message->message,
                'sender_id' => $message->sender_id,
                'sender_name' => $message->sender->name,
                'sender_avatar' => strtoupper(substr($message->sender->name, 0, 1)),
                'attachment_path' => $message->attachment_path,
                'attachment_name' => $message->attachment_name,
                'attachment_type' => $message->attachment_type,
                'is_image' => $message->isImage(),
                'is_read' => $message->is_read,
                'time' => $message->formattedTime(),
                'date' => $message->formattedDate(),
                'created_at' => $message->created_at->toISOString(),
            ],
        ]);
    }

    /**
     * Fetch messages for polling (AJAX)
     */
    public function fetchMessages(Request $request, ChatConversation $conversation)
    {
        $userId = Auth::id();

        if (!$conversation->isParticipant($userId)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $query = $conversation->messages()
            ->visibleTo($userId)
            ->with('sender');

        // If 'after' parameter is provided, only fetch new messages
        if ($request->has('after')) {
            $query->where('id', '>', $request->after);
        }

        $messages = $query->orderBy('created_at', 'asc')->get();

        // Check for read status updates on sent messages
        $readUpdates = [];
        if ($request->has('check_read')) {
            $readUpdates = $conversation->messages()
                ->where('sender_id', $userId)
                ->where('is_read', true)
                ->where('read_at', '>=', Carbon::now()->subSeconds(10))
                ->pluck('id')
                ->toArray();
        }

        return response()->json([
            'messages' => $messages->map(function ($message) {
                return [
                    'id' => $message->id,
                    'message' => $message->message,
                    'sender_id' => $message->sender_id,
                    'sender_name' => $message->sender->name,
                    'sender_avatar' => strtoupper(substr($message->sender->name, 0, 1)),
                    'attachment_path' => $message->attachment_path,
                    'attachment_name' => $message->attachment_name,
                    'attachment_type' => $message->attachment_type,
                    'is_image' => $message->isImage(),
                    'is_read' => $message->is_read,
                    'time' => $message->formattedTime(),
                    'date' => $message->formattedDate(),
                    'created_at' => $message->created_at->toISOString(),
                ];
            }),
            'read_updates' => $readUpdates,
        ]);
    }

    /**
     * Mark all messages in conversation as read
     */
    public function markAsRead(ChatConversation $conversation)
    {
        $userId = Auth::id();

        if (!$conversation->isParticipant($userId)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $updated = $conversation->messages()
            ->where('sender_id', '!=', $userId)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

        return response()->json(['success' => true, 'updated' => $updated]);
    }

    /**
     * Delete a message for the current user
     */
    public function deleteMessage(ChatMessage $message)
    {
        $userId = Auth::id();
        $conversation = $message->conversation;

        if (!$conversation->isParticipant($userId)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($message->sender_id == $userId) {
            $message->update(['deleted_for_sender' => true]);
        } else {
            $message->update(['deleted_for_receiver' => true]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Search conversations (AJAX)
     */
    public function searchConversations(Request $request)
    {
        $userId = Auth::id();
        $search = $request->get('q', '');

        $conversations = ChatConversation::where(function ($query) use ($userId) {
                $query->where('offerer_id', $userId)
                      ->orWhere('booker_id', $userId);
            })
            ->with(['offerer', 'booker', 'ride', 'latestMessage'])
            ->get()
            ->filter(function ($conversation) use ($search, $userId) {
                $otherUser = $conversation->getOtherUser($userId);
                return str_contains(strtolower($otherUser->name), strtolower($search))
                    || str_contains(strtolower($conversation->ride->destination ?? ''), strtolower($search))
                    || str_contains(strtolower($conversation->ride->pickup_location ?? ''), strtolower($search));
            })
            ->values();

        $conversations->each(function ($conv) use ($userId) {
            $conv->unread_count = $conv->unreadCount($userId);
            $conv->other_user = $conv->getOtherUser($userId);
        });

        return response()->json(['conversations' => $conversations]);
    }

    /**
     * Get unread message count (AJAX for nav badge)
     */
    public function unreadCount()
    {
        $count = Auth::user()->unreadChatCount();
        return response()->json(['count' => $count]);
    }

    /**
     * Upload attachment (AJAX)
     */
    public function uploadAttachment(Request $request, ChatConversation $conversation)
    {
        $userId = Auth::id();

        if (!$conversation->isParticipant($userId)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'attachment' => 'required|file|max:10240',
        ]);

        $file = $request->file('attachment');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/chat-attachments'), $filename);

        $message = ChatMessage::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $userId,
            'message' => null,
            'attachment_path' => '/uploads/chat-attachments/' . $filename,
            'attachment_name' => $file->getClientOriginalName(),
            'attachment_type' => $file->getClientMimeType(),
        ]);

        $conversation->update(['last_message_at' => now()]);
        $message->load('sender');

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $message->id,
                'message' => $message->message,
                'sender_id' => $message->sender_id,
                'sender_name' => $message->sender->name,
                'sender_avatar' => strtoupper(substr($message->sender->name, 0, 1)),
                'attachment_path' => $message->attachment_path,
                'attachment_name' => $message->attachment_name,
                'attachment_type' => $message->attachment_type,
                'is_image' => $message->isImage(),
                'is_read' => false,
                'time' => $message->formattedTime(),
                'date' => $message->formattedDate(),
                'created_at' => $message->created_at->toISOString(),
            ],
        ]);
    }
}
