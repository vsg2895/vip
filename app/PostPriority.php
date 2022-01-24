<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostPriority extends Model
{
    // Table name
    protected $table = 'post_priorities';

    // Updated fields
    protected $fillable = [
       'type', 'price', 'title_en', 'title_ru', 'title_hy'
    ];
}
