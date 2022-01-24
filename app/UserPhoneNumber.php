<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Country;

class UserPhoneNumber extends Model
{
    // Table name
    protected $table = 'user_phone_numbers';

    // Updated fields
    protected $fillable = [
        'user_id', 'phone_number', 'type'
    ];

    // Relationship with user one to one
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    // Relationship with phone country one to one
    public function phone_country()
    {
        return $this->hasOne(Country::class, 'id', 'phone_country_id');
    }

    // Relationship with viber country one to one
    public function viber_country()
    {
        return $this->hasOne(Country::class, 'id', 'viber_country_id');
    }

    // Relationship with whatsapp country one to one
    public function whatsapp_country()
    {
        return $this->hasOne(Country::class, 'id', 'whatsapp_country_id');
    }

    // Relationship with telegram country one to one
    public function telegram_country()
    {
        return $this->hasOne(Country::class, 'id', 'telegram_country_id');
    }
   
}
