<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SparePartModelType extends Model
{
    // Table name
    protected $table = 'spare_part_model_types';

    // Updated fields
    protected $fillable = [
        'title_en', 'title_ru','title_hy','model_id'
    ];

    // Relationship in type with model one to one
    public function type_model()
    {
        return $this->hasOne(SparePartModel::class, 'id', 'model_id');
    }
}
