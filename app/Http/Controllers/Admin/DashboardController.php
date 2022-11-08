<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\InstallmentType;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $accounts = Account::all();
        $accounts->load('installmentType');
        $installmentTypes = InstallmentType::all();
        return view('admin.dashboard', compact('accounts', 'installmentTypes'));
    }

    public function getProductChart()
    {
        $sql = "SELECT p.name_th , p.name_en , COUNT(a.pc_id) AS product_count
                FROM products p
                LEFT JOIN accounts a ON a.product = p.id
                GROUP BY p.id";
        $datas = DB::select($sql);
        return response()->json(['status' => true, 'datas' => $datas]);
    }
}
