<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SparePartModel extends Model
{
    // Table name
//    protected $table = 'spare_part_models';

    // Updated fields
    protected $fillable = [
        'title_en', 'title_ru','title_hy', 'img'
    ];

    // Relationship with model-types one to many
    public function model_types()
    {
        return $this->hasMany(SparePartModelType::class, 'model_id', 'id');
    }

}
