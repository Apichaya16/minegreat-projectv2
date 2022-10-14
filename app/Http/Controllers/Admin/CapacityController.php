<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCapacity;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CapacityController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $capacities = ProductCapacity::orderBy('seqno', 'asc')->get();
        return view('admin.setting.capacity', compact('capacities'));
    }

    public function getCapacityById($caId)
    {
        $capacities = ProductCapacity::find($caId);
        return response()->json(['status' => true, 'data' => $capacities]);
    }

    public function createCapacity(Request $request)
    {
        try {
            DB::beginTransaction();
            $last = ProductCapacity::max('seqno');
            ProductCapacity::create([
                'seqno' => $last + 1,
                'size' => $request->size,
                'is_active' => $request->is_active == 'on' ? 1 : 0
            ]);
            $html = $this->renderCapacityTable();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], 500);
        }
    }

    public function updateCapacityById(Request $request, $caId)
    {
        try {
            DB::beginTransaction();
            ProductCapacity::where('id', $caId)->update([
                'size' => $request->size,
                'is_active' => $request->is_active == 'on' ? 1 : 0
            ]);
            $html = $this->renderCapacityTable();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], 500);
        }
    }

    public function updateActiveById(Request $request, $caId)
    {
        try {
            DB::beginTransaction();
            ProductCapacity::where('id', $caId)->update([
                'is_active' => $request->is_active == 'on' ? 1 : 0
            ]);
            DB::commit();
            $html = $this->renderCapacityTable();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable$th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], 500);
        }
    }

    public function deleteCapacityById($caId)
    {
        try {
            DB::beginTransaction();
            ProductCapacity::where('id', $caId)->delete();
            $html = $this->renderCapacityTable();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable$th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], 500);
        }
    }

    protected function renderCapacityTable()
    {
        $capacities = ProductCapacity::orderBy('seqno', 'asc')->get();
        return view('admin.setting.tables.capacity-table', compact('capacities'))->render();
    }
}
