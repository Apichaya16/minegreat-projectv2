<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $primaryKey = 'pc_id';
    protected $fillable = [
        'brand',
        'user_id',
        'product',
        'type',
        'price',
        'discount',
        'amount_after_discount',
        'amount_consider',
        'installment',
        'type_pay',
        'status_type',
        'balance_payment',
        'percen_current',
        'percen_consider',
        'detail_promotion'
    ];

    public function installmentType()
    {
        return $this->belongsTo('App\Models\InstallmentType', 'type', 'it_id');
    }

    public function statusType()
    {
        return $this->belongsTo('App\Models\TypeStatus', 'status_type', 's_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'u_id');
    }

    public function payment()
    {
        return $this->hasMany('App\Models\Payment', "account_id");//, 'pc_id', 'account_id'
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class, 'type_pay', 'id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product');
    }
}
