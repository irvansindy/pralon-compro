<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\AboutUsController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\NewsController;
use App\Http\Controllers\User\ContactUsController;
use App\Http\Controllers\SubcriptionController;
use App\Http\Controllers\MalwareScanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\HistoryDownloadProductBrocurePricelistController;
use App\Http\Controllers\Admin\HomePageController as AdminHomePageController;
use App\Http\Controllers\Admin\AboutUsController as AdminAboutUsController;
use App\Http\Controllers\Admin\NewAndBlogController as AdminNewAndBlogController;
use App\Http\Controllers\Admin\EmailTemplateController as AdminEmailTemplateController;
use App\Http\Controllers\Admin\EmailMessageController as EmailMessageController;
use App\Http\Controllers\Admin\SubcriptionController as AdminSubcriptionController;
use App\Http\Controllers\Admin\AnalyticsController as AnalyticsController;

use App\Helpers\FormatResponseJson;
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

Route::get("/", [HomeController::class,"index"])->name("home");

// for scanning
Route::get('/scan-malware', [MalwareScanController::class, 'scan'])->name('scan-malware');
Route::get('/delete-malware-file', function () {
    $path = Request::get('path');
    if ($path && File::exists($path)) {
        File::delete($path);
        return "<b style='color:green;'>Berhasil dihapus:</b> {$path}<br><a href='" . route('scan-malware') . "'>← Kembali ke scan</a>";
    }
    return "<b style='color:red;'>Gagal hapus. File tidak ditemukan atau tidak ada path.</b><br><a href='" . route('scan-malware') . "'>← Kembali ke scan</a>";
})->name('delete-malware-file');

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
Route::get('/fetch-news', [NewsController::class,'fetchNewsWithCache'])->name('fetch-news');
Route::get('/fetch-news-categories', [NewsController::class,'fetchNewsCategories'])->name('fetch-news-categories');
Route::get('/fetch-news-recent-post', [NewsController::class,'fetchRecentPost'])->name('fetch-news-recent-post');
Route::get('fetch-news-detail', [NewsController::class,'fetchNewsDetail'])->name('fetch-news-detail');

Route::get('contact-us', [ContactUsController::class,'index'])->name('contact-us');
Route::get('fetch-contact-us', [ContactUsController::class,'fetch'])->name('fetch-contact-us');
Route::post('send-email-contact-us', [ContactUsController::class,'sendEmail'])->name('send-email-contact-us');

Route::post('store-email-subcription', [SubcriptionController::class,'subscriptionEmail'])->name('store-email-subcription')->middleware('throttle:5,1');
Route::get('/subscribe/verify/{token}', [SubcriptionController::class, 'verify'])->name('subscription.verify');

// admin
Route::post('/fetch-visitor-dashboard', [DashboardController::class,'broadcastVisitors'])->name('fetch-visitor-dashboard');
// analytics
Route::get('/analytics', [AnalyticsController::class,'index'])->name('analytics');
Route::middleware(['auth'])->group(function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/fetch-dashboard', [DashboardController::class,'fetch'])->name('fetch-dashboard');
    // notify
    Route::get('/admin/notifications', function () {
        $notifications = DB::table('notifications')->latest()
        ->where('is_read', 0)
        ->take(10)->get();
        // return response()->json($notifications);
        return FormatResponseJson::success($notifications, 'Notifications fetched successfully');
    });
    Route::post('admin/notifications/read-all', function () {
        DB::table('notifications')->where('is_read', 0)->update(['is_read' => 1]);
        return FormatResponseJson::success(true, 'All notification readed');
    });
    
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
    
    Route::get('/history-download', [HistoryDownloadProductBrocurePricelistController::class,'index'])->name('history-download');
    Route::get('/fetch-history-download-brocure', [HistoryDownloadProductBrocurePricelistController::class,'fetchHistoryDownloadBrocure'])->name('fetch-history-download-brocure');
    Route::get('/fetch-history-download-pricelist', [HistoryDownloadProductBrocurePricelistController::class,'fetchHistoryDownloadPricelist'])->name('fetch-history-download-pricelist');
    Route::get('/export-history-brocure', [HistoryDownloadProductBrocurePricelistController::class, 'exportBrocure'])->name('export-history-brocure');
    Route::get('/export-history-pricelist', [HistoryDownloadProductBrocurePricelistController::class, 'exportPricelist'])->name('export-history-pricelist');

    Route::post('store-master-product', [AdminProductController::class,'storeProduct'])->name('store-master-product');
    Route::post('update-master-product', [AdminProductController::class,'updateProduct'])->name('update-master-product');
    Route::post('store-brocure', [AdminProductController::class,'storeBrocure'])->name('store-brocure');
    Route::post('update-brocure-status', [AdminProductController::class,'updateStatusBrocure'])->name('update-brocure-status');
    Route::post('store-price-list', [AdminProductController::class,'storePriceList'])->name('store-price-list');
    Route::post('update-price-list-status', [AdminProductController::class,'updateStatusPriceList'])->name('update-price-list-status');
    /* master content
    homepage/beranda */
    Route::get('home-page-setting', [AdminHomePageController::class,'index'])->name('home-page-setting');
    Route::get('fetch-header-home-page', [AdminHomePageController::class,'fetchHeader'])->name('fetch-header-home-page');
    Route::get('fetch-product-home-page', [AdminHomePageController::class,'fetchProduct'])->name('fetch-product-home-page');
    Route::get('fetch-about-us-home-page', [AdminHomePageController::class,'fetchAboutUs'])->name('fetch-about-us-home-page');
    Route::get('fetch-project-references-home-page', [AdminHomePageController::class,'fetchProjectReferences'])->name('fetch-project-references-home-page');
    Route::get('fetch-testimonial-home-page', [AdminHomePageController::class,'fetchTestimonials'])->name('fetch-testimonial-home-page');
    Route::get('fetch-testimonial-home-page-by-id', [AdminHomePageController::class,'fetchTestimonialById'])->name('fetch-testimonial-home-page-by-id');
    Route::get('fetch-news-home-page', [AdminHomePageController::class,'fetchNews'])->name('fetch-news-home-page');
    
    Route::post('submit-header-home-page', [AdminHomePageController::class,'createOrUpdateHeader'])->name('submit-header-home-page');
    Route::post('save-order-product-home-page', [AdminHomePageController::class,'reOrderProduct'])->name('save-order-product-home-page');
    Route::post('submit-about-us-home-page', [AdminHomePageController::class,'createOrUpdateAboutUs'])->name('submit-about-us-home-page');
    Route::post('save-order-project-home-page', [AdminHomePageController::class,'reOrderProjectReferences'])->name('save-order-project-home-page');
    Route::post('submit-testimonial', [AdminHomePageController::class,'createOrUpdateTestimonial'])->name('submit-testimonial');
    Route::post('save-order-news-home-page', [AdminHomePageController::class,'reOrderNews'])->name('save-order-news-home-page');
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

    Route::get('email-message', [EmailMessageController::class,'index'])->name('email-message');
    Route::get('fetch-email-message', [EmailMessageController::class,'fetchEmailMessages'])->name('fetch-email-message');

    // user-subcription
    Route::get('user-subcription', [AdminSubcriptionController::class,'index'])->name('user-subcription');
    Route::get('fetch-user-subcription', [AdminSubcriptionController::class,'fetchSubcriptions'])->name('fetch-user-subcription');
});

// Auth::routes();
Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);