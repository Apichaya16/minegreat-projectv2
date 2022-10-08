<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCapacityMaps extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'capacity_maps';

    protected $fillable = [
        'product_id',
        'capacity_id',
        'is_active'
    ];

    public function capacity()
    {
        return $this->hasOne(ProductCapacity::class, 'id', 'capacity_id');
    }
}
