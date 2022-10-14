<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColorController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $colors = ProductColor::orderBy('seqno', 'asc')->get();
        return view('admin.setting.color', compact('colors'));
    }

    public function getColorById($cId)
    {
        $color = ProductColor::find($cId);
        return response()->json(['status' => true, 'data' => $color]);
    }

    public function createColor(Request $request)
    {
        try {
            DB::beginTransaction();
            $last = ProductColor::max('seqno');
            ProductColor::create([
                'seqno' => $last + 1,
                'name_th' => $request->name_th,
                'name_en' => $request->name_en,
                'is_active' => $request->is_active == 'on' ? 1 : 0
            ]);
            $html = $this->renderColorTable();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], 500);
        }
    }

    public function updateColorById(Request $request, $cId)
    {
        try {
            DB::beginTransaction();
            ProductColor::where('id', $cId)->update([
                'name_th' => $request->name_th,
                'name_en' => $request->name_en,
                'is_active' => $request->is_active == 'on' ? 1 : 0
            ]);
            $html = $this->renderColorTable();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], 500);
        }
    }

    public function updateActiveById(Request $request, $cId)
    {
        try {
            DB::beginTransaction();
            ProductColor::where('id', $cId)->update([
                'is_active' => $request->is_active == 'on' ? 1 : 0
            ]);
            DB::commit();
            $html = $this->renderColorTable();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable$th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], 500);
        }
    }

    public function deleteColorById($cId)
    {
        try {
            DB::beginTransaction();
            ProductColor::where('id', $cId)->delete();
            $html = $this->renderColorTable();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable$th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], 500);
        }
    }

    protected function renderColorTable()
    {
        $colors = ProductColor::orderBy('seqno', 'asc')->get();
        return view('admin.setting.tables.color-table', compact('colors'))->render();
    }
}
