<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SparePartModel;

class SpareOptions extends Model
{
    protected $datas = [
        'post_id','brand_spare','model_spare','min_year_spare','max_year_spare'
    ];

    public function get_brand(){

        return $this->hasOne(SparePartModel::class, 'id', 'brand_spare');
    }
    public function get_model(){

        return $this->hasOne(SparePartModelType::class, 'id', 'model_spare');
    }
}
