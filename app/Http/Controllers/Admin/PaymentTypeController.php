<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentTypeController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $paymentTypes = PaymentType::orderBy('seqno', 'asc')->get();
        return view('admin.setting.paymentType', compact('paymentTypes'));
    }

    public function getPaymentTypeById($id)
    {
        $paymentTypes = PaymentType::find($id);
        return response()->json(['status' => true, 'data' => $paymentTypes]);
    }

    public function createPaymentType(Request $request)
    {
        try {
            DB::beginTransaction();
            $lastCount = PaymentType::all()->count();
            $newItem = new PaymentType;
            $newItem->seqno = $lastCount;
            $newItem->name = $request->name;
            $newItem->is_active = $request->is_active == 'on' ? 1 : 0;
            $newItem->save();
            $html = $this->renderPaymentTable();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], $th->getCode());
        }
    }

    public function updatePaymentById(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $result = PaymentType::where('id', $id)->update(['name' => $request->name, 'is_active' => $request->is_active == 'on' ? 1 : 0]);
            if ($result) {
                $html = $this->renderPaymentTable();
            }
            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], $th->getCode());
        }
    }

    public function deletePaymentById($id)
    {
        try {
            DB::beginTransaction();
            PaymentType::where('id', $id)->delete();
            $html = $this->renderPaymentTable();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], $th->getCode());
        }
    }

    protected function renderPaymentTable()
    {
        $paymentTypes = PaymentType::orderBy('seqno', 'asc')->get();
        return view('admin.setting.tables.payment-table', compact('paymentTypes'))->render();
    }
}
