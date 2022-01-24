<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\WalletOperation;
use App\WalletPayment;

class Wallet extends Model
{
    // Table name
    protected $table = 'wallets';

    // Updated fields
    protected $fillable = [
        'user_id', 'balance', 'code'
    ];

    // Relationship with user one to one
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    // Relationship with opertation one to many
    public function opertation()
    {
        return $this->hasMany(WalletOperation::class, 'wallet_id', 'id');
    }

    // Relationship with payment one to many
    public function payment()
    {
        return $this->hasMany(WalletPayment::class, 'wallet_id', 'id');
    }
}
