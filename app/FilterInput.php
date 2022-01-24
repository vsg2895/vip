<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\FilterInputOption;
use App\InputUnit;
use App\PostOption;

class FilterInput extends Model
{
    // Table name
    protected $table = 'filter_inputs';

    // Updated fields
    protected $fillable = [
        'category_id', 'position_id', 'title_en', 'title_ru', 'title_hy', 'type', 'has_placeholder'
    ];

    // Relationship with category many to one
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'catgory_id');
    }

    // Relationship with option one to many
    public function option()
    {
        return $this->hasMany(FilterInputOption::class, 'filter_input_id', 'id');
    }

    // Relationship with unit one to one
    public function unit()
    {
        return $this->hasOne(InputUnit::class, 'id', 'unit_id');
    }

    // Relationship with post option one to one
    public function post_option()
    {
        return $this->hasOne(PostOption::class, 'option_id', 'id');
    }
}
