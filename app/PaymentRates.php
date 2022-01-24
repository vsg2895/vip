<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentRates extends Model
{
    protected $fillable = [
        'type','price','duration','duration_priority'
    ];
}
