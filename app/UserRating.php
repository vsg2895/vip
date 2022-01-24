<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserRating extends Model
{
    // Table name
    protected $table = 'user_ratings';

    // Updated fields
    protected $fillable = [
        'rater_user_id', 'user_id', 'rate'
    ];

    // Relationship with user one to one
    public function rater_user()
    {
        return $this->hasOne(User::class, 'id', 'rater_user_id');
    }

    // Relationship with user one to one
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
