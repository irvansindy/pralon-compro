<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\AboutUsController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\NewsController;
use App\Http\Controllers\User\ContactUsController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
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

// admin
Route::middleware(['auth'])->group(function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    // menu setting
    Route::get('/menu-setting', [MenuController::class,'index'])->name('menu-setting');
    Route::get('/fetch-menu', [MenuController::class,'fetchMenu'])->name('fetch-menu');
    Route::get('/detail-menu', [MenuController::class,'detailMenu'])->name('detail-menu');
    Route::post('/store-menu', [MenuController::class,'storeMenu'])->name('store-menu');
    Route::post('/update-menu', [MenuController::class,'updateMenu'])->name('update-menu');
    // product category
    Route::get('product-categories', [ProductCategoryController::class,'index'])->name('product-categories');
    Route::get('fetch-product-categories', [ProductCategoryController::class,'fetchCategories'])->name('fetch-product-categories');
    Route::post('store-product-category', [ProductCategoryController::class,'storeCategory'])->name('store-product-category');
    Route::post('update-product-category', [ProductCategoryController::class,'updateCategory'])->name('update-product-category');
    // master product
    Route::get('master-product', [AdminProductController::class,'index'])->name('master-product');
    Route::get('fetch-master-product', [AdminProductController::class,'fetchProduct'])->name('fetch-master-product');
    Route::get('fetch-master-product-by-id', [AdminProductController::class,'fetchProductById'])->name('fetch-master-product-by-id');
    Route::post('store-master-product', [AdminProductController::class,'storeProduct'])->name('store-master-product');
    Route::post('update-master-product', [AdminProductController::class,'updateProduct'])->name('update-master-product');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
