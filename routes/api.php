<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\WebhookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// testing api calls - used by POSTMAN 
Route::post('/upload-image', [APIController::class, 'upload']);

// web fetching routes - used in web pages in OOS
Route::get('/product', [APIController::class, 'getProduct']);
Route::get('/products/{productId}', [APIController::class, 'getOneProduct']);

// webhook routes for updating products and categories
Route::post('/webhook/product-update', [WebhookController::class, 'updateProduct']);

// webhook routes for updating products and categories - called in POS
Route::match(['post', 'put', 'delete'], '/webhook/category-update', [WebhookController::class, 'upCategory']);

Route::match(['post', 'put', 'delete'], '/webhook/product-update', [WebhookController::class, 'upProduct']);






Route::post('/webhook/product-upsert', [WebhookController::class, 'upsertProduct']);
