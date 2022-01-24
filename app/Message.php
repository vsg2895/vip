<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // Table name
    protected $table = 'messages';

    // Updated fields
    protected $fillable = [
        'name', 'email', 'phone', 'message'
    ];
}
