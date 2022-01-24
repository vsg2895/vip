<?php

namespace App;

use App\Category;
use App\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\WishlistPost;
use App\User;
use App\Location;
use App\PostOption;
use App\PostImage;
use App\PostsExternalLinks;

class Post extends Model
{
    // Table name
    protected $table = 'posts';

    // Updated fields
    protected $fillable = [
        'code', 'position_id','img', 'width', 'height', 'size', 'user_id', 'title_en', 'title_ru', 'title_hy', 'description_en', 'description_ru', 'description_hy', 'category_id', 'post_type', 'auth_type', 'post_estate_type', 'electro_type', 'location_id', 'video_url', 'video_process', 'video_price','price', 'hurry', 'active', 'updates'
    ];

    public function scopeNotProcessed(Builder $query){

        return $this->where('video_process', '=', false);

    }

    // Relationship with wishlist one to one
    public function wishlist()
    {
        return $this->hasOne(WishlistPost::class, 'post_id', 'id');
    }

    // Relationship with user one to one
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    // Relationship with locations one to one
    public function location()
    {
        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    // Relationship with option one to many
    public function option()
    {
        return $this->hasMany(PostOption::class, 'post_id', 'id');
    }
    // Function get options curent filtr_item corresponding
    public function edit_option($option_id)
    {
        return $this->option()->where('option_id',$option_id)->first();
    }

    // Relationship with image one to many
    public function image()
    {
        return $this->hasMany(PostImage::class, 'post_id', 'id');
    }

    // Relationship with currecny one to one
    public function currency()
    {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function links()
    {
        return $this->hasMany(PostsExternalLinks::class, 'post_id', 'id');
    }
//
//    public function getInfoAttribute($value)
//    {
//        return json_decode($value, false, JSON_THROW_ON_ERROR);
//    }
}
