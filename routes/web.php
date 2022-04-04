<?php

use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\XMLController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function(){
    return view('index');
});
Route::resource('/admin/orders', OrderController::class);

Route::resource('/products', ProductController::class);
Route::resource('/carts', CartController::class);
Route::resource('/cart_items', CartItemController::class);

Route::resource('/upload', UploadController::class);

Route::get('xml', [XMLController::class, 'createXML']);
/*
Route::group([
    'middleware' => 'verified'
], function () {

});
*/
