<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\InstallmentType;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\TypeStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function getPaymentById($pId)
    {
        $payment = Payment::find($pId);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $payment]);
    }

    public function create_payment(Request $request)
    {
        try {
            DB::beginTransaction();
            $filter = $request->get('filter');
            $pay = new Payment;
            $pay->account_id = $request->pc_id;
            $pay->amount = $request->amount;
            $pay->date_payment = $request->date_payment . ' ' . $request->time_payment . ':00';
            $pay->order_number = $request->order_number;
            $pay->save();
            DB::commit();

            $html = $this->renderPaymentTable($filter);

            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], $th->getCode());
        }
    }

    public function update_payment(Request $request, $pId)
    {
        try {
            DB::beginTransaction();
            $date = $request->date_payment . ' ' . $request->time_payment;
            Payment::where('p_id', $pId)->update(
                [
                    // 'account_id'=>$request->account_id,
                    'amount' => $request->amount,
                    'order_number' => $request->order_number,
                    'date_payment' => $date
                ]
            );
            DB::commit();

            $html = $this->renderPaymentTable($request->get('filter'));

            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], $th->getCode());
        }
    }

    public function delete_payment(Request $request, $pId)
    {
        try {
            DB::beginTransaction();
            Payment::where('p_id', $pId)->delete();
            DB::commit();

            $html = $this->renderPaymentTable($request->get('filter'));

            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], $th->getCode());
        }
    }

    protected function renderPaymentTable($filter = '1')
    {
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
        $html = view('admin.payment.tables.payment-table', compact('accounts'))->render();
        return $html;
    }
}
