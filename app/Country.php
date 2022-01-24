<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    // Table name
    protected $table = 'countries';

    // Updated fields
    protected $fillable = [
        'flag', 'code', 'name_en', 'name_ru', 'name_hy'
    ];
}
