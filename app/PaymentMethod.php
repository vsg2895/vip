<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PaymentMethodOption;

class PaymentMethod extends Model
{
    // Table name
    protected $table = 'payment_methods';

    // Updated fields
    protected $fillable = [
        'img', 'title_en', 'title_ru', 'title_hy', 'description_en', 'description_ru', 'description_hy', 'position_id'
    ];  
    
    // Relationship with payment method one to many
    public function option()
    {
        return $this->hasMany(PaymentMethodOption::class, 'payment_method_id', 'id');
    }
}
