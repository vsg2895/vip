<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostsExternalLinks extends Model
{
    protected $fillable = [

        'link','post_id'
    ];
}
