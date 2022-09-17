<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallmentType extends Model
{
    use HasFactory;

    protected $primaryKey = "it_id";
    protected $keyType = "string";

    // public function Accounts() TEST
    // {
    //     return $this->belongsTo('App\Account');
    // }
}
