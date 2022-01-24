<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    // Table name
    protected $table = 'post_images';

    // Updated fields
    protected $fillable = [
        'post_id', 'position_id', 'img', 'width', 'height', 'size', 'user_id',
    ];

    // Relationship with post one to one
    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'post_id');
    }
}
