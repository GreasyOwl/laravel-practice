<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\Admin\ToolController;
use App\Http\Controllers\Admin\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/products', ProductController::class);

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);

Route::group([
    'middleware' => 'auth:api',
], function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('/notifications', [AuthController::class, 'getNotifications']);
    Route::patch('/read-notification', [AuthController::class, 'readNotification']);
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::post('/carts/checkout', [CartController::class, 'checkout']);
    Route::resource('/carts', CartController::class);
    Route::resource('/cart-items', CartItemController::class);

    Route::post('/admin/orders/{id}/delivery', [OrderController::class, 'delivery']);
    Route::patch('/admin/tools/update-product-price', [ToolController::class, 'updateProductPrice']);
});
