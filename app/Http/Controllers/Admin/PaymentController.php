<?php

namespace App\Http\Controllers\Admin;

use App\Http\Constands;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Payment;
use App\Models\PaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) //จัดการข้อมูลการผ่อนชำระ
    {
        $filter = $request->get('filter');
        $sql = "SELECT a.*
                ,p.name_th AS product_name
                ,p.desc_th AS product_desc
                ,p.is_active
                ,b.name_en AS brand_name
                ,it.name AS installment_name
                ,ts.name AS type_name
                ,ts.color AS type_color
                ,pt.name AS payment_name
                ,u.u_id
                ,u.number_customers
                ,u.first_name
                ,u.last_name
                FROM accounts a
                LEFT JOIN products p ON p.id = a.product
                LEFT JOIN brands b ON b.id = p.brand
                LEFT JOIN installment_types it ON it.it_id = a.`type`
                LEFT JOIN type_status ts ON ts.s_id = a.status_type
                LEFT JOIN payment_types pt ON pt.id = a.type_pay
                LEFT JOIN users u ON u.u_id = a.user_id
                WHERE a.deleted_at IS NULL
                AND a.status_type = ?
                ORDER BY a.created_at DESC";
        $accounts = DB::select($sql, [$filter]);
        $acIds = collect($accounts)->pluck('pc_id')->toArray();

        $payments = DB::table('payment')->select('payment.*', 'payment_status.name AS status_name', 'payment_status.color AS status_color')
                    ->whereIn('account_id', $acIds)
                    ->where('deleted_at', null)
                    ->leftJoin('payment_status', 'payment_status.id', '=', 'payment.status_id')
                    ->orderBy('payment.order_number', 'asc')
                    ->get();
        foreach ($accounts as $acc) {
            $balance = (float)$acc->amount_after_discount - (int)$acc->installment;
            $sum = (int)$acc->installment + (int)$acc->discount;
            foreach ($payments as $p) {
                if ($acc->pc_id == $p->account_id && $p->status_id == 2) {
                    $balance -= $p->amount;
                    $sum += $p->amount;
                    $p->sum = $sum;
                }
            }
            $acc->balance_payment = $balance;
            $acc->percen_current = ($sum / $acc->price) * 100;
        }
        $payments = array_reverse($payments->toArray());

        $paymentStatus = PaymentStatus::where('is_active', 1)->get();
        return view('admin.payment.index', compact(['accounts', 'payments', 'paymentStatus']));
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
            $pay->status_id = $request->status_id;
            $pay->save();

            if ($request->hasFile('slip_image')) {
                $file = $request->file('slip_image');
                $file->storeAs(Constands::$SLIP_PATH . $pay->p_id, $file->getClientOriginalName());
                $pay->slip_image = $file->getClientOriginalName();
                $pay->slip_url = env('APP_URL') . Storage::url(Constands::$SLIP_PATH . $pay->p_id . '/' . $file->getClientOriginalName());
                $pay->save();
            }

            $paymentAll = Payment::where('account_id', $request->pc_id)->where('status_id', 2)->get();
            $acc = Account::find($request->pc_id);
            $balance = (float)$acc->amount_after_discount;
            $sum = (int)$acc->installment + (int)$acc->discount;
            foreach ($paymentAll as $p) {
                $balance -= $p->amount;
                $sum += $p->amount;
                $p->sum = $sum;
            }
            $percent_current = ($sum / $acc->price) * 100;

            if ((float)$percent_current >= (float)$acc->percen_consider) {
                Account::find($request->pc_id)->update([
                    'status_type' => 1
                ]);
            } else {
                Account::find($request->pc_id)->update([
                    'status_type' => 2
                ]);
            }

            $html = $this->renderPaymentTable($filter);

            DB::commit();

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
            $payment = Payment::where('p_id', $pId)->first();
            $payment->update([
                'amount' => $request->amount,
                'order_number' => $request->order_number,
                'date_payment' => $date,
                'status_id' => $request->status_id,
            ]);

            if ($request->hasFile('slip_image')) {
                $file = $request->file('slip_image');
                $file->storeAs(Constands::$SLIP_PATH . $pId, $file->getClientOriginalName());
                $payment->update([
                    'slip_image' => $file->getClientOriginalName(),
                    'slip_url' => env('APP_URL') . Storage::url(Constands::$SLIP_PATH . $payment->p_id . '/' . $file->getClientOriginalName()),
                ]);
            }

            $paymentAll = Payment::where('account_id', $payment->account_id)->where('status_id', 2)->get();
            $acc = Account::find($payment->account_id);
            $balance = (float)$acc->amount_after_discount;
            $sum = (int)$acc->installment + (int)$acc->discount;
            foreach ($paymentAll as $p) {
                $balance -= $p->amount;
                $sum += $p->amount;
                $p->sum = $sum;
            }
            $percent_current = ($sum / $acc->price) * 100;

            if ((float)$percent_current >= (float)$acc->percen_consider) {
                Account::find($payment->account_id)->update([
                    'status_type' => 1
                ]);
            } else {
                Account::find($payment->account_id)->update([
                    'status_type' => 2
                ]);
            }

            $html = $this->renderPaymentTable($request->get('filter'));

            DB::commit();

            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], 500);
        }
    }

    public function delete_payment(Request $request, $pId)
    {
        try {
            DB::beginTransaction();

            $payment = Payment::where('p_id', $pId)->first();
            $payment->delete();

            $paymentAll = Payment::where('account_id', $payment->account_id)->where('status_id', 2)->get();
            $acc = Account::find($payment->account_id);
            $balance = (float)$acc->amount_after_discount;
            $sum = (int)$acc->installment + (int)$acc->discount;
            foreach ($paymentAll as $p) {
                $balance -= $p->amount;
                $sum += $p->amount;
                $p->sum = $sum;
            }
            $percent_current = ($sum / $acc->price) * 100;

            if ((float)$percent_current >= (float)$acc->percen_consider) {
                Account::find($payment->account_id)->update([
                    'status_type' => 1
                ]);
            } else {
                Account::find($payment->account_id)->update([
                    'status_type' => 2
                ]);
            }

            DB::commit();

            $html = $this->renderPaymentTable($request->get('filter'));

            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], $th->getCode());
        }
    }

    protected function renderPaymentTable($filter = '1')
    {
        $sql = "SELECT a.*
                ,p.name_th AS product_name
                ,p.desc_th AS product_desc
                ,p.is_active
                ,b.name_en AS brand_name
                ,it.name AS installment_name
                ,ts.name AS type_name
                ,ts.color AS type_color
                ,pt.name AS payment_name
                ,u.u_id
                ,u.number_customers
                ,u.first_name
                ,u.last_name
                FROM accounts a
                LEFT JOIN products p ON p.id = a.product
                LEFT JOIN brands b ON b.id = p.brand
                LEFT JOIN installment_types it ON it.it_id = a.`type`
                LEFT JOIN type_status ts ON ts.s_id = a.status_type
                LEFT JOIN payment_types pt ON pt.id = a.type_pay
                LEFT JOIN users u ON u.u_id = a.user_id
                WHERE a.deleted_at IS NULL
                AND a.status_type = ?
                ORDER BY a.created_at DESC";
        $accounts = DB::select($sql, [$filter]);
        $acIds = collect($accounts)->pluck('pc_id')->toArray();

        $payments = DB::table('payment')->select('payment.*', 'payment_status.name AS status_name', 'payment_status.color AS status_color')
                    ->whereIn('account_id', $acIds)
                    ->where('deleted_at', null)
                    ->leftJoin('payment_status', 'payment_status.id', '=', 'payment.status_id')
                    ->orderBy('payment.order_number', 'desc')
                    ->get();
        foreach ($accounts as $acc) {
            $balance = (float)$acc->amount_after_discount - (int)$acc->installment;
            $sum = (int)$acc->installment + (int)$acc->discount;
            foreach ($payments as $p) {
                if ($acc->pc_id == $p->account_id && $p->status_id == 2) {
                    $balance -= $p->amount;
                    $sum += $p->amount;
                    $p->sum = $sum;
                }
            }
            $acc->balance_payment = $balance;
            $acc->percen_current = ($sum / $acc->price) * 100;
        }
        $payments = array_reverse($payments->toArray());
        $html = view('admin.payment.tables.payment-table', compact(['accounts','payments']))->render();
        return $html;
    }
}
