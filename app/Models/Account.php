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
        return $this->belongsTo('App\Models\Users', 'user_id', 'u_id');
    }

    public function payment()
    {
        return $this->hasMany('App\Models\Payment', "account_id");//, 'pc_id', 'account_id'
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class, 'type_pay', 'id');
    }
}
