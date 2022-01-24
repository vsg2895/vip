<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyApi extends Model
{
    // Table name
    protected $table = 'currency_apis';

    // Updated fields
    protected $fillable = [
        'amd', 'eur', 'usd', 'rub'
    ];
}
