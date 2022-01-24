<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    // Table name
    protected $table = 'seos';

    // Updated fields
    protected $fillable = [
        'title_en', 'title_ru', 'title_hy', 'description_en', 'description_ru', 'description_hy',  'keyword_en', 'keyword_ru', 'keyword_hy', 'img', 'route'
    ];
}
