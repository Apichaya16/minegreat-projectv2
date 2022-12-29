<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sql = "SELECT p.*,
                ps.name AS status_name,
                pd.name_th AS product_nameth,
                pd.name_en AS product_nameen,
                u.first_name,
                u.last_name
                FROM payment p
                LEFT JOIN payment_status ps ON ps.id = p.status_id
                LEFT JOIN accounts a ON a.pc_id = p.account_id
                LEFT JOIN products pd ON pd.id = a.product
                LEFT JOIN users u ON u.u_id = a.user_id
                WHERE p.status_id = 1
                AND p.deleted_at IS NULL";
        $payments = DB::select($sql);
        $paymentStatus = PaymentStatus::orderBy('seqno', 'ASC')->get();
        return view('admin.payment-list.index', compact(['payments','paymentStatus']));
    }
}
