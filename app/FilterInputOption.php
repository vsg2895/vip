<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FilterInput;

class FilterInputOption extends Model
{
    // Table name
    protected $table = 'filter_input_options';

    // Updated fields
    protected $fillable = [
        'filter_input_id', 'position_id', 'title_en', 'title_ru', 'title_hy'
    ];

    // Relationship with category many to one
    public function input()
    {
        return $this->hasOne(FilterInput::class, 'id', 'input_id');
    }
}
