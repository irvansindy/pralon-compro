<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\AboutUsController;
use App\Http\Controllers\User\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/", [HomeController::class,"index"])->name("home");
Route::get("/about-us", [AboutUsController::class,"index"])->name("about-us");
Route::get("/product", [ProductController::class,"index"])->name("product");
Route::get("/fetch-product", [ProductController::class,"fetchProduct"])->name("fetch-product");
Route::get("/product-detail/{id}/{slug}", [ProductController::class,"detailProduct"])->name("product-detail");

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
