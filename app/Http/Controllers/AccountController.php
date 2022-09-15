<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function index()
    {
        $accounts = Account::paginate(20);
        $accounts->load('installmentType', 'statusType', 'user');
        return view('admin.accounting', compact('accounts'));
    }

    public function payment(Request $request)
    {
        $filter = $request->get('filter');
        $accounts = Account::where('status_type', $filter)->get();
        $accounts->load('installmentType', 'statusType', 'user', 'payment');
        foreach ($accounts as $k1 => $v1) {
            $amount = $v1->installment;
            foreach ($v1->payment as $k2 => $v2) {
                $v1->balance_payment -= $v2->amount;
                $amount += $v2->amount;
                $v2->sum += $amount;
            }
            $v1->percen_current = ($amount / $v1->amount_after_discount) * 100;
        }
        return view('admin.payment', compact('accounts'));
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
        $acc->status_type = $request->status_type;
        $acc->detail_promotion = $request->detail_promotion;
        $acc->amount_after_discount = $request->amount_after_discount;
        $acc->save();
        DB::commit();

        return back();
    }

    public function update_account(Request $request, $pcId)
    {
        DB::beginTransaction();
        $acc = Account::where('pc_id', $pcId)->first();
        $acc->product = $request->product;
        $acc->brand = $request->brand;
        $acc->details = $request->details;
        // $acc->type = $request->type;
        // $acc->type_pay = $request->type_pay;
        // $acc->status_type = $request->status_type;
        $acc->discount = $request->discount;
        $acc->installment = $request->installment;
        $acc->product = $request->product;
        $acc->price = $request->price;
        $acc->balance_payment = $request->balance_payment;
        $acc->percen_current = $request->percen_current;
        $acc->percen_consider = $request->percen_consider;
        $acc->amount_consider = $request->amount_consider;
        $acc->detail_promotion = $request->detail_promotion;
        $acc->save();
        DB::commit();

        return response()->json(['status' => true]);
    }

    public  function add_account()
    {
        $data = User::all();
        return view('admin/add_account', compact('data'));
    }

    public function del_acc(Request $request)
    {
        DB::beginTransaction();
        Account::where('pc_id', $request->id)->delete();
        DB::commit();

        return response()->json(['status' => true]);
    }

    public function add_payment(Request $request, $id)
    {
        DB::beginTransaction();
        if ($id == 0) {
            $pay = new Payment;
            $pay->account_id = $request->pc_id;
        } else {
            $pay = Payment::where('p_id', $id)->first();
        }
        $pay->amount = $request->amount;
        $pay->date_payment = $request->date_payment . ' ' . $request->time_payment . ':00';
        $pay->order_number = $request->order_number;
        // $pay->create_on = date('Y-m-d H:i:s');
        $pay->save();
        DB::commit();

        return response()->json(['status' => true]);
    }

    public function del_payment(Request $request)
    {
        DB::beginTransaction();
        Payment::where('p_id', $request->id)->delete();
        DB::commit();

        return response()->json(['status' => true]);
    }
}
