<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\markController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerPasswordController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\StripePaymentController;

Route::get('/', [FrontController::class, 'front'])->name('index');
Route::post('/getSize', [FrontController::class, 'getSize']);
Route::get('/product/details/{product_id}', [FrontController::class, 'product_details'])->name('product.details');
Route::get('/shop', [FrontController::class, 'shop'])->name('shop');

Auth::routes();

Route::get('/users', [HomeController::class, 'index'])->name('users');
Route::get('/admin', [HomeController::class, 'admin'])->name('admin');
Route::get('/user/delete/{user_id}', [HomeController::class, 'delete'])->name('del');

// CATEGORY ROUTE
Route::group(['prefix' => 'category'], function() {

    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/insert', [CategoryController::class, 'insert']);
    Route::get('/delete/{cat_id}', [CategoryController::class, 'delete'])->name('cat_delete');
    Route::get('/edit/{cat_id}', [CategoryController::class, 'edit'])->name('cat_edit');
    Route::post('/update', [CategoryController::class, 'update'])->name('cat_update');
    Route::get('/restore/{cat_id}', [CategoryController::class, 'restore'])->name('cat_restore');
    Route::get('/force_delete/{cat_id}', [CategoryController::class, 'force_delete'])->name('force_delete');

});

// SUBCATEGORY ROUTE
Route::group(['prefix'=>'subcategory'], function(){
    Route::get('/', [SubcategoryController::class, 'index']);
    Route::post('/insert', [SubcategoryController::class, 'insert']);
    Route::get('/edit/{cat_id}', [SubcategoryController::class, 'edit'])->name('subcat_edit');
});

//MARK
Route::group(['prefix' => 'mark'], function(){
    Route::post('/trash', [markController::class, 'trash'])->name('mark_trash');
    Route::post('/restore', [markController::class, 'restore'])->name('mark_restore');
});

//DASHBOARD
Route::get('/dashboard', [HomeController::class, 'dashboard']);

//PROFILE
Route::group(['prefix'=>'profile'], function(){
    Route::get('/', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/name/update', [ProfileController::class, 'name_update'])->name('name.update');
    Route::post('/password/update', [ProfileController::class, 'password_update'])->name('password.update');
    Route::post('/photo/update', [ProfileController::class, 'photo_update'])->name('photo.update');
});


//PRODUCT
Route::group(['prefix' => 'product'], function(){
    Route::get('/', [ProductController::class, 'add_product'])->name('product');
    Route::get('/view', [ProductController::class, 'view_product'])->name('product.view');
    Route::post('/getCategory', [ProductController::class, 'getCategory']);
    Route::post('/insert', [ProductController::class, 'insert']);
    Route::get('/color', [ProductController::class, 'color'])->name('color');
    Route::post('/color/insert', [InventoryController::class, 'insert_color']);
    Route::get('/size', [InventoryController::class, 'index_size'])->name('size');
    Route::post('/size/insert', [InventoryController::class, 'insert_size']);
    Route::get('/inventory/{product_id}', [InventoryController::class, 'inventory'])->name('inventory');
    Route::post('/inventory/insert', [InventoryController::class, 'insert_inventory']);
    Route::post('/review/{product_id}', [FrontController::class, 'product_review'])->name('product.review');
});

//CUSTOMER
Route::group(['prefix' => 'customer'], function(){
    Route::get('/register/form', [CustomerRegisterController::class, 'customer_register_form'])->name('customer.register.form');
    Route::post('/register', [CustomerRegisterController::class, 'customer_register']);
    Route::post('/login', [CustomerLoginController::class, 'customer_login']);
    Route::get('/account', [AccountController::class, 'account'])->name('account');
    Route::get('/invoice/download/{invoice_id}', [AccountController::class, 'invoice'])->name('invoice.download');
    Route::get('/logout', [AccountController::class, 'customerlogout'])->name('customerlogout');
    Route::get('/pass/reset/req', [CustomerPasswordController::class, 'password_reset_req'])->name('password.reset.req');
    Route::post('/pass/reset/store', [CustomerPasswordController::class, 'password_reset_store'])->name('password.reset.store');
    Route::get('/pass/reset/form/{token}', [CustomerPasswordController::class, 'password_reset_req_form'])->name('pass.reset.form');
    Route::get('/email/verify/{token}', [AccountController::class, 'customerEmailVerify'])->name('customer.email.verify');
    Route::post('/pass/update', [CustomerPasswordController::class, 'pass_update'])->name('pass_update');
});

//CART
Route::group(['prefix' => 'cart'], function(){
    Route::get('/', [CartController::class, 'index'])->name('cart');
    Route::post('/insert', [CartController::class, 'cart_insert']);
    Route::post('/update', [CartController::class, 'cart_update']);
    Route::get('/cart/delete/{cart_id}', [CartController::class, 'cart_delete'])->name('cart.delete');
});

//COUPON
Route::group(['prefix' => 'coupon'], function(){
    Route::get('/', [CouponController::class, 'index'])->name('coupon');
    Route::post('/insert', [CouponController::class, 'insert']);
    Route::get('/edit/{coupon_id}', [CouponController::class, 'edit'])->name('coupon.edit');
    Route::get('/delete/{coupon_id}', [CouponController::class, 'delete'])->name('coupon.delete');
    Route::post('/update', [CouponController::class, 'update']);
});

//CHECKOUT
Route::group(['prefix' => 'checkout'], function(){
    Route::get('/', [CheckoutController::class, 'index']);
});

//RANDOM
Route::post('/getCity', [CheckoutController::class, 'getCity']);
Route::post('/order/placed', [CheckoutController::class, 'order_insert']);
Route::get('/send/invoice/{order_id}', [CheckoutController::class, 'send_mail'])->name('send.invoice');
Route::get('/order/confirmed', [CheckoutController::class, 'order_confirmed'])->name('order.confirmed');
Route::get('stripe', [StripePaymentController::class, 'stripe']);
Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');

// SSLCOMMERZ Start
Route::get('/sslpay', [SslCommerzPaymentController::class, 'exampleHostedCheckout'])->name('sslpay');
Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

//SOCIALITE
Route::get('/github/redirect', [GithubController::class, 'redirectToProvider']);
Route::get('/github/callback', [GithubController::class, 'handleProviderCallback']);

Route::get('/google/redirect', [GoogleController::class, 'redirectToProvider']);
Route::get('/google/callback', [GoogleController::class, 'handleProviderCallback']);

Route::get('/facebook/redirect', [FacebookController::class, 'redirectToProvider']);
Route::get('/facebook/callback', [FacebookController::class, 'handleProviderCallback']);

//ROLE
Route::group(['prefix' => 'role'], function(){
    Route::get('/', [RoleController::class, 'role'])->name('role');
    Route::post('/permission/store', [RoleController::class, 'permission_store'])->name('permission.store');
    Route::post('/role/store', [RoleController::class, 'role_store'])->name('role.store');
    Route::post('/assign', [RoleController::class, 'role_assign'])->name('role.assign');
    Route::get('/edit/{user_id}', [RoleController::class, 'role_edit'])->name('role.edit');
    Route::post('/update', [RoleController::class, 'role_update'])->name('role.update');
});