<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InstallmentType;
use App\Models\PaymentType;
use App\Models\Product;
use App\Models\ProductCapacity;
use App\Models\ProductColor;
use App\Models\ProductDetail;
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
                $paymentTypes = PaymentType::orderBy('seqno', 'asc')->get();
                return view('admin.setting.paymentType', compact('paymentTypes'));
            case 'product':
                $products = Product::orderBy('brand','asc')->with('colorMaps.color', 'capacityMaps.capacity')->get();
                // dd($products);
                $colors = ProductColor::where('is_active', 1)->get();
                $capacites = ProductCapacity::where('is_active', 1)->get();
                return view('admin.setting.product', compact('products', 'colors', 'capacites'));
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
