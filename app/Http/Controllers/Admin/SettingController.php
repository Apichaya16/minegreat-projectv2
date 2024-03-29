<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
                $installment = new InstallmentController();
                return $installment->index();
            case 'payment':
                $paymentTypes = new PaymentTypeController();
                return $paymentTypes->index();
            case 'product':
                $product = new ProductController();
                return $product->index();
            case 'color':
                $color = new ColorController();
                return $color->index();
            case 'capacity':
                $capacity = new CapacityController();
                return $capacity->index();
            case 'brand':
                $brand = new BrandController();
                return $brand->index();
            default:
                return abort(404);
        }
    }
}
