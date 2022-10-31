<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $accounts = Account::where('user_id', auth()->user()->u_id)->with('statusType')->get();
        $accounts->load('statusType');
        return view('customer.payment.index', compact('accounts'));
    }

    public function create($accId)
    {
        $account = Account::where('pc_id', $accId)->with(['installmentType', 'statusType', 'user', 'payment'])->first();
        $amount = (int) $account->installment;
        foreach ($account->payment as $k2 => $v2) {
            $account->balance_payment -= $v2->amount;
            $amount += $v2->amount;
            $v2->sum += $amount;
        }
        $account->percen_current = ($amount / $account->amount_after_discount) * 100;
        return view('customer.payment.list-payment', compact('account'));
    }

    public function getPaymentById($pId)
    {
        try {
            $account = Account::find($pId);
            if ($account) {
                $account->load('installmentType', 'statusType', 'user', 'payment');
            }
            return response()->json(['status' => true, 'message' => 'success', 'data' => $account]);
        } catch (\Throwable $th) {
            return response()->json(['status' => true, 'message' => $th->getMessage(), 'data' => $account], 500);
        }
    }
}
