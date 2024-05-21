<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\AboutUsController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\NewsController;
use App\Http\Controllers\User\ContactUsController;
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
Route::get("/fetch-product-by-category", [ProductController::class,"fetchProductByCategoty"])->name("fetch-product-by-category");
Route::get("/fetch-categories", [ProductController::class,"fetchCategories"])->name("fetch-categories");
Route::get("/product-detail/{id}/{slug}", [ProductController::class,"detailProduct"])->name("product-detail");
Route::get("download-catalog/{catalog}", [ProductController::class,"downloadCatalog"])->name("download-catalog");
Route::get("download-pricelist/{pricelist}", [ProductController::class,"downloadPriceList"])->name("download-pricelist");
Route::post("/log-user", [ProductController::class,"storeLogUserDownload"])->name("log-user");

Route::get('/news', [NewsController::class,'index'])->name('news');
Route::get('/fetch-news', [NewsController::class,'fetchNews'])->name('fetch-news');
Route::get('/fetch-news-categories', [NewsController::class,'fetchNewsCategories'])->name('fetch-news-categories');
Route::get('/fetch-news-recent-post', [NewsController::class,'fetchRecentPost'])->name('fetch-news-recent-post');
Route::get('fetch-news-detail', [NewsController::class,'fetchNewsDetail'])->name('fetch-news-detail');

Route::get('contact-us', [ContactUsController::class,'index'])->name('contact-us');
Route::get('fetch-contact-us', [ContactUsController::class,'fetch'])->name('fetch-contact-us');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
