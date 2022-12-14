<?php

namespace App\Http\Controllers;

use App\Http\Constands;
use App\Models\Account;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $accounts = Account::where('user_id', auth()->user()->u_id)->with(['products.brands','statusType'])->orderBy('created_at', 'desc')->get();
        return view('customer.payment.index', compact('accounts'));
    }

    public function create($accId)
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
                AND a.pc_id = ?
                ORDER BY a.created_at DESC";
        $account = collect(DB::select($sql, [$accId]))->first();

        $payments = DB::table('payment')->select('payment.*', 'payment_status.name AS status_name', 'payment_status.color AS status_color')
                    ->where('account_id', $accId)
                    ->where('deleted_at', null)
                    ->leftJoin('payment_status', 'payment_status.id', '=', 'payment.status_id')
                    ->orderBy('payment.order_number', 'asc')
                    ->get();
        $balance = (float)$account->amount_after_discount;
        $sum = 0;
        // $balance = (float)$account->amount_after_discount - (int)$account->installment;
        // $sum = (int)$account->installment + (int)$account->discount;
        foreach ($payments as $p) {
            if ($account->pc_id == $p->account_id && $p->status_id == 2) {
                $balance -= $p->amount;
                $sum += $p->amount;
                $p->sum = $sum;
            }
        }
        $account->balance_payment = $balance;
        $account->percen_current = ($sum / $account->price) * 100;

        $lastOrderNumber = collect($payments)->max('order_number') ?? 0;
        return view('customer.payment.list-payment', compact(['account','payments', 'lastOrderNumber']));
    }

    public function getPaymentDetailById($pId)
    {
        try {
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
                AND a.pc_id = ?
                ORDER BY a.created_at DESC";
            $account = collect(DB::select($sql, [$pId]))->first();

            $payments = DB::table('payment')->select('payment.*', 'payment_status.name AS status_name', 'payment_status.color AS status_color')
                    ->where('account_id', $pId)
                    ->where('deleted_at', null)
                    ->leftJoin('payment_status', 'payment_status.id', '=', 'payment.status_id')
                    ->orderBy('payment.order_number', 'asc')
                    ->get();
            $balance = (float)$account->amount_after_discount;
            $sum = 0;
            // $balance = (float)$account->amount_after_discount - (int)$account->installment;
            // $sum = (int)$account->installment + (int)$account->discount;
            foreach ($payments as $p) {
                if ($account->pc_id == $p->account_id && $p->status_id == 2) {
                    $balance -= $p->amount;
                    $sum += $p->amount;
                    $p->sum = $sum;
                }
            }
            $account->balance_payment = $balance;
            $account->percen_current = ($sum / $account->price) * 100;

            return response()->json(['status' => true, 'message' => 'success', 'data' => $account]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'data' => null], 500);
        }
    }

    public function getPaymentById($pId)
    {
        $payment = Payment::where('p_id', $pId)->with('paymentStatus')->first();
        if ($payment->slip_url) {
            $payment->slip_url = $payment->getSlipImage();
        }
        return response()->json(['status' => true, 'message' => 'success', 'data' => $payment]);
    }

    public function storePayment(Request $request)
    {
        try {
            DB::beginTransaction();

            $date_payment = $request->date_payment . ' ' . $request->time_payment;
            $payment = Payment::create([
                'account_id' => $request->account_id,
                'amount' => $request->amount,
                'date_payment' => $date_payment,
                'order_number' => $request->order_number,
                'status_id' => 1,
            ]);

            if ($request->hasFile('slip_image')) {
                $file = $request->file('slip_image');
                $file->storeAs("public/" . Constands::$SLIP_PATH . $payment->p_id, $file->getClientOriginalName());
                $payment->update([
                    'slip_image' => $file->getClientOriginalName(),
                    'slip_url' => Storage::url(Constands::$SLIP_PATH . $payment->p_id . '/' . $file->getClientOriginalName()),
                ]);
            }

            $paymentAll = Payment::where('account_id', $request->account_id)->where('status_id', 2)->get();
            $acc = Account::find($request->account_id);
            $balance = (float)$acc->amount_after_discount;
            $sum = 0;
            // $sum = (int)$acc->installment + (int)$acc->discount;
            foreach ($paymentAll as $p) {
                $balance -= $p->amount;
                $sum += $p->amount;
                $p->sum = $sum;
            }
            $percent_current = ($sum / $acc->price) * 100;

            if ((float)$percent_current == (float)$acc->percen_consider) {
                Account::find($request->account_id)->update([
                    'status_type' => 1
                ]);
            } else {
                Account::find($request->account_id)->update([
                    'status_type' => 2
                ]);
            }

            $html = $this->renderDataTable($request->account_id);

            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null]);
        }
    }

    public function updatePaymentById(Request $request, $pId)
    {
        try {
            DB::beginTransaction();

            $date_payment = $request->date_payment . ' ' . $request->time_payment;
            $payment = Payment::where('p_id', $pId)->first();
            $payment->update([
                'amount' => $request->amount,
                'date_payment' => $date_payment,
                'order_number' => $request->order_number,
            ]);

            if ($request->hasFile('slip_image')) {
                $file = $request->file('slip_image');
                $file->storeAs("public/" . Constands::$SLIP_PATH . $payment->p_id, $file->getClientOriginalName());
                $payment->update([
                    'slip_image' => $file->getClientOriginalName(),
                    'slip_url' => Storage::url(Constands::$SLIP_PATH . $payment->p_id . '/' . $file->getClientOriginalName()),
                ]);
            }

            $paymentAll = Payment::where('account_id', $request->account_id)->where('status_id', 2)->get();
            $acc = Account::find($request->account_id);
            $balance = (float)$acc->amount_after_discount;
            $sum = 0;
            // $sum = (int)$acc->installment + (int)$acc->discount;
            foreach ($paymentAll as $p) {
                $balance -= $p->amount;
                $sum += $p->amount;
                $p->sum = $sum;
            }
            $percent_current = ($sum / $acc->price) * 100;

            if ((float)$percent_current >= (float)$acc->percen_consider) {
                Account::find($request->account_id)->update([
                    'status_type' => 1
                ]);
            } else {
                Account::find($request->account_id)->update([
                    'status_type' => 2
                ]);
            }

            $html = $this->renderDataTable($request->account_id);

            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null]);
        }
    }

    public function deletePayment($pId)
    {
        try {
            DB::beginTransaction();

            $payment = Payment::where('p_id', $pId)->first();
            $payment->delete();

            $paymentAll = Payment::where('account_id', $payment->account_id)->where('status_id', 2)->get();
            $acc = Account::find($payment->account_id);
            $balance = (float)$acc->amount_after_discount;
            $sum = 0;
            // $sum = (int)$acc->installment + (int)$acc->discount;
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

            $html = $this->renderDataTable($payment->account_id);

            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], $th->getCode());
        }
    }

    protected function renderDataTable($accId)
    {
        $accounts = Account::find($accId)->get();
        $payments = DB::table('payment')->select('payment.*', 'payment_status.name AS status_name', 'payment_status.color AS status_color')
                    ->where('account_id', $accId)
                    ->where('deleted_at', null)
                    ->leftJoin('payment_status', 'payment_status.id', '=', 'payment.status_id')
                    ->orderBy('payment.order_number', 'asc')
                    ->get();
        foreach ($accounts as $acc) {
            $balance = (float)$acc->amount_after_discount;
            $sum = 0;
            // $balance = (float)$acc->amount_after_discount - (int)$acc->installment;
            // $sum = (int)$acc->installment + (int)$acc->discount;
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
        return view('customer.payment.table.payment-table', compact('payments'))->render();
    }
}
