<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'color',
        'capacity',
        'is_active'
    ];

    public function colors()
    {
        return $this->belongsTo(ProductColor::class, 'color');
    }

    public function capacities()
    {
        return $this->belongsTo(ProductCapacity::class, 'capacity');
    }
}
