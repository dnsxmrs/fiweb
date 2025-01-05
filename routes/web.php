<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WebController;


// Landing page
Route::get('/',[WebController::class, 'getCategory'])->name('landing');

// order now
Route::get('/order-now', [WebController::class, 'orderNow'])->name('order-now');














// Group for menu views
Route::prefix('menu')->group(function () {
    Route::view('customize-cold-drinks', 'menu.modals.customize-cold-drinks'); // Customize cold drinks modal
    Route::view('customize-hot-drinks', 'menu.modals.customize-hot-drinks'); // Customize hot drinks modal
    Route::view('customize-snacks-dessert', 'menu.modals.customize-snacks-dessert'); // ??
    Route::view('remove-item-modal', 'menu.modals.remove-item-modal'); // ! remove this modal
    Route::view('all-menu', 'menu.all-menu'); // testing for customizations
    Route::view('menu-items', 'menu.menu-items'); // same as order-now but template
    Route::view('order-now', 'menu.order-now'); // main page for ordering
    Route::view('order-sidebar', 'menu.order-sidebar'); // sidebar for orders
});

// Group for order checkout views
Route::prefix('order-checkout')->group(function () {
    Route::prefix('modals')->group(function () {
        Route::view('add-order-confirmation', 'order-checkout.order-checkout-modals.add-order-confirmation'); // ? huh?
        Route::view('cancel-order-modal', 'order-checkout.order-checkout-modals.cancel-order-modal'); // ? no cancel order? where should i put this
        Route::view('cancellation-reason-modal', 'order-checkout.order-checkout-modals.cancellation-reason-modal'); // after cancel order
        Route::view('confirm-payment', 'order-checkout.order-checkout-modals.confirm-payment');
        Route::view('edit-order-confirmation', 'order-checkout.order-checkout-modals.edit-order-confirmation');
        Route::view('order-cancelled-success', 'order-checkout.order-checkout-modals.order-cancelled-success');
        Route::view('order-placed-success', 'order-checkout.order-checkout-modals.order-placed-success');
        Route::view('payment-success', 'order-checkout.order-checkout-modals.payment-success');
        Route::view('payment-unsuccessful', 'order-checkout.order-checkout-modals.payment-unsuccessful');
    });

    Route::view('checkout', 'order-checkout.order-checkout');
    Route::view('details', 'order-checkout.order-details');
});
