<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    // Table name
    protected $table = 'ads';

    // Updated fields
    protected $fillable = [
        'url', 'type', 'img'
    ];
}
