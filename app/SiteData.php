<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteData extends Model
{
    // Table name
    protected $table = 'site_data';

    // Updated fields
    protected $fillable = [
        'name_en', 'name_ru', 'name_hy', 'header_logo', 'footer_logo', 'favicon', 'loader', 'email', 'phone', 'map'
    ];
}
