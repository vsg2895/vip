<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    // Table name
    protected $table = 'references';

    // Updated fields
    protected $fillable = [
        'name_en', 'name_ru', 'name_hy', 'description_en', 'description_ru', 'description_hy'
    ];
}
