<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenerateCode extends Model
{
    use HasFactory;

    protected $primaryKey = 'data_group';
    protected $keyType = 'string';
}
