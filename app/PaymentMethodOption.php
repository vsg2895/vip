<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PaymentMethod;

class PaymentMethodOption extends Model
{
    // Table name
    protected $table = 'payment_method_options';

    // Updated fields
    protected $fillable = [
        'payment_method_id', 'price'
    ];  

    // Relationship with payment method many to one
    public function payment_method()
    {
        return $this->hasOne(PaymentMethod::class, 'id', 'payment_method_id');
    }
}
