<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public function installmentType()
    {
        return $this->belongsTo('App\Models\InstallmentType', 'type', 'it_id');
    }
    
    public function statusType()
    {
        return $this->belongsTo('App\Models\TypeStatus', 'status_type', 's_id');
    }
}
