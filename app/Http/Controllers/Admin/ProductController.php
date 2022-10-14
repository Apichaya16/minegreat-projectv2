<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCapacity;
use App\Models\ProductColor;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $products = Product::orderBy('brand', 'asc')->with('details.colors', 'details.capacities')->get();
        $colors = ProductColor::where('is_active', 1)->orderBy('seqno', 'asc')->get();
        $capacites = ProductCapacity::where('is_active', 1)->orderBy('seqno', 'asc')->get();
        return view('admin.setting.product', compact('products', 'colors', 'capacites'));
    }

    public function getProductById($pId)
    {
        $products = Product::where('id', $pId)->with('details.colors', 'details.capacities')->first();
        return response()->json(['status' => true, 'data' => $products]);
    }

    public function createProduct(Request $request)
    {
        try {
            DB::beginTransaction();
            $newItem = new Product;
            $newItem->brand = $request->brand;
            $newItem->name_th = $request->name_th;
            $newItem->name_en = $request->name_en;
            $newItem->desc_th = $request->desc_th;
            $newItem->desc_en = $request->desc_en;
            $newItem->is_active = $request->is_active == 'on' ? 1 : 0;
            $newItem->save();

            if (isset($request->product_detail) && count($request->product_detail) > 0) {
                foreach ($request->product_detail as $pd) {
                    foreach ($pd['capacity'] as $ca) {
                        ProductDetail::create([
                            'product_id' => $newItem->id,
                            'color' => $pd['color'],
                            'capacity' => $ca,
                        ]);
                    }
                }
            }
            DB::commit();

            $html = $this->renderProductTable();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable$th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], 500);
        }
    }

    public function updateProductById(Request $request, $pId)
    {
        try {
            DB::beginTransaction();
            // dd($request->is_active);
            $result = Product::where('id', $pId)->update([
                'brand' => $request->brand,
                'name_th' => $request->name_th,
                'name_en' => $request->name_en,
                'desc_th' => $request->desc_th,
                'desc_en' => $request->desc_en,
                'is_active' => $request->is_active == 'on' ? 1 : 0,
            ]);
            if ($result) {
                if (isset($request->product_detail) && count($request->product_detail) > 0) {
                    foreach ($request->product_detail as $pd) {
                        $olds = ProductDetail::where('product_id', $pId)->where('color', $pd['color'])->withTrashed()->get();
                        foreach ($olds as $old) {
                            if (!in_array($old->capacity, $pd['capacity'])) {
                                $old->delete();
                            } else if (isset($old->deleted_at)) {
                                $old->restore();
                            }
                        }

                        $result = ProductDetail::where('product_id', $pId)->where('color', $pd['color'])->first();
                        if (!$result) {
                            foreach ($pd['capacity'] as $ca) {
                                ProductDetail::create([
                                    'product_id' => $pId,
                                    'color' => $pd['color'],
                                    'capacity' => $ca,
                                ]);
                            }
                        }
                    }
                }
            }
            DB::commit();
            $html = $this->renderProductTable();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable$th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], 500);
        }
    }

    public function updateActiveById(Request $request, $pId)
    {
        try {
            DB::beginTransaction();
            Product::where('id', $pId)->update([
                'is_active' => $request->is_active == 'on' ? 1 : 0,
            ]);
            DB::commit();
            $html = $this->renderProductTable();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable$th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], 500);
        }
    }

    public function deleteProductById($pId)
    {
        try {
            DB::beginTransaction();
            Product::where('id', $pId)->delete();
            $html = $this->renderProductTable();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable$th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], 500);
        }
    }

    protected function renderProductTable()
    {
        $products = Product::orderBy('brand', 'asc')->with('details.colors', 'details.capacities')->get();
        return view('admin.setting.tables.product-table', compact('products'))->render();
    }
}
