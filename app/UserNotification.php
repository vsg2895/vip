<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserNotification extends Model
{
    // Table name
    protected $table = 'user_notifications';

    // Updated fields
    protected $fillable = [
        'user_id', 'new_messages', 'wished_posts', 'wished_users', 'wished_searchs', 'new_reviews', 'remembers', 'website_updates'
    ];

    // Relationship with user one to one
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
