<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    public function colors()
    {
        return $this->belongsTo(ProductColor::class, 'color');
    }

    public function capacities()
    {
        return $this->belongsTo(ProductCapacity::class, 'capacity');
    }
}
