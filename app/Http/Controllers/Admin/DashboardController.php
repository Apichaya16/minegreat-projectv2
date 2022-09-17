<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
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
        $installmentTypes = [];
        if ($accounts->count()) {
            for ($i=0; $i < $accounts->count(); $i++) {
                array_push($installmentTypes, $accounts[$i]->installmentType);
            }
        } else {
            $installmentTypes = collect($installmentTypes);
        }
        return view('admin.dashboard', compact('accounts', 'installmentTypes'));
    }
}
