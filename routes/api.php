<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\WebhookController;
use App\Http\Middleware\CheckPosSource;


Route::middleware([CheckPosSource::class])->group(function () {
    Route::prefix('v1')->group(function () {
        // Authenticated routes
        Route::get('/user', function (Request $request) {
            return $request->user();
        })->middleware('auth:sanctum');

        // Testing API calls - used by POSTMAN
        Route::post('/upload-image', [APIController::class, 'upload']);

        // Web fetching routes - used in web pages in OOS
        // Route::get('/product', [APIController::class, 'getProduct']);
        // Route::get('/products/{productId}', [APIController::class, 'getOneProduct']);

        // Webhook routes for updating products and categories
        Route::match(['post', 'put', 'delete'], '/category-update', [WebhookController::class, 'category']);
        Route::match(['post', 'put', 'delete'], '/product-update', [WebhookController::class, 'product']);
    });
});

// health checks
Route::get('/health', [APIController::class, 'check']);
