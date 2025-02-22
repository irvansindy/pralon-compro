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
use App\Http\Controllers\Admin\HomePageController as AdminHomePageController;
use App\Http\Controllers\Admin\AboutUsController as AdminAboutUsController;
use App\Http\Controllers\Admin\NewAndBlogController as AdminNewAndBlogController;
use App\Http\Controllers\Admin\EmailTemplateController as AdminEmailTemplateController;
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
Route::get("/about-us", action: [AboutUsController::class,"index"])->name("about-us");
Route::get("/fetch-content-home", [HomeController::class,"fetchContent"])->name("fetch-content-home");
Route::get("/fetch-content-about-us", [AboutUsController::class,"fetchContentAboutUs"])->name("fetch-content-about-us");

Route::get("/product", [ProductController::class,"index"])->name("product");
Route::get("/fetch-product", [ProductController::class,"fetchProduct"])->name("fetch-product");
Route::get("/fetch-product-by-category", [ProductController::class,"fetchProductByCategoty"])->name("fetch-product-by-category");
Route::get("/fetch-categories", [ProductController::class,"fetchCategories"])->name("fetch-categories");
Route::get("/product-detail/{id}/{slug}", [ProductController::class,"detailProduct"])->name("product-detail");
Route::get("download-catalog/{catalog}", [ProductController::class,"downloadCatalog"])->name("download-catalog");
Route::get("download-pricelist/{pricelist}", [ProductController::class,"downloadPriceList"])->name("download-pricelist");
Route::get('send-email-downloaded', [ProductController::class,'sendEmailDownloaded'])->name('send-email-downloaded');
Route::post("/log-user", [ProductController::class,"storeLogUserDownload"])->name("log-user");

Route::get('/news', [NewsController::class,'index'])->name('news');
// Route::get('/fetch-news', [NewsController::class,'fetchNews'])->name('fetch-news');
Route::get('/fetch-news', [NewsController::class,'fetchNewsWithCache'])->name('fetch-news');
Route::get('/fetch-news-categories', [NewsController::class,'fetchNewsCategories'])->name('fetch-news-categories');
Route::get('/fetch-news-recent-post', [NewsController::class,'fetchRecentPost'])->name('fetch-news-recent-post');
Route::get('fetch-news-detail', [NewsController::class,'fetchNewsDetail'])->name('fetch-news-detail');

Route::get('contact-us', [ContactUsController::class,'index'])->name('contact-us');
Route::get('fetch-contact-us', [ContactUsController::class,'fetch'])->name('fetch-contact-us');
Route::post('send-email-contact-us', [ContactUsController::class,'sendEmail'])->name('send-email-contact-us');

// admin
Route::middleware(['auth'])->group(function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    // menu setting
    Route::get('/menu-setting', [MenuController::class,'index'])->name('menu-setting');
    Route::get('/fetch-menu', [MenuController::class,'fetchMenu'])->name('fetch-menu');
    Route::get('/detail-menu', [MenuController::class,'detailMenu'])->name('detail-menu');
    Route::get('/detail-submenu', [MenuController::class,'detailSubMenu'])->name('detail-submenu');
    Route::post('/store-menu', [MenuController::class,'storeMenu'])->name('store-menu');
    Route::post('/store-submenu', [MenuController::class,'storeSubMenu'])->name('store-submenu');
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
    Route::get('fetch-brocure-product-by-id', [AdminProductController::class,'fetchBrocureByProductId'])->name('fetch-brocure-product-by-id');
    Route::get('fetch-pricelist-product-by-id', [AdminProductController::class,'fetchPriceListByProductId'])->name('fetch-pricelist-product-by-id');

    Route::post('store-master-product', [AdminProductController::class,'storeProduct'])->name('store-master-product');
    Route::post('update-master-product', [AdminProductController::class,'updateProduct'])->name('update-master-product');
    Route::post('store-brocure', [AdminProductController::class,'storeBrocure'])->name('store-brocure');
    Route::post('update-brocure-status', [AdminProductController::class,'updateStatusBrocure'])->name('update-brocure-status');
    Route::post('store-price-list', [AdminProductController::class,'storePriceList'])->name('store-price-list');
    Route::post('update-price-list-status', [AdminProductController::class,'updateStatusPriceList'])->name('update-price-list-status');
    /* master content
    homepage/beranda */
    Route::get('home-page-setting', [AdminHomePageController::class,'index'])->name('home-page-setting');
    Route::get('fetch-home-page-setting', [AdminHomePageController::class,'fetchMasterSection'])->name('fetch-home-page-setting');
    Route::get('fetch-home-page-setting-by-id', [AdminHomePageController::class,'fetchMasterSectionById'])->name('fetch-home-page-setting-by-id');
    Route::post('store-master-section', [AdminHomePageController::class,'storeMasterSection'])->name('store-master-section');
    // master about us
    Route::get('about-us-setting', [AdminAboutUsController::class, 'index'])->name('about-us-setting');
    Route::get('fetch-about-us-setting', [AdminAboutUsController::class, 'fetchAllContentAboutUs'])->name('fetch-about-us-setting');
    Route::get('fetch-detail-header-about-us', [AdminAboutUsController::class, 'fetchDetailHeaderAboutUs'])->name('fetch-detail-header-about-us');
    Route::get('fetch-detail-history-about-us', [AdminAboutUsController::class, 'fetchDetailHistory'])->name('fetch-detail-history-about-us');
    Route::get('fetch-detail-why-pralon-about-us', [AdminAboutUsController::class, 'fetchDetailWhyPralon'])->name('fetch-detail-why-pralon-about-us');
    Route::get('fetch-detail-visi-misi-about-us', [AdminAboutUsController::class, 'fetchVisiMisi'])->name('fetch-detail-visi-misi-about-us');
    Route::get('fetch-detail-value-about-us', [AdminAboutUsController::class, 'fetchValue'])->name('fetch-detail-value-about-us');
    Route::get('fetch-certificate-about-us', [AdminAboutUsController::class, 'fetchCertificates'])->name('fetch-certificate-about-us');

    Route::post('store-header-about-us', [AdminAboutUsController::class, 'storeHeader'])->name('store-header-about-us');
    Route::post('update-header-about-us', [AdminAboutUsController::class, 'updateHeader'])->name('update-header-about-us');
    Route::post('store-history-about-us', [AdminAboutUsController::class, 'storeHistory'])->name('store-history-about-us');
    Route::post('update-history-about-us', [AdminAboutUsController::class, 'updateHistory'])->name('update-history-about-us');
    Route::post('store-why-pralon-about-us', [AdminAboutUsController::class, 'storeWhyPralon'])->name('store-why-pralon-about-us');
    Route::post('update-why-pralon-about-us', [AdminAboutUsController::class, 'updateWhyPralon'])->name('update-why-pralon-about-us');
    Route::post('store-visi-misi-about-us', [AdminAboutUsController::class, 'storeVisiMisi'])->name('store-visi-misi-about-us');
    Route::post('update-visi-misi-about-us', [AdminAboutUsController::class, 'updateVisiMisi'])->name('update-visi-misi-about-us');
    Route::post('store-value-about-us', [AdminAboutUsController::class, 'storeValue'])->name('store-value-about-us');
    Route::post('update-value-about-us', [AdminAboutUsController::class, 'updateValue'])->name('update-value-about-us');
    Route::post('store-certificate-about-us', [AdminAboutUsController::class, 'storeCertificate'])->name('store-certificate-about-us');
    Route::post('delete-certificate-about-us', [AdminAboutUsController::class, 'deleteCertificate'])->name('delete-certificate-about-us');
    // master news anb blog
    Route::get('news-and-blog', [AdminNewAndBlogController::class,'index'])->name('news-and-blog');
    Route::get('fetch-news-blog', [AdminNewAndBlogController::class,'fetchNewsBlog'])->name('fetch-news-blog');
    Route::get('fetch-news-blog-categories', [AdminNewAndBlogController::class,'fetchNewsBlogCategory'])->name('fetch-news-blog-categories');
    Route::get('fetch-news-blog-by-id', [AdminNewAndBlogController::class,'fetchNewsBlogById'])->name('fetch-news-blog-by-id');
    Route::post('store-news-blog', [AdminNewAndBlogController::class,'storeNewsBlog'])->name('store-news-blog');
    Route::post('update-news-blog', [AdminNewAndBlogController::class,'updateNewsBlog'])->name('update-news-blog');
    // master email template
    Route::get('email-template', [AdminEmailTemplateController::class,'index'])->name('email-template');
    Route::get('fetch-email-template', [AdminEmailTemplateController::class,'fetch'])->name('fetch-email-template');
    Route::get('detail-email-template', [AdminEmailTemplateController::class,'detail'])->name('detail-email-template');
    Route::post('store-email-template', [AdminEmailTemplateController::class,'store'])->name('store-email-template');
    Route::post('update-email-template', [AdminEmailTemplateController::class,'update'])->name('update-email-template');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
