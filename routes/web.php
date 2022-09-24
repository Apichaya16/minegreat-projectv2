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

Route::get('/theme', function () {
    return view('index');
});

Route::get('/backend/auth/login', function () {
    return view('auth.login');
})->name('admin.login');

Route::get('/customer/auth/login', function () {
    return view('auth.customer-login');
})->name('customer.login');

Route::group(
    [
        'middleware'=> ['auth', 'check_admin'],
        'prefix' => 'backend'
    ],
    function () {

        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

        Route::prefix('user')->group(function () {
            Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('admin.user.index');
            Route::get('create', [App\Http\Controllers\UserController::class, 'create'])->name('admin.create.user');
            Route::post('store', [App\Http\Controllers\UserController::class, 'store'])->name('admin.create.user.store');
            // Route::get('/{userId}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('admin.edit.user');
            Route::get('/getUserById/{userId}', [App\Http\Controllers\UserController::class, 'getUserById'])->name('admin.detail.user');
            Route::put('update/{userId}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.update.user');
            Route::delete('delete/{userId}', [App\Http\Controllers\UserController::class, 'detroy'])->name('admin.delete.user');
        });

        Route::prefix('accounting')->group(function () {
            Route::get('/', [App\Http\Controllers\AccountController::class, 'index'])->name('admin.accounting.index');
            Route::post('store', [App\Http\Controllers\AccountController::class, 'store'])->name('admin.accounting.store');
            Route::get('payment',  [App\Http\Controllers\AccountController::class, 'payment'])->name('admin.accounting.payment');

            Route::get('create',  [App\Http\Controllers\AccountController::class, 'add_account'])->name('admin.create.accounting');
            Route::put('update/{pcId}', [App\Http\Controllers\AccountController::class, 'update_account'])->name('admin.update.accounting');
            Route::delete('delete/{pcId}', [App\Http\Controllers\AccountController::class, 'del_acc'])->name('admin.delete.accounting');
        });

        Route::get('/check_payment', function () {
            return view('admin.check_payment');
        })->name('admin.check.payment');

        Route::post('/add_payment/{id}', [\App\Http\Controllers\AccountController::class, 'add_payment'])->name('account.add_payment');
        Route::post('/del_payment', [App\Http\Controllers\AccountController::class, 'del_payment'])->name('del.payment');

        Route::prefix('setting')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin.setting.index');
            Route::get('/getInstallmentById/{id}', [App\Http\Controllers\Admin\SettingController::class, 'getInstallmentById'])->name('admin.setting.getInstallmentById');
            Route::post('/createInstallment', [App\Http\Controllers\Admin\SettingController::class, 'createInstallment'])->name('admin.setting.createInstallment');
            Route::put('/updateInstallmentById/{id}', [App\Http\Controllers\Admin\SettingController::class, 'updateInstallmentById'])->name('admin.setting.updateInstallmentById');
            Route::delete('/deleteInstallmentById/{id}', [App\Http\Controllers\Admin\SettingController::class, 'deleteInstallmentById'])->name('admin.setting.deleteInstallmentById');
        });

        Route::get('/register', function () {
            return view('customer/register');
        });

        // -----customer-----

        Route::get('/myaccount', [App\Http\Controllers\MyaccountController::class, 'index'])->name('myaccount.index');


        // Route::get('/myaccount', function () {
        //     return view('customer.myaccount');
        // });

        Route::get('/admincontact', function () {
            return view('customer.admincontact');
        });
    }
);
//

Route::get('/', function () {
    return view('customer.home.index');
})->name('customer.home');

Route::group(
    [
        'prefix' => 'customer'
    ],
    function () {

        Route::get('/abount', function () {
            return view('customer.abount.index');
        })->name('customer.abount');

        Route::get('/contact', function () {
            return view('customer.contact.index');
        })->name('customer.contact');

    }
);
