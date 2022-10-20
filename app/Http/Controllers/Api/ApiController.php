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
        $pds = Product::where('id', $pId)->with(['details.colors'])->get();
        return response()->json(['status' => true, 'message' => 'success', 'items' => $pds]);
    }
}
