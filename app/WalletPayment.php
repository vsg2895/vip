<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Wallet;
use App\PaymentMethod;

class WalletPayment extends Model
{
    // Table name
    protected $table = 'wallet_payments';

    // Updated fields
    protected $fillable = [
        'wallet_id', 'payment_method_id', 'price', 'status'
    ];

    // Relationship with wallet many to one
    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'id', 'wallet_id');
    }

    // Relationship with payment method one to one
    public function payment_method()
    {
        return $this->hasOne(PaymentMethod::class, 'id', 'payment_method_id');
    }
}
