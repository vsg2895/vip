<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\UserPhoneNumber;
use App\Country;
use App\UserRating;
use App\UserNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'img', 'llc', 'phone', 'role', 'country_id', 'confirm'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship with phone numbers one to many
    public function phone_number()
    {
        return $this->hasOne(UserPhoneNumber::class, 'user_id', 'id');
    }

    // Relationship with country one to one
    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    // Relationship with notification one to one
    public function notification()
    {
        return $this->hasOne(UserNotification::class, 'user_id', 'id');
    }

    // Relationship with rate one to one
    public function rate()
    {
        return $this->hasOne(UserRating::class, 'user_id', 'id');
    }

    // Relationship with wallet one to one
    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'user_id', 'id');
    }

    // Relationship with wallet one to one
    public function spare_stores()
    {
        return $this->hasMany(SparePartsStore::class, 'user_id', 'id');
    }

    // Relationship with wallet one to one
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }
}
