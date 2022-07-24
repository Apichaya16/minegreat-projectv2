<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::all();
        $accounts->load('installmentType', 'statusType');
        return view('admin.accounting', compact('accounts'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $acc = new Account();
        $acc->user_id = $request->user_id;
        $acc->product = $request->product;
        $acc->brand = $request->brand;
        $acc->details = $request->details;
        $acc->type = $request->type;
        $acc->type_pay = $request->type_pay;
        $acc->discount = $request->discount;
        $acc->installment = $request->installment;
        $acc->product = $request->product;
        $acc->price = $request->price;
        $acc->balance_payment = $request->balance_payment;
        $acc->percen_current = $request->percen_current;
        $acc->percen_consider = $request->percen_consider;
        $acc->amount_consider = $request->amount_consider;
        $acc->status = $request->status;
        $acc->save();
        DB::commit();

        return back();
    }
}
