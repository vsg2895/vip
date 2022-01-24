<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\SparePartsStore;

class WishlistPost extends Model
{
    // Table name
    protected $table = 'wishlist_posts';

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

    public function spare_post()
    {
        return $this->hasMany(SparePartsStore::class, 'id', 'post_id');
    }
}
