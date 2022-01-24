<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class WishlistUser extends Model
{
    // Table name
    protected $table = 'wishlist_users';

    // Updated fields
    protected $fillable = [
        'user_id', 'wished_user_id'
    ];

    // Relationship with user one to one
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    // Relationship with user one to one
    public function wished_user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
