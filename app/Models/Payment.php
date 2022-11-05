<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Uuids;
    protected $dates = ['deleted_at'];
    protected $table = 'payment';
    protected $primaryKey = 'p_id';

    protected $fillable = ['account_id', 'amount','date_payment', 'order_number', 'status'];

    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class, 'status_id');
    }
}
