<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SparePartsStore extends Model
{
    protected $fillable = [
        'code', 'category_id','width', 'height', 'size', 'user_id', 'title', 'desc_spare', 'img', 'model_spare', 'min_year_spare', 'max_year_spare', 'currency_id', 'video_url', 'video_process','video_price','original', 'new', 'location_id', 'address', 'price', 'phone', 'active', 'brand_spare','updates'
    ];
//    public function image()
//    {
//        return $this->hasMany(PostImage::class, 'post_id', 'id');
//    }
    // Relationship with currecny one to one
    public function currency()
    {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }

    // Relationship with user one to one
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    // Relationship with wishlist one to one
    public function wishlist()
    {
        return $this->hasOne(WishlistPost::class, 'post_id', 'id');
    }

    // Relationship with locations one to one
    public function location()
    {
        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    // Relationship with brand one to one
    public function get_brand()
    {
        return $this->hasOne(SparePartModel::class, 'id', 'brand_spare');
    }

    // Relationship with model one to one
    public function get_model()
    {
        return $this->hasOne(SparePartModelType::class, 'id', 'model_spare');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function links()
    {
        return $this->hasMany(PostsExternalLinks::class, 'post_id', 'id');
    }

    public function options()
    {
        return $this->hasMany(SpareOptions::class, 'post_id', 'id');
    }

    public static function check_spare_years($all_keys, $request, $all_models)
    {
        $years_data = [];
        foreach ($all_keys as $key) {
            if (strpos($key, 'spare_store_year_start-') !== FALSE || strpos($key, 'spare_store_year_end-') !== FALSE) { // Isset correctly years request fields
                $year_number_by_model = explode('-', $key);
                if (in_array($year_number_by_model[1], $all_models)) {
                    array_push($years_data, $request->$key);
                } else {
                    return false;
                }
            }
        }
        if (count($years_data) > 0) {
            foreach ($years_data as $elem) {
                if ((int)$elem === 0) {
                    return false;
                }
            }
            return $years_data;
        } else {
            return false;
        }

    }
}
