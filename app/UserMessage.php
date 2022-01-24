<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserMessage extends Model
{
   // Table name
   protected $table = 'user_messages';

    // Updated fields
    protected $fillable = [
       'geter_id', 'sender_id', 'name', 'email', 'description'
    ];

    // Relationship with user one to one
    public function geter()
    {
        return $this->hasOne(User::class, 'id', 'geter_id');
    }

    // Relationship with user one to one
    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }
}
