<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Post;

class WishlistSearch extends Model
{
    // Table name
    protected $table = 'wishlist_searches';

    // Updated fields
    protected $fillable = [
        'user_id', 'post_id'
    ];

    // Relationship with user one to one
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    // Relationship with post one to many
    public function post()
    {
        return $this->hasMany(Post::class, 'id', 'post_id');
    }
}
