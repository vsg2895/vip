<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class BlockedUser extends Model
{
    // Table name
    protected $table = 'blocked_users';

    // Updated fields
    protected $fillable = [
        'blocker_user_id', 'blocked_user_id'
    ];

    // Relationship with user many to one
    public function blocker_user()
    {
        return $this->hasOne(User::class, 'id', 'blocker_user_id');
    }

    // Relationship with user many to one
    public function blocked_user()
    {
        return $this->hasOne(User::class, 'id', 'blocked_user_id');
    }
}
