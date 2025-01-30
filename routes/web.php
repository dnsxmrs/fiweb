<?php

use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SignupController;


// Landing page
Route::get('/',[WebController::class, 'getCategory'])->name('landing');

// order now - menu
Route::get('/order-now', [WebController::class, 'orderNow'])->name('order-now');

// fill out form in checkout
Route::get('/checkout', [WebController::class, 'checkout'])->name('checkout');

// after placing order in checkout
Route::post('/payment', [PaymentController::class, 'pay'])->name('pay');

// can be used for emails - checkouturl for paymongo - details after this
Route::get('/orders', [PaymentController::class, 'orders'])->name('orders');

// independent details url
Route::get('/order-details/{orderNumber?}', [PaymentController::class, 'showDetails'])->name('showDetails');
// for canceling orders
Route::post('/orders/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');


//Signup Route

// Simple route for viewing the sign-up page
Route::get('/sign-up', function () {
    return view('account.sign-up');
})->name('sign-up');

//Sign up route
Route::get('/login', function () {
    return view('account.log-in');
})->name('login');


Route::get('/cancel-order', function () {
    return view('order-checkout.order-checkout-modals.cancel-order-modal');
});

Route::get('/cancel-success', function () {
    return view('order-checkout.order-checkout-modals.order-cancelled-success');
});