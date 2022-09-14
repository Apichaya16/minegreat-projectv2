<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class MyaccountController extends Controller
{
    public function index()
    {
        $accounts = Account::all();
        $accounts->load('installmentType', 'statusType');
        return view('customer.myaccount', compact('accounts'));
    }
}






