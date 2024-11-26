<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/menu', [MenuController::class, 'getMenu'])->name('menu.get');


Route::get('/contact', [OrderController::class, 'showContactForm'])->name('contact.form');
Route::post('/contact', [OrderController::class, 'saveContactDetails'])->name('contact.save');

Route::get('/product', [MenuController::class, 'getProduct']);
Route::view('/all-menu', 'menu.all-menu')->name('all-menu');
Route::post('/all-menu', [ProfileController::class, 'all-menu']);

Route::view('/customize-hot-drinks', 'menu.modals.customize-hot-drinks')->name('customize-hot-drinks');
Route::post('/customize-hot-drinks', [ProfileController::class, 'customize-hot-drinks']);

Route::view('/order-checkout', 'order checkout.order-checkout')->name('order-checkout');
Route::post('/order-checkout', [ProfileController::class, 'order-checkout']);

Route::view('/edit-order-confirmation', 'order checkout.order-checkout-modals.edit-order-confirmation')->name('edit-order-confirmation');
Route::post('/edit-order-confirmation', [ProfileController::class, 'edit-order-confirmation']);

Route::view('/order-sidebar', 'menu.order-sidebar')->name('order-sidebar');
Route::post('/order-sidebar', [ProfileController::class, 'order-sidebar']);

Route::view('/order-details', 'order checkout.order-details')->name('order-details');
Route::post('/order-details', [ProfileController::class, 'order-details']);

Route::view('/cancellation-reason-modal', 'order checkout.order-checkout-modals.cancellation-reason-modal')->name('cancellation-reason-modal');
Route::post('/cancellation-reason-modal', [ProfileController::class, 'cancellation-reason-modal']);

Route::view('/cancel-order-modal', 'order checkout.order-checkout-modals.cancel-order-modal')->name('cancel-order-modal');
Route::post('/cancel-order-modal', [ProfileController::class, 'cancel-order-modal']);

Route::view('/order-cancelled-success', 'order checkout.order-checkout-modals.order-cancelled-success')->name('order-cancelled-success');
Route::post('/order-cancelled-success', [ProfileController::class, 'order-cancelled-success']);
