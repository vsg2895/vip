<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SparePartModel;
use App\Location;

class SparePart extends Model
{
    // Table name
    protected $table = 'spare_parts';

    // Updated fields
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'location_id', 'model_id', 'img'
    ];

    // Relationship with spare part model one to one
    public function model()
    {
        return $this->hasOne(SparePartModel::class, 'id', 'model_id');
    }

    // Relationship with location one to one
    public function location()
    {
        return $this->hasOne(Location::class, 'id', 'location_id');
    }
}
