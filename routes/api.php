<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\WebhookController;
use App\Http\Middleware\CheckKdsSource;
use App\Http\Middleware\CheckPosSource;

Route::middleware([CheckPosSource::class])->group(function () {
    Route::prefix('v1')->group(function () {
        // Authenticated routes
        Route::get('/user', function (Request $request) {
            return $request->user();
        })->middleware('auth:sanctum');

        // Testing API calls - used by POSTMAN
        Route::post('/upload-image', [APIController::class, 'upload']);

        // Webhook routes for updating products and categories
        Route::match(['post', 'put', 'delete'], '/category-update', [WebhookController::class, 'category']);
        Route::match(['post', 'put', 'delete'], '/product-update', [WebhookController::class, 'product']);

        // fetching orders from POS, for display
        Route::get('/get-orders-paginate', [WebhookController::class, 'getOrdersPaginate']);
        Route::get('/get-orders', [WebhookController::class, 'getOrders']);
        Route::post('/get-orders-count', [WebhookController::class, 'getOrdersCount']);

        Route::get('/get-dashboard-details', [WebhookController::class, 'getDashboardDetails']);

        Route::match(['post', 'put'], '/kds-to-web', [WebhookController::class, 'orderStatusUpdate']);
    });
});

Route::middleware([CheckKdsSource::class])->group(function () {
    Route::prefix('v1')->group(function () {

    });
});

// health checks
Route::get('/health', [APIController::class, 'check']);
