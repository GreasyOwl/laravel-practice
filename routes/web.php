<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\XMLController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ProductController;

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


Route::resource('/product', ProductController::class);

Route::resource('/upload', UploadController::class);

Route::get('xml', [XMLController::class, 'createXML']);
