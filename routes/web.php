<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('login');
});
Route::post('/login',  [App\Http\Controllers\Auth\LoginController::class, 'login']);
Auth::routes();
// Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/dashboard',function (){
        return view('admin.index');
    });
    Route::get('/data_user',function (){
        return view('admin.data_user');
    });
    Route::prefix('accounting')->group(function () {
        Route::get('/', [App\Http\Controllers\AccountController::class, 'index'])->name('accounting.index');

        Route::post('/store', [App\Http\Controllers\AccountController::class, 'store'])->name('accounting.store');
    });
    Route::get('/check_payment',function (){
        return view('admin.check_payment');
    });
    Route::get('/payment',function (){
        return view('admin.payment');
    });
    Route::post('add_user', [App\Http\Controllers\UserController::class, 'adduser'])->name('add.user');
    Route::get('/logout', [App\Http\Controllers\UserController::class, 'logout']);

    Route::get('/register', function () {
        return view('customer/register');
    });
    //Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// });
