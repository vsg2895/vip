<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    // Table name
    protected $table = 'locations';

    // Updated fields
    protected $fillable = [
        'title_en', 'title_ru', 'title_hy', 'parent_id'
    ];
}
