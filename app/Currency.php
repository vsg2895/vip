<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    // Table name
    protected $table = 'currencies';

    // Updated fields
    protected $fillable = [
        'type', 'value', 'name_en', 'name_ru', 'name_hy', 'simbol'
    ];
}