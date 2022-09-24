<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InstallmentType;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $page = $request->get('page');
        switch ($page) {
            case 'installment':
                $installmentTypes = InstallmentType::orderBy('seqno', 'asc')->get();
                return view('admin.setting.installmentType', compact('installmentTypes'));
            case 'payment':
                $paymentTypes = PaymentType::all();
                return view('admin.setting.paymentType', compact('paymentTypes'));
            default:
                # code...
                break;
        }
    }

    public function getInstallmentById($id)
    {
        $installment = InstallmentType::find($id);
        return response()->json(['status' => true, 'data' => $installment]);
    }

    public function createInstallment(Request $request)
    {
        try {
            DB::beginTransaction();
            $lastCount = InstallmentType::all()->count();
            $newItem = new InstallmentType;
            $newItem->seqno = $lastCount;
            $newItem->name = $request->name;
            $newItem->is_active = $request->is_active == 'on' ? 1 : 0;
            $newItem->save();
            $html = $this->renderInstallmentTable();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], $th->getCode());
        }
    }

    public function updateInstallmentById(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $result = InstallmentType::where('it_id', $id)->update(['name' => $request->name, 'is_active' => $request->is_active == 'on' ? 1 : 0]);
            if ($result) {
                $html = $this->renderInstallmentTable();
            }
            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], $th->getCode());
        }
    }

    public function deleteInstallmentById($id)
    {
        try {
            DB::beginTransaction();
            InstallmentType::where('it_id', $id)->delete();
            $html = $this->renderInstallmentTable();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], $th->getCode());
        }
    }

    protected function renderInstallmentTable()
    {
        $installmentTypes = InstallmentType::orderBy('seqno', 'asc')->get();
        return view('admin.setting.tables.installment-table', compact('installmentTypes'))->render();
    }
}
