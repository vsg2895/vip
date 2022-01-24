<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    // Table name
    protected $table = 'translations';

    // Updated fields
    protected $fillable = [
        'locale', 'selector', 'translation'
    ];
}
