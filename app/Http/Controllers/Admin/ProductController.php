<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InstallmentType;
use App\Models\PaymentType;
use App\Models\Product;
use App\Models\ProductCapacityMaps;
use App\Models\ProductColorMaps;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {

    }

    public function getProductById($id)
    {
        $products = Product::where('id', $id)->with('colorMaps.color', 'capacityMaps.capacity')->first();
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

            if (isset($request->colors) && count($request->colors) > 0) {
                foreach ($request->colors as $c) {
                    $detail = new ProductDetail;
                    $detail->product_id = $newItem->id;
                    $detail->color = $c;
                    $detail->save();
                }
            }
            if (isset($request->capacities) && count($request->capacities) > 0) {
                foreach ($request->capacities as $ca) {
                    $detail = new ProductDetail;
                    $detail->product_id = $newItem->id;
                    $detail->capacity = $ca;
                    $detail->save();
                }
            }

            DB::commit();

            $html = $this->renderProductTable();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], 500);
        }
    }

    public function updateProductById(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $result = Product::where('id', $id)->update([
                'brand' => $request->brand,
                'name_th' => $request->name_th,
                'name_en' => $request->name_en,
                'desc_th' => $request->desc_th,
                'desc_en' => $request->desc_en
            ]);
            if ($result) {
                if (isset($request->colors) && count($request->colors) > 0) {
                    ProductColorMaps::where('product_id', $id)->delete();
                    foreach ($request->colors as $c) {
                        ProductColorMaps::create([
                            'product_id' => $id,
                            'color_id' => $c
                        ]);
                    }
                }
                if (isset($request->capacities) && count($request->capacities) > 0) {
                    ProductCapacityMaps::where('product_id', $id)->delete();
                    foreach ($request->capacities as $ca) {
                        ProductCapacityMaps::create([
                            'product_id' => $id,
                            'capacity_id' => $ca
                        ]);
                    }
                }
            }
            DB::commit();
            $html = $this->renderProductTable();
            return response()->json(['status' => true, 'message' => 'success', 'html' => $html]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], 500);
        }
    }

    public function deleteProductById($id)
    {
        try {
            DB::beginTransaction();
            Product::where('id', $id)->delete();
            // $html = $this->renderProductTable();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'html' => '']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage(), 'html' => null], 500);
        }
    }

    protected function renderProductTable()
    {
        $products = Product::orderBy('brand','asc')->get();
        return view('admin.setting.tables.product-table', compact('products'))->render();
    }
}
