<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ChatMessage;

class ChatUserMessage extends Model
{
    // Table name
    protected $table = 'chat_user_messages';

    // Updated fields
    protected $fillable = [
        'message_id', 'sender_id', 'receiver_id', 'type', 'seen_status', 'delever_status'
    ];

    // Relationship with sender user many to one
    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }

    // Relationship with receiver user many to one
    public function receiver()
    {
        return $this->hasOne(User::class, 'id', 'receiver_id');
    }

    // Relationship with message many to one
    public function message()
    {
        return $this->hasOne(ChatMessage::class, 'id', 'message_id');
    }
}
