<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'payment';
    protected $primaryKey = 'p_id';

    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class, 'status_id');
    }
}
