<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\FilterInput;

class PostOption extends Model
{
    // Table name
    protected $table = 'post_options';

    // Updated fields
    protected $fillable = [
       'post_id', 'position_id', 'user_id', 'key_en', 'key_ru', 'key_hy', 'value_en', 'value_ru', 'value_hy'
    ];

    // Relationship with options one to one
    public function option()
    {
        return $this->hasOne(FilterInput::class, 'id', 'option_id');
    }

     // Relationship with post one to one
     public function post()
     {
         return $this->hasOne(Post::class, 'id', 'post_id');
     }
}
