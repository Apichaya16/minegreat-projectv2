<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\InstallmentType;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\TypeStatus;
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
        $accounts = Account::all();
        $accounts->load('installmentType', 'statusType', 'user', 'paymentType');

        $typeStatus = TypeStatus::all();
        $installmentTypes = InstallmentType::all();
        $paymentTypes = PaymentType::all();
        return view('admin.accounting.accounting', compact('accounts', 'typeStatus', 'installmentTypes', 'paymentTypes'));
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
        $acc->amount_consider = $request->price;
        $acc->status_type = $request->status_type;
        $acc->detail_promotion = $request->detail_promotion;
        $acc->amount_after_discount = $request->amount_after_discount;
        $acc->save();
        DB::commit();

        return redirect()->route('admin.accounting.index');
    }

    public function update_account(Request $request, $pcId)
    {
        try {
            DB::beginTransaction();
            Account::where('pc_id', $pcId)->update($request->all());
            DB::commit();

            $html = $this->renderTable();
            return response()->json(['status' => true, 'html' => $html]);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json(['status' => false, 'html' => null], $th->getCode());
        }
    }

    public  function add_account()
    {
        $accounts = Account::all();
        if ($accounts->count()) {
            $users = User::where('role_id', '>', 100)->whereNotIn('u_id', [$accounts->pluck('user_id')])->get();
        }else {
            $users = User::where('role_id', '>', 100)->get();
        }

        $typeStatus = TypeStatus::all();
        $installmentType = InstallmentType::all();
        $paymentTypes = PaymentType::all();
        return view('admin.accounting.add_account', compact('users', 'typeStatus', 'installmentType', 'paymentTypes'));
    }

    public function del_acc($pcId)
    {
        try {
            DB::beginTransaction();
            Account::where('pc_id', $pcId)->delete();
            DB::commit();

            $html = $this->renderTable();

            return response()->json(['status' => true, 'html' => $html]);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json(['status' => false, 'html' => null], $th->getCode());
        }
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

    protected function renderTable()
    {
        $accounts = Account::all();
        $accounts->load('installmentType', 'statusType', 'user', 'paymentType');

        $typeStatus = TypeStatus::all();
        $installmentTypes = InstallmentType::all();
        $paymentTypes = PaymentType::all();
        $html = view('admin.accounting.table.accounting-table', compact('accounts', 'typeStatus', 'installmentTypes', 'paymentTypes'))->render();
        return $html;
    }
}
