<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColorMaps extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'color_maps';

    protected $fillable = [
        'product_id',
        'color_id',
        'is_active'
    ];

    public function color()
    {
        return $this->hasOne(ProductColor::class, 'id', 'color_id');
    }
}
