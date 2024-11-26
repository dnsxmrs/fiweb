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
