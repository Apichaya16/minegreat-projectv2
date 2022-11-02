<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'brand',
        'name_th',
        'name_en',
        'desc_th',
        'desc_en',
        'is_active',
        'price'
    ];

    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brand');
    }

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
