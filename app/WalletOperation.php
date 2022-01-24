<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Wallet;

class WalletOperation extends Model
{
    // Table name
    protected $table = 'wallet_operations';

    // Updated fields
    protected $fillable = [
        'wallet_id', 'price', 'description', 'status'
    ];

    // Relationship with wallet many to one
    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'id', 'wallet_id');
    }
}
