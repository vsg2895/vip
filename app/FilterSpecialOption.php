<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FilterSpecial;

class FilterSpecialOption extends Model
{
    // Table name
    protected $table = 'filter_specials';

    // Updated fields
    protected $fillable = [
        'category_id', 'position_id', 'title_en', 'title_ru', 'title_hy', 'img'
    ];

    // Relationship with special many to one
    public function special()
    {
        return $this->hasOne(FilterSpecial::class, 'id', 'special_id');
    }
}
