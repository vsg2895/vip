<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InputUnit extends Model
{
    // Table name
    protected $table = 'input_units';

    // Updated fields
    protected $fillable = [
        'title_en', 'title_ru', 'title_hy'
    ];
}
