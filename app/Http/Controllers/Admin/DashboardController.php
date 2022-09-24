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

    }


    public function index()
    {
        $accounts = Account::all();
        $accounts->load('installmentType');
        $installmentTypes = InstallmentType::all();
        return view('admin.dashboard', compact('accounts', 'installmentTypes'));
    }
}
