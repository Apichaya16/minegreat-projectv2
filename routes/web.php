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


Auth::routes(); 
Route::group(['middleware'=>'auth'],function () {
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('login');
// });
Route::get('/', function () {
    return view('admin.index');
})->name('admin.home'); 
Route::get('/data_user', [App\Http\Controllers\UserController::class, 'index'])->name('data_user.index');

Route::prefix('accounting')->group(function () {
    Route::get('/', [App\Http\Controllers\AccountController::class, 'index'])->name('accounting.index');
    Route::post('/store', [App\Http\Controllers\AccountController::class, 'store'])->name('accounting.store');
});

Route::get('/payment',  [App\Http\Controllers\AccountController::class, 'payment'])->name('accounting.payment');
Route::get('/check_payment', function () {
    return view('admin.check_payment');
});

Route::post('/add_payment/{id}', [\App\Http\Controllers\AccountController::class, 'add_payment'])->name('account.add_payment');
Route::post('/del_payment', [App\Http\Controllers\AccountController::class, 'del_payment'])->name('del.payment');

Route::post('{id?}/add_user', [App\Http\Controllers\UserController::class, 'adduser'])->name('add.user');

Route::get('/register', function () {
    return view('customer/register');
});

Route::get('/add_data/{id?}', [App\Http\Controllers\UserController::class, 'form_user'])->name('edit.user');

// -----customer-----

Route::get('/myaccount', [App\Http\Controllers\MyaccountController::class, 'index'])->name('myaccount.index');


// Route::get('/myaccount', function () {
//     return view('customer.myaccount');
// });

Route::get('/admincontact', function () {
    return view('customer.admincontact');
});

// -----customer

Route::get('/add_account',  [App\Http\Controllers\AccountController::class, 'add_account']);
Route::post('update_account/{pcId}', [App\Http\Controllers\AccountController::class, 'update_account'])->name('update.acc');
Route::post('del_acc', [App\Http\Controllers\AccountController::class, 'del_acc'])->name('del.acc');

Route::post('del_user', [App\Http\Controllers\UserController::class, 'del_user'])->name('del.user');
    //Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
// 