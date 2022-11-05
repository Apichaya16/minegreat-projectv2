<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\InstallmentType;
use App\Models\Payment;
use App\Models\PaymentStatus;
use App\Models\PaymentType;
use App\Models\TypeStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class AccountController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function index()
    {
        // $accounts = Account::all();
        // if ($accounts) {
        //     $accounts->load(['products.brands', 'installmentType', 'statusType', 'user', 'paymentType']);
        // }
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
                ORDER BY a.created_at DESC";
        $accounts = DB::select($sql);

        $typeStatus = TypeStatus::all();
        $installmentTypes = InstallmentType::all();
        $paymentTypes = PaymentType::all();
        return view('admin.accounting.accounting', compact('accounts', 'typeStatus', 'installmentTypes', 'paymentTypes'));
    }

    public function payment(Request $request) //จัดการข้อมูลการผ่อนชำระ
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
                    ->orderBy('payment.order_number', 'desc')
                    ->get();
        foreach ($accounts as $acc) {
            $amount = $acc->installment;
            foreach ($payments as $p) {
                if ($acc->pc_id == $p->account_id && $p->status_id == 2) {
                    $acc->balance_payment -= $p->amount;
                    $amount += $p->amount;
                    $p->sum = $amount;
                }
            }
            $acc->percen_current = ($amount / $acc->amount_after_discount) * 100;
        }

        $paymentStatus = PaymentStatus::where('is_active', 1)->get();
        return view('admin.payment.index', compact(['accounts', 'payments', 'paymentStatus']));
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

        if ($request->percen_current) {
            $percen_current = ((int)$request->installment / (int)$request->price) * 100;
            $acc->percen_current = $percen_current;
        } else {
            $acc->percen_current = $request->percen_current;
        }

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
            $users = User::where('role_id', '>', 100)->whereNotIn('u_id', $accounts->pluck('user_id')->toArray())->get();
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
            return response()->json(['status' => false, 'message' => 'error', 'html' => null], $th->getCode());
        }
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
