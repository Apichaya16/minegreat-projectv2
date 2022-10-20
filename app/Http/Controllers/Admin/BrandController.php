<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $brands = Brand::orderBy('seqno', 'asc')->get();
        return view('admin.setting.brand', compact('brands'));
    }

    public function createBrand(Request $request)
    {
        try {
            DB::beginTransaction();
            $last = Brand::max('seqno');
            Brand::create([
                'seqno' => $last + 1,
                'name_th' => $request->name_th,
                'name_en' => $request->name_en,
                'is_active' => $request->is_active == 'on' ? 1 : 0
            ]);
            $html = $this->renderBrandTable();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
             DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], 500);
        }
    }

    public function updateBrandById(Request $request, $brId)
    {
        try {
            DB::beginTransaction();
            Brand::where('id', $brId)->update([
                'name_th' => $request->name_th,
                'name_en' => $request->name_en,
                'is_active' => $request->is_active == 'on' ? 1 : 0
            ]);
            $html = $this->renderBrandTable();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
             DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], 500);
        }
    }

    public function updateActiveById(Request $request, $brId)
    {
        try {
            DB::beginTransaction();
            Brand::where('id', $brId)->update([
                'is_active' => $request->is_active == 'on' ? 1 : 0
            ]);
            $html = $this->renderBrandTable();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
             DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], 500);
        }
    }

    public function deleteBrandById($brId)
    {
        try {
            DB::beginTransaction();
            Brand::where('id', $brId)->delete();
            $html = $this->renderBrandTable();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
             DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], 500);
        }
    }

    public function renderBrandTable()
    {
        $brands = Brand::orderBy('seqno', 'asc')->get();
        return view('admin.setting.tables.brand-table', compact('brands'))->render();
    }
}
