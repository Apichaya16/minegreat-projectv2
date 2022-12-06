<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function getBrands()
    {
        $b = Brand::where('is_active', 1)->get();
        return response()->json(['status' => true, 'message' => 'success', 'items' => $b]);
    }

    public function getProductByBrandId($bId)
    {
        $pds = Product::where('brand', $bId)->with('brands')->get();
        return response()->json(['status' => true, 'message' => 'success', 'items' => $pds]);
    }

    public function getColorByProductId($pId)
    {
        $sql = "SELECT C.*
                FROM product_details D
                LEFT JOIN product_colors C ON C.id = D.color
                WHERE D.product_id = ?
                AND D.is_active = 1
                AND D.deleted_at IS NULL
                GROUP BY D.color";
        $result = DB::select($sql, [$pId]);
        return response()->json(['status' => true, 'message' => 'success', 'items' => $result]);
    }

    public function getCapacityByProductId($pId, $cId)
    {
        $sql = "SELECT C.*, D.price
                FROM product_details D
                LEFT JOIN product_capacities C ON C.id = D.capacity
                WHERE D.product_id = ?
                AND D.color = ?
                AND D.is_active = 1
                AND D.deleted_at IS NULL";
        $result = DB::select($sql, [$pId, $cId]);
        return response()->json(['status' => true, 'message' => 'success', 'items' => $result]);
    }

    public function getPriceByProduct(Request $request)
    {
        $sql = "SELECT D.price
                FROM product_details D
                WHERE D.product_id = ?
                AND D.capacity = ?
                AND D.color = ?
                AND D.is_active = 1
                AND D.deleted_at IS NULL";
        $result = collect(DB::select($sql, [$request->product_id, $request->capacity_id, $request->color_id]))->first();
        return response()->json(['status' => true, 'message' => 'success', 'data' => $result]);
    }

    public function getProductChart()
    {
        $sql = "SELECT p.name_th , p.name_en , COUNT(a.pc_id) AS product_count
                FROM products p
                LEFT JOIN accounts a ON a.product = p.id
                WHERE p.is_active = 1
                AND p.deleted_at IS NULL
                AND a.deleted_at IS NULL
                GROUP BY p.id
                HAVING COUNT(a.pc_id) > 0
                ORDER BY COUNT(a.pc_id) DESC";
        $datas = collect(DB::select($sql))->take(10);
        return response()->json(['status' => true, 'datas' => $datas]);
    }

    public function getInstallmentTypeChart()
    {
        $sql = "SELECT it.seqno , it.name , COUNT(a.pc_id) AS installment_type_count
                FROM installment_types it
                LEFT JOIN accounts a ON a.`type` = it.it_id
                WHERE it.is_active = 1
                AND it.deleted_at IS NULL
                AND a.deleted_at IS NULL
                GROUP BY it.it_id
                ORDER BY it.seqno";
        $datas = DB::select($sql);
        return response()->json(['status' => true, 'datas' => $datas]);
    }
}
