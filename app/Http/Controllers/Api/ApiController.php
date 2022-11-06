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
                AND D.color = ?";
        $result = DB::select($sql, [$pId, $cId]);
        return response()->json(['status' => true, 'message' => 'success', 'items' => $result]);
    }
}
