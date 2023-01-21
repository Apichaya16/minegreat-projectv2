<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

            Route::get('create',  [App\Http\Controllers\AccountController::class, 'add_account'])->name('admin.create.accounting');
            Route::put('update/{pcId}', [App\Http\Controllers\AccountController::class, 'update_account'])->name('admin.update.accounting');
            Route::delete('delete/{pcId}', [App\Http\Controllers\AccountController::class, 'del_acc'])->name('admin.delete.accounting');

            Route::prefix('payment')->group(function () {
                Route::get('/',  [App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('admin.accounting.payment.index');
                Route::get('/getPaymentById/{pId}', [\App\Http\Controllers\Admin\PaymentController::class, 'getPaymentById'])->name('admin.accounting.payment.getPaymentById');
                Route::get('/getOrderNumberByPaymentId/{accountId}', [\App\Http\Controllers\Admin\PaymentController::class, 'getOrderNumberByPaymentId'])->name('admin.accounting.payment.getOrderNumberByPaymentId');
                Route::post('/create_payment', [\App\Http\Controllers\Admin\PaymentController::class, 'create_payment'])->name('admin.accounting.payment.create_payment');
                Route::post('/update_payment/{pId}', [\App\Http\Controllers\Admin\PaymentController::class, 'update_payment'])->name('admin.accounting.payment.update_payment');
                Route::delete('/delete_payment/{pId}', [App\Http\Controllers\Admin\PaymentController::class, 'delete_payment'])->name('admin.accounting.payment.delete_payment');
            });
        });

        Route::prefix('payment/list')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\PaymentListController::class, 'index'])->name('admin.payment.list.index');
        });

        Route::prefix('approve')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\ApproveController::class, 'index'])->name('admin.approve.index');
            Route::get('getAccountDetailById/{id}', [App\Http\Controllers\Admin\ApproveController::class, 'getAccountDetailById'])->name('admin.approve.getAccountDetailById');
            Route::put('update/{id}', [App\Http\Controllers\Admin\ApproveController::class, 'update'])->name('admin.approve.update');
        });

        // Route::get('/check_payment', function () {
        //     return view('admin.check_payment');
        // })->name('admin.check.payment');

        Route::prefix('setting')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin.setting.index');

            Route::prefix('installment')->group(function () {
                Route::get('/getInstallmentById/{id}', [App\Http\Controllers\Admin\InstallmentController::class, 'getInstallmentById'])->name('admin.setting.getInstallmentById');
                Route::post('/createInstallment', [App\Http\Controllers\Admin\InstallmentController::class, 'createInstallment'])->name('admin.setting.createInstallment');
                Route::put('/updateInstallmentById/{id}', [App\Http\Controllers\Admin\InstallmentController::class, 'updateInstallmentById'])->name('admin.setting.updateInstallmentById');
                Route::delete('/deleteInstallmentById/{id}', [App\Http\Controllers\Admin\InstallmentController::class, 'deleteInstallmentById'])->name('admin.setting.deleteInstallmentById');
            });
            Route::prefix('payment')->group(function () {
                Route::get('/getPaymentTypeById/{id}', [App\Http\Controllers\Admin\PaymentTypeController::class, 'getPaymentTypeById'])->name('admin.setting.getPaymentTypeById');
                Route::post('/createPaymentType', [App\Http\Controllers\Admin\PaymentTypeController::class, 'createPaymentType'])->name('admin.setting.createPaymentType');
                Route::put('/updatePaymentById/{id}', [App\Http\Controllers\Admin\PaymentTypeController::class, 'updatePaymentById'])->name('admin.setting.updatePaymentById');
                Route::delete('/deletePaymentById/{id}', [App\Http\Controllers\Admin\PaymentTypeController::class, 'deletePaymentById'])->name('admin.setting.deletePaymentById');
            });
            Route::prefix('product')->group(function () {
                Route::get('/getProductById/{pId}', [App\Http\Controllers\Admin\ProductController::class, 'getProductById'])->name('admin.setting.getProductById');
                Route::post('/createProduct', [App\Http\Controllers\Admin\ProductController::class, 'createProduct'])->name('admin.setting.createProduct');
                Route::put('/updateProductById/{pId}', [App\Http\Controllers\Admin\ProductController::class, 'updateProductById'])->name('admin.setting.updateProductById');
                Route::put('/updateActiveById/{pId}', [App\Http\Controllers\Admin\ProductController::class, 'updateActiveById'])->name('admin.setting.updateActiveById');
                Route::delete('/deleteProductById/{pId}', [App\Http\Controllers\Admin\ProductController::class, 'deleteProductById'])->name('admin.setting.deleteProductById');
            });
            Route::prefix('color')->group(function () {
                Route::get('/getColorById/{cId}', [App\Http\Controllers\Admin\ColorController::class, 'getColorById'])->name('admin.setting.color.getColorById');
                Route::post('/createColor', [App\Http\Controllers\Admin\ColorController::class, 'createColor'])->name('admin.setting.color.createColor');
                Route::put('/updateColorById/{cId}', [App\Http\Controllers\Admin\ColorController::class, 'updateColorById'])->name('admin.setting.color.updateColorById');
                Route::put('/updateActiveById/{cId}', [App\Http\Controllers\Admin\ColorController::class, 'updateActiveById'])->name('admin.setting.color.updateActiveById');
                Route::delete('/deleteColorById/{cId}', [App\Http\Controllers\Admin\ColorController::class, 'deleteColorById'])->name('admin.setting.color.deleteColorById');
            });
            Route::prefix('capacity')->group(function () {
                Route::get('/getCapacityById/{caId}', [App\Http\Controllers\Admin\CapacityController::class, 'getCapacityById'])->name('admin.setting.capacity.getCapacityById');
                Route::post('/createCapacity', [App\Http\Controllers\Admin\CapacityController::class, 'createCapacity'])->name('admin.setting.capacity.createCapacity');
                Route::put('/updateCapacityById/{caId}', [App\Http\Controllers\Admin\CapacityController::class, 'updateCapacityById'])->name('admin.setting.capacity.updateCapacityById');
                Route::put('/updateActiveById/{caId}', [App\Http\Controllers\Admin\CapacityController::class, 'updateActiveById'])->name('admin.setting.capacity.updateActiveById');
                Route::delete('/deleteCapacityById/{caId}', [App\Http\Controllers\Admin\CapacityController::class, 'deleteCapacityById'])->name('admin.setting.capacity.deleteCapacityById');
            });
            Route::prefix('brand')->group(function () {
                Route::get('/getBrandById/{brId}', [App\Http\Controllers\Admin\BrandController::class, 'getBrandById'])->name('admin.setting.brand.getBrandById');
                Route::post('/createBrand', [App\Http\Controllers\Admin\BrandController::class, 'createBrand'])->name('admin.setting.brand.createBrand');
                Route::put('/updateBrandById/{brId}', [App\Http\Controllers\Admin\BrandController::class, 'updateBrandById'])->name('admin.setting.brand.updateBrandById');
                Route::put('/updateActiveById/{brId}', [App\Http\Controllers\Admin\BrandController::class, 'updateActiveById'])->name('admin.setting.brand.updateActiveById');
                Route::delete('/deleteBrandById/{brId}', [App\Http\Controllers\Admin\BrandController::class, 'deleteBrandById'])->name('admin.setting.brand.deleteBrandById');
            });
        });

        Route::get('/register', function () {
            return view('customer/register');
        });

        // -----customer-----

        Route::get('/myaccount', [App\Http\Controllers\MyaccountController::class, 'index'])->name('myaccount.index');

        //RegisterCustomer
        // Route::get('/customer/register', [App\Http\Controllers\Auth\RegisterController::class, 'customerRegister'])->name('customer.register');

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

        Route::prefix('auth')->group(function () {
            Route::get('/login', function () {
                return view('auth.customer-login');
            })->name('customer.login');

            Route::get('/register', function () {
                return view('auth.customer-register');
            })->name('customer.register');
        });

        Route::get('/abount', function () {
            return view('customer.abount.index');
        })->name('customer.abount');

        Route::get('/contact', function () {
            return view('customer.contact.index');
        })->name('customer.contact');

        Route::get('/evalution', function () {
            return view('customer.evalution.index');
        })->name('customer.evalution.index');

        Route::get('/payment-detail', function () {
            return view('customer.payment-detail.index');
        })->name('customer.payment.detail');

        Route::get('/payment-condition', function () {
            return view('customer.payment-detail.condition');
        })->name('customer.payment.condition');

        Route::middleware('auth')->group(function () {
            Route::get('/register', function () {
                return view('customer.payment.payment-register');
            })->name('customer.payment.register');

            Route::prefix('payment')->group(function () {
                Route::get('/', [App\Http\Controllers\PaymentController::class, 'index'])->name('customer.payment.index');
                Route::get('/getPaymentDetailById/{pId}', [App\Http\Controllers\PaymentController::class, 'getPaymentDetailById'])->name('customer.payment.getPaymentDetailById');
                Route::get('/{accId}', [App\Http\Controllers\PaymentController::class, 'create'])->name('customer.payment.create');

                Route::get('/getPaymentById/{pId}', [App\Http\Controllers\PaymentController::class, 'getPaymentById'])->name('customer.payment.getPaymentById');
                Route::post('/create', [App\Http\Controllers\PaymentController::class, 'storePayment'])->name('customer.payment.storePayment');
                Route::post('/update/{pId}', [App\Http\Controllers\PaymentController::class, 'updatePaymentById'])->name('customer.payment.updatePaymentById');
                Route::delete('/delete/{pId}', [App\Http\Controllers\PaymentController::class, 'deletePayment'])->name('customer.payment.deletePayment');
            });
        });

    }
);
