<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = [
        'conversation_id',
        'sender_id',
        'message',
        'attachment_path',
        'attachment_name',
        'attachment_type',
        'is_read',
        'read_at',
        'deleted_for_sender',
        'deleted_for_receiver',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'deleted_for_sender' => 'boolean',
        'deleted_for_receiver' => 'boolean',
    ];

    public function conversation()
    {
        return $this->belongsTo(ChatConversation::class, 'conversation_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Scope: unread messages
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope: messages visible to a specific user
     */
    public function scopeVisibleTo($query, $userId)
    {
        return $query->where(function ($q) use ($userId) {
            $q->where(function ($sub) use ($userId) {
                // User is the sender — hide if deleted_for_sender
                $sub->where('sender_id', $userId)
                    ->where('deleted_for_sender', false);
            })->orWhere(function ($sub) use ($userId) {
                // User is the receiver — hide if deleted_for_receiver
                $sub->where('sender_id', '!=', $userId)
                    ->where('deleted_for_receiver', false);
            });
        });
    }

    /**
     * Check if attachment is an image
     */
    public function isImage()
    {
        if (!$this->attachment_type) return false;
        return str_starts_with($this->attachment_type, 'image/');
    }

    /**
     * Check if the message has an attachment
     */
    public function hasAttachment()
    {
        return !empty($this->attachment_path);
    }

    /**
     * Get formatted time
     */
    public function formattedTime()
    {
        return $this->created_at->format('h:i A');
    }

    /**
     * Get formatted date for date separators
     */
    public function formattedDate()
    {
        if ($this->created_at->isToday()) return 'Today';
        if ($this->created_at->isYesterday()) return 'Yesterday';
        return $this->created_at->format('M d, Y');
    }
}
