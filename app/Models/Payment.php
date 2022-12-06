<?php

namespace App\Models;

use App\Http\Constands;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Uuids;
    protected $dates = ['deleted_at'];
    protected $table = 'payment';
    protected $primaryKey = 'p_id';

    protected $fillable = ['account_id', 'amount', 'slip_image', 'slip_url','date_payment', 'order_number', 'status_id'];

    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class, 'status_id');
    }

    public function getSlipImage()
    {
        if (Storage::disk('public')->exists(Constands::$SLIP_PATH . $this->p_id . '/' . $this->slip_image)) {
            return env('APP_URL') . Storage::url(Constands::$SLIP_PATH . $this->p_id . '/' . $this->slip_image);
        }
    }
}
