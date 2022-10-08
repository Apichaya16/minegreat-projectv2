<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function details()
    {
        return $this->hasMany(ProductDetail::class, 'product_id');
    }

    public function colorMaps()
    {
        return $this->hasMany(ProductColorMaps::class, 'product_id');
    }

    public function capacityMaps()
    {
        return $this->hasMany(ProductCapacityMaps::class, 'product_id');
    }
}
