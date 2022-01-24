<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FilterSpecialOption;
use App\Category;

class FilterSpecial extends Model
{
    // Table name
    protected $table = 'filter_specials';

    // Updated fields
    protected $fillable = [
        'category_id', 'position_id', 'title_en', 'title_ru', 'title_hy', 'img'
    ];

    // Relationship with category many to one
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'catgory_id');
    }

    // Relationship with option one to many
    public function option()
    {
        return $this->hasOne(FilterSpecialOption::class, 'special_id', 'id');
    }
}
