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
        $b = Brand::all();
        return response()->json(['status' => true, 'message' => 'success', 'items' => $b]);
    }

    public function getProductByBrandId($bId)
    {
        $pds = Product::where('brand', $bId)->with('brand')->get();
        return response()->json(['status' => true, 'message' => 'success', 'items' => $pds]);
    }

    public function getColorByProductId($pId)
    {
        $sql = "SELECT C.*
                FROM product_details D
                LEFT JOIN product_colors C ON C.id = D.color
                WHERE D.product_id = '$pId'
                GROUP BY D.color";
        $result = DB::select($sql);
        return response()->json(['status' => true, 'message' => 'success', 'items' => $result]);
    }

    public function getCapacityByProductId($pId, $cId)
    {
        $sql = "SELECT C.*
                FROM product_details D
                LEFT JOIN product_capacities C ON C.id = D.capacity
                WHERE D.product_id = '$pId'
                AND D.color = '$cId'
                GROUP BY D.capacity";
        $result = DB::select($sql);
        return response()->json(['status' => true, 'message' => 'success', 'items' => $result]);
    }
}
