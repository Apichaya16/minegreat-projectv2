<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\TypeStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApproveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $accounts = Account::where('status_type', 9)->with(['user', 'products'])->orderBy('created_at', 'desc')->get();
        $status = TypeStatus::all();
        return view('admin.approve.index', compact(['accounts', 'status']));
    }

    public function getAccountDetailById($id)
    {
        $accounts = Account::find($id);
        if ($accounts) {
            $accounts->load(['user', 'products']);
        }
        return response()->json(['status' => true, 'message' => 'success', 'data' => $accounts]);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $acc = Account::find($id);
            if ($request->discount) {
                $balance = (int)$acc->price - (float)$request->discount;

                // $sum = (int)$acc->installment + (float)$request->discount;
                // $percen_current = ($sum / (int)$acc->price) * 100;
            } else {
                $balance = (int)$acc->price;

                // $percen_current = ((int)$acc->installment / $acc->price) * 100;
            }

            $acc = Account::find($id)->update([
                'discount' => $request->discount,
                'status_type' => $request->status_type,
                // 'balance_payment' => $balance,
                // 'percen_current' => $percen_current,
                'percen_consider' => $request->percen_consider,
                'amount_after_discount' => $balance
            ]);

            $html = $this->renderTable();

            DB::commit();

            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }

    protected function renderTable()
    {
        $accounts = Account::where('status_type', 9)->with(['user', 'products'])->orderBy('created_at', 'desc')->get();
        return view('admin.approve.table.approve-table', compact(['accounts']))->render();
    }
}
