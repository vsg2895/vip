<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ChayUserMessage;

class ChatMessage extends Model
{
    // Table name
    protected $table = 'chat_messages';

    // Updated fields
    protected $fillable = [
        'parent_id', 'message', 'type'
    ];

    // Relationship with user message many to one
    public function user_message()
    {
        return $this->hasOne(ChatUserMessage::class, 'message_id', 'id');
    }
}
