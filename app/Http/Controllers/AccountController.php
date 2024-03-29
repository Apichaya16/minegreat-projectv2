<?php

namespace App\Http\Controllers;

use App\Http\Constands;
use App\Models\Account;
use App\Models\Brand;
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
        $this->middleware('auth');
    }


    public function index()
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
                ORDER BY a.created_at DESC";
        $accounts = DB::select($sql);
        $acIds = collect($accounts)->pluck('pc_id')->toArray();

        $payments = DB::table('payment')->select('payment.*', 'payment_status.name AS status_name', 'payment_status.color AS status_color')
                    ->whereIn('account_id', $acIds)
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

        $typeStatus = TypeStatus::all();
        $installmentTypes = InstallmentType::all();
        $paymentTypes = PaymentType::all();
        return view('admin.accounting.accounting', compact('accounts', 'typeStatus', 'installmentTypes', 'paymentTypes'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $acc = new Account();
        $acc->user_id = $request->user_id;
        $acc->product = $request->modelProduct;
        $acc->details = $request->details;
        $acc->type = $request->type;
        $acc->type_pay = $request->type_pay;
        $acc->discount = $request->discount;
        $acc->installment = $request->installment;
        $acc->price = $request->price;
        $acc->percen_current = 0;
        // $acc->balance_payment = $request->balance_payment;

        // if ($request->percen_current) {
        //     $percen_current = ((int)$request->installment / (int)$request->price) * 100;
        //     $acc->percen_current = $percen_current;
        // } else {
        //     $acc->percen_current = $request->percen_current;
        // }

        $acc->percen_consider = $request->percen_consider;
        // $acc->amount_consider = $request->price;
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
            $account = Account::where('pc_id', $pcId)->first();
            $account->installment = $request->installment;
            $account->type = $request->type;
            $account->type_pay = $request->type_pay;
            $account->status_type = $request->status_type;
            $account->detail_promotion = $request->detail_promotion;

            $amount_after_discount = (float)$account->price - ((float)$request->discount ?? 0);
            $account->discount = $request->discount;
            $account->amount_after_discount = $amount_after_discount;
            $account->save();
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
        $brands = Brand::all();
        return view('admin.accounting.add_account', compact('users', 'typeStatus', 'installmentType', 'paymentTypes', 'brands'));
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

    protected function renderTable()
    {
        // $accounts = Account::all();
        // $accounts->load('installmentType', 'statusType', 'user', 'paymentType');
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
        $acIds = collect($accounts)->pluck('pc_id')->toArray();

        $payments = DB::table('payment')->select('payment.*', 'payment_status.name AS status_name', 'payment_status.color AS status_color')
                    ->whereIn('account_id', $acIds)
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

        $typeStatus = TypeStatus::all();
        $installmentTypes = InstallmentType::all();
        $paymentTypes = PaymentType::all();
        $html = view('admin.accounting.table.accounting-table', compact('accounts', 'typeStatus', 'installmentTypes', 'paymentTypes'))->render();
        return $html;
    }
}
