<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageOriginal extends Model
{
    // Table name
    protected $table = 'image_originals';

    // Updated fields
    protected $fillable = [
        'name'
    ];
}
