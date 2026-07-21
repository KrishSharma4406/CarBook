<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatConversation extends Model
{
    protected $fillable = [
        'ride_id',
        'offerer_id',
        'booker_id',
        'last_message_at',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    public function offerer()
    {
        return $this->belongsTo(User::class, 'offerer_id');
    }

    public function booker()
    {
        return $this->belongsTo(User::class, 'booker_id');
    }

    public function ride()
    {
        return $this->belongsTo(Ride::class);
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class, 'conversation_id');
    }

    public function latestMessage()
    {
        return $this->hasOne(ChatMessage::class, 'conversation_id')->latestOfMany();
    }

    /**
     * Scope: conversations for a given user (as offerer or booker)
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('offerer_id', $userId)
                     ->orWhere('booker_id', $userId);
    }

    /**
     * Get the other participant in the conversation
     */
    public function getOtherUser($userId)
    {
        return $this->offerer_id == $userId ? $this->booker : $this->offerer;
    }

    /**
     * Count unread messages for a specific user
     */
    public function unreadCount($userId)
    {
        return $this->messages()
            ->where('sender_id', '!=', $userId)
            ->where('is_read', false)
            ->when($userId == $this->offerer_id, function ($q) {
                $q->where('deleted_for_receiver', false);
            })
            ->when($userId == $this->booker_id, function ($q) {
                $q->where('deleted_for_receiver', false);
            })
            ->count();
    }

    /**
     * Check if user is a participant
     */
    public function isParticipant($userId)
    {
        return $this->offerer_id == $userId || $this->booker_id == $userId;
    }
}
