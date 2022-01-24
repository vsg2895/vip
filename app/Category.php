<?php

namespace App;

use App\FilterInput;
use Illuminate\Database\Eloquent\Model;
//use App\FilterInput;
use App\FilterSpecial;

class Category extends Model
{
    // Table name
    protected $table = 'categories';

    // Updated fields
    protected $fillable = [
        'title_en', 'title_ru', 'title_hy', 'parent_id', 'has_subcategory', 'heading', 'img', 'position_id', 'top'
    ];

    // Relationship with special one to many
    public function special()
    {
        return $this->hasMany(FilterSpecial::class, 'category_id', 'id');
    }

    // Relationship with input one to many
    public function input()
    {
        return $this->hasMany(FilterInput::class, 'category_id', 'id');
    }

    public function brand_input()
    {
        return $this->input()->where('id','=', 1);
    }

//    public function childrens()
//    {
//        return $this->hasOne(Categories::class, 'parent_id', 'id');
//    }
}
