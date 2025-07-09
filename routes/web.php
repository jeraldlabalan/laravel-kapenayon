<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Authentication Routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

// Static Page Routes
Route::get('/services', [App\Http\Controllers\HomeController::class, 'services'])->name('services');

Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');

Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');



Route::group(['prefix' => 'products'], function () {

    // Product Page Routes
    Route::get('/product-single/{id}', [App\Http\Controllers\Products\ProductsController::class, 'singleProduct'])->name('product.single');

    // Add to Cart Route
    Route::post('/product-single/{id}', [App\Http\Controllers\Products\ProductsController::class, 'addCart'])->name('add.cart');

    // Cart Page Route
    Route::get('/cart', [App\Http\Controllers\Products\ProductsController::class, 'cart'])->name('cart')->middleware('auth:web');

    // Delete Product from Cart Route
    Route::get('/cart-delete/{id}', [App\Http\Controllers\Products\ProductsController::class, 'deleteProductCart'])->name('cart.product.delete');

    // Prepare Checkout Route
    Route::post('/prepare-checkout', [App\Http\Controllers\Products\ProductsController::class, 'prepareCheckout'])->name('prepare.checkout');

    // Checkout Page Route
    Route::get('/checkout', [App\Http\Controllers\Products\ProductsController::class, 'checkout'])->name('checkout')->middleware('check.for.price');

    // Process Checkout Route
    Route::post('/checkout', [App\Http\Controllers\Products\ProductsController::class, 'storeCheckout'])->name('process.checkout')->middleware('check.for.price');

    // Pay with PayPa Route
    Route::get('/pay', [App\Http\Controllers\Products\ProductsController::class, 'payWithPaypal'])->name('products.pay')->middleware('check.for.price');

    // Success Route after Payment
    Route::get('/success', [App\Http\Controllers\Products\ProductsController::class, 'success'])->name('products.pay.success')->middleware('check.for.price');

    // Booking Route
    Route::post('/booking', [App\Http\Controllers\Products\ProductsController::class, 'bookTables'])->name('booking.tables');

    // Menu Page Route
    Route::get('/menu', [App\Http\Controllers\Products\ProductsController::class, 'menu'])->name('products.menu');

});


Route::group(['prefix' => 'users'], function () {

    // User Page Route
    Route::get('/orders', [App\Http\Controllers\Users\UsersController::class, 'displayOrders'])->name('users.orders')->middleware('auth:web');

    // Booking Page
    Route::get('/bookings', [App\Http\Controllers\Users\UsersController::class, 'displayBookings'])->name('users.bookings')->middleware('auth:web');


    // Write Review Route
    Route::get('/write-reviews', [App\Http\Controllers\Users\UsersController::class, 'writeReview'])->name('write.reviews')->middleware('auth:web');

    // Process Write Review Route
    Route::post('/write-reviews', [App\Http\Controllers\Users\UsersController::class, 'processWriteReview'])->name('process.write.review')->middleware('auth:web');


});

Route::get('admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'viewLogin'])->name('view.login')->middleware('check.for.auth');
Route::post('admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'checkLogin'])->name('check.login');
Route::post('admin/logout', [App\Http\Controllers\Admins\AdminsController::class, 'logout'])->name('admin.logout');



Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {

//
Route::get('index', [App\Http\Controllers\Admins\AdminsController::class, 'index'])->name('admins.dashboard');

// Admins Section Route
Route::get('all-admins', [App\Http\Controllers\Admins\AdminsController::class, 'displayAllAdmins'])->name('all.admins');

Route::get('create-admins', [App\Http\Controllers\Admins\AdminsController::class, 'createAdmins'])->name('create.admins');

Route::post('create-admins', [App\Http\Controllers\Admins\AdminsController::class, 'storeAdmins'])->name('store.admins');

Route::get('all-orders', [App\Http\Controllers\Admins\AdminsController::class, 'displayAllOrders'])->name('all.orders');

Route::get('edit-order/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'editOrder'])->name('edit.order');

Route::post('edit-order/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateOrder'])->name('update.order');


Route::get('delete-order/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteOrder'])->name('delete.order');



// products section

Route::get('all-products', [App\Http\Controllers\Admins\AdminsController::class, 'displayAllProducts'])->name('all.products');

Route::get('create-products', [App\Http\Controllers\Admins\AdminsController::class, 'createProduct'])->name('create.product');

Route::post('create-products', [App\Http\Controllers\Admins\AdminsController::class, 'storeProduct'])->name('store.product');

Route::get('delete-products/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteProduct'])->name('delete.product');

// Bookings Section

Route::get('all-bookings', [App\Http\Controllers\Admins\AdminsController::class, 'displayBookings'])->name('all.bookings');

Route::get('edit-booking/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'editBooking'])->name('edit.booking');

Route::post('edit-booking/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateBooking'])->name('update.booking');

Route::get('delete-booking/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteBooking'])->name('delete.booking');


});

