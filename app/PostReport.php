<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostReport extends Model
{
    protected $fillable = [
        'post_id', 'user_id', 'name', 'email', 'description'
     ];

     // Relationship with post one to one
     public function post()
     {
         return $this->hasOne(Post::class, 'id', 'post_id');
     }

}
