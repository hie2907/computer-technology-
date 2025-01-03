<?php

use App\Http\Controllers\AccountAdminDashboard;
use App\Http\Controllers\AccountEmployeeDashboard;
use App\Http\Controllers\AccountRoleDashboard;
use App\Http\Controllers\AccountShipperDashboard;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminBrandController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CategoryClient;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\ClientCart;
use App\Http\Controllers\ClientPayment;
use App\Http\Controllers\ClientProfile;
use App\Http\Controllers\DetailProductClient;
use App\Http\Controllers\HomeClient;
use App\Models\Category;
use Illuminate\Http\Request;

// Authencation Admin
Route::prefix('admin')->group(function () {
    Route::get('/register', function () {
        return view('admin.auth.register');
    })->name('admin.register.form');

    Route::post('/register', [AdminAuthController::class, 'register'])->name('admin.register');
    Route::get('/login', function () {
        return view('admin.auth.login');
    })->name('admin.login.form');

    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login');

    Route::post('/logout', [AdminAuthController::class, 'logout'])
        ->name('admin.logout')
        ->middleware('adminAuth');
});
// Middleware cho tất cả các route của admin
Route::middleware('adminAuth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::group(['middleware' => ['role:admin']], function () {
        //Role
        Route::prefix('admin/account/role')->group(function () {
            Route::get('/', [AccountRoleDashboard::class, 'index'])->name('admin.account.role');
            Route::get('/updaterole/{adminID}', [AccountRoleDashboard::class, 'update'])->name('admin.account.role.updaterole');
            Route::post('/postupdaterole/{adminID}', [AccountRoleDashboard::class, 'postupdate'])->name('admin.account.role.postupdaterole');
        });
        // Account Admin
        Route::prefix('admin/account/admin')->group(function () {
            Route::get('/', [AccountAdminDashboard::class, 'index'])->name('admin.account.admin');
            Route::get('/updateadmin/{adminID}', [AccountAdminDashboard::class, 'update'])->name('admin.account.admin.updateadmin');
            Route::post('/postupdateadmin/{adminID}', [AccountAdminDashboard::class, 'postupdate'])->name('admin.account.admin.postupdateadmin');
        });
    });
    // Routes cho Employee
    Route::group(['middleware' => ['role:admin,employee']], function () {
        // Categories
        Route::prefix('admin/product/category')->group(function () {
            Route::get('/', [AdminCategoryController::class, 'index'])->name('admin.products.category');
            Route::get('/addcategory', [AdminCategoryController::class, 'create'])->name('admin.products.category.addcategory');
            Route::post('/postaddcategory', [AdminCategoryController::class, 'addcategory'])->name('admin.products.category.postaddcategory');
            Route::get('/updatecategory/{categoryId}', [AdminCategoryController::class, 'update'])->name('admin.products.category.updatecategory');
            Route::post('/postupdatecategory/{categoryId}', [AdminCategoryController::class, 'postupdate'])->name('admin.products.category.postupdatecategory');
            Route::delete('/deletecategory/{categoryId}', [AdminCategoryController::class, 'delete'])->name('admin.products.category.deletecategory');
        });

        // Brands
        Route::prefix('admin/product/brands')->group(function () {
            Route::get('/', [AdminBrandController::class, 'index'])->name('admin.products.brand');
            Route::get('/addbrand', [AdminBrandController::class, 'create'])->name('admin.products.brand.addbrand');
            Route::post('/postaddbrand', [AdminBrandController::class, 'addbrand'])->name('admin.products.brand.postaddbrand');
            Route::get('/updatebrand/{brandId}', [AdminBrandController::class, 'update'])->name('admin.products.brand.updatebrand');
            Route::post('/postupdatebrand/{brandId}', [AdminBrandController::class, 'postupdate'])->name('admin.products.brand.postupdatebrand');
            Route::delete('/deletebrand/{brandId}', [AdminBrandController::class, 'delete'])->name('admin.products.brand.deletebrand');
        });

        //Product
        Route::prefix('admin/product/products')->group(function () {
            Route::get('/', [AdminProductController::class, 'index'])->name('admin.products.products');
            Route::get('/addproduct', [AdminProductController::class, 'create'])->name('admin.products.products.addproduct');
            Route::post('/postaddproduct', [AdminProductController::class, 'addproduct'])->name('admin.products.products.postaddproduct');
            Route::get('/updateproduct/{productId}', [AdminProductController::class, 'update'])->name('admin.products.products.updateproduct');
            Route::post('/postupdateproduct/{productId}', [AdminProductController::class, 'postupdate'])->name('admin.products.products.postupdateproduct');
            Route::delete('/deleteproduct/{productId}', [AdminProductController::class, 'delete'])->name('admin.products.products.deleteproduct');
        });

        //Account Emplopyee
        Route::prefix('admin/account/employee')->group(function () {
            Route::get('/', [AccountEmployeeDashboard::class, 'index'])->name('admin.account.employee');
            Route::get('/addemployee', [AccountEmployeeDashboard::class, 'create'])->name('admin.account.employee.addemployee');
            Route::post('/postaddemployee', [AccountEmployeeDashboard::class, 'addemployee'])->name('admin.account.employee.postaddemployee');
            Route::get('/updateemployee/{adminID}', [AccountEmployeeDashboard::class, 'update'])->name('admin.account.employee.updateemployee');
            Route::post('/postupdateemployee/{adminID}', [AccountEmployeeDashboard::class, 'postupdate'])->name('admin.account.employee.postupdateemployee');
            Route::delete('/deleteemployee/{adminID}', [AccountEmployeeDashboard::class, 'delete'])->name('admin.account.employee.deleteemployee');
        });

        // Account Shipper
        Route::prefix('admin/account/shipper')->group(function () {
            Route::get('/', [AccountShipperDashboard::class, 'index'])->name('admin.account.shipper');
            Route::get('/addshipper', [AccountShipperDashboard::class, 'create'])->name('admin.account.shipper.addshipper');
            Route::post('/postaddshipper', [AccountShipperDashboard::class, 'addshipper'])->name('admin.account.shipper.postaddshipper');
            Route::get('/updateshipper/{shipperId}', [AccountShipperDashboard::class, 'update'])->name('admin.account.shipper.updateshipper');
            Route::post('/postupdateshipper/{shipperId}', [AccountShipperDashboard::class, 'postupdate'])->name('admin.account.shipper.postupdateshipper');
            Route::delete('/deleteshipper/{shipperId}', [AccountShipperDashboard::class, 'delete'])->name('admin.account.shipper.deleteshipper');
        });
        Route::prefix('admin/order')->group(function () {
            Route::get('/', [AdminOrderController::class, 'index'])->name('admin.order.list-order');
            Route::get('/order-confirmed', [AdminOrderController::class, 'confirmed_order'])->name('admin.order.confi-order');
            Route::put('/order-confirmed/{orderID}', [AdminOrderController::class, 'send_confirmed_order'])->name('admin.order.put-confi-order');
            Route::get('/order-admin-delivery', [AdminOrderController::class, 'admin_delivery_order'])->name('admin.order.admin-delivery-order');
            Route::get('/order-admin-delivered', [AdminOrderController::class, 'admin_delivered_order'])->name('admin.order.admin-delivered-order');
        });
    });

    // Routes cho Shipper
    Route::group(['middleware' => ['role:admin,employee,shipper']], function () {
        Route::get('/shipper/dashboard', function () {
            return view('admin.dashboard');
        })->name('shipper.dashboard');

        /* Order Admin */
        Route::prefix('admin/order')->group(function () {
            Route::get('/order-detail/{orderID}', [AdminOrderController::class, 'detail_order'])->name('admin.order.detail-order');
            Route::get('/order-processing', [AdminOrderController::class, 'processing_order'])->name('admin.order.process-order');
            Route::put('/order-processing/{orderID}', [AdminOrderController::class, 'send_processing_order'])->name('admin.order.put-process-order');
            Route::get('/order-delivery', [AdminOrderController::class, 'delivery_order'])->name('admin.order.delivery-order');
            Route::put('/order-delivery/{orderID}', [AdminOrderController::class, 'send_delivery_order'])->name('admin.order.put-delivery-order');
            Route::get('/order-delivered', [AdminOrderController::class, 'delivered_order'])->name('admin.order.delivered-order');
        });
    });
});
Route::prefix('/')->group(function () {
    Route::get('/', [HomeClient::class, 'index'])->name('client.home');
    /* Search */
    Route::get('/search', [CategoryClient::class, 'search'])->name('client.search');
    Route::get('/camrera', [CategoryClient::class, 'product_camera'])->name('client.camera');
    Route::get('/laptops', [CategoryClient::class, 'product_laptop'])->name('client.laptop');
    Route::get('/accessory', [CategoryClient::class, 'product_accessory'])->name('client.accessory');

    /* Category */
    Route::get('/category', [CategoryClient::class, 'index'])->name('client.category');
    Route::post('/category/filter-product', [CategoryClient::class, 'filterProducts'])->name('client.filter-Product');
    /* Detail Product */
    Route::get('/detail-product/{productId}', [DetailProductClient::class, 'index'])->name('client.detail-product');
    /* Cart */
    Route::get('/cart', function () {
        return view('users.pages.cart.carts');
    })->name('client.cart');
    Route::get('/test',function(){
        return view('users.pages.cart.test');
    });

    /* Authencation */
    //login
    Route::get('/user-login', [ClientAuthController::class, 'userLogin'])->name('client.authen-login');
    Route::post('/postlogin', [ClientAuthController::class, 'login'])->name('client.authen-postlogin');
    //register
    Route::get('/user-register', [ClientAuthController::class, 'userRegister'])->name('client.authen-register');
    Route::post('/postregister', [ClientAuthController::class, 'register'])->name('client.authen-postregister');
    /* End Authencation */

    Route::middleware(['userAuth'])->group(function () {
        //Logout
        Route::post('/user-logout', [ClientAuthController::class, 'logout'])->name('client.authen-logout');
        //Detail product Authen
        Route::post('/cart-item', [ClientCart::class, 'cart_item'])->name('client.cart-item-authen');
        //Payment
        Route::get('/cart/payment', [ClientPayment::class, 'index'])->name('client.cart-payment');
        Route::post('/cart/bank-payment', [ClientPayment::class, 'bank_payment'])->name('client.cart-bank-payment');
        Route::post('/cart/postpayment', [ClientPayment::class, 'post_payment'])->name('client.cart-post-payment');
        //Profile
        Route::get('/profile/order', [ClientProfile::class, 'profile_order'])->name('client.profile-order');
        Route::get('/profile/order-detail/{orderId}', [ClientProfile::class, 'profile_order_detail'])->name('client.profile-detail-order');
        Route::get('/profile/info', [ClientProfile::class, 'profile_info'])->name('client.profile-info');
        Route::get('/profile/info-edit', [ClientProfile::class, 'profile_info_edit'])->name('client.profile-info-edit');
        Route::post('/profile/info-updateedit', [ClientProfile::class, 'profile_info_update_edit'])->name('client.profile-info-updateedit');
        Route::get('/profile/change-pass', [ClientProfile::class, 'profile_change_pass'])->name('client.profile-change_pass');
        Route::post('/profile/change-pass', [ClientProfile::class, 'profile_update_pass'])->name('client.profile-update_pass');
    });
});
