<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('product')->group(function () {
    Route::get('getBrands', [App\Http\Controllers\Api\ApiController::class, 'getBrands'])->name('api.product.getBrands');
    Route::get('getProductByBrandId/{bId}', [App\Http\Controllers\Api\ApiController::class, 'getProductByBrandId'])->name('api.product.getProductByBrandId');
    Route::get('getColorByProductId/{pId}', [App\Http\Controllers\Api\ApiController::class, 'getColorByProductId'])->name('api.product.getColorByProductId');
    Route::get('getCapacityByProductId/{pId}/{cId}', [App\Http\Controllers\Api\ApiController::class, 'getCapacityByProductId'])->name('api.product.getCapacityByProductId');
    Route::get('getPriceByProduct', [App\Http\Controllers\Api\ApiController::class, 'getPriceByProduct'])->name('api.product.getPriceByProduct');
});
Route::prefix('chart')->group(function () {
    Route::get('getProductChart', [App\Http\Controllers\Api\ApiController::class, 'getProductChart'])->name('api.chart.getProductChart');
    Route::get('getInstallmentTypeChart', [App\Http\Controllers\Api\ApiController::class, 'getInstallmentTypeChart'])->name('api.chart.getInstallmentTypeChart');
});
