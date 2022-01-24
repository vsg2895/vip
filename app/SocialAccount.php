<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    // Table name
    protected $table = 'social_accounts';

    // Updated fields
    protected $fillable = [
        'url', 'icon'
    ];
}
