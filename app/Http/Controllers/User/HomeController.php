<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\News;
use App\Models\HeaderHomePage;
use App\Models\Testimonials;
class HomeController extends Controller
{
    public function index(): View
    {
        return view('users.home.index');
    }
    public function fetchContent()
    {
        try {
            $header = HeaderHomePage::first();

            $some_product = Cache::remember('homepage_fixed_products', 60 * 5, function () {
                return DB::table('product_home_pages')
                    ->rightJoin('products', 'product_home_pages.product_id', '=', 'products.id')
                    ->select(
                        'products.*',
                        'product_home_pages.id as homepage_id',
                        'product_home_pages.sort_order'
                    )
                    ->orderBy('product_home_pages.sort_order', 'ASC')
                    ->get();
            });
            $some_project_reference =  Cache::remember('project_references_home_pages', 60 * 5, function () {
                return DB::table('project_home_pages')
                    ->rightJoin('news', 'project_home_pages.news_id', '=', 'news.id')
                    ->join('news_categories','news_categories.id','=','news.news_category_id')
                    ->select(
                        'news.*',
                        'project_home_pages.id as homepage_id',
                        'project_home_pages.sort_order'
                    )->where('news_categories.name','=', 'Project References')
                    ->orderBy('project_home_pages.sort_order')
                    ->get();
            });
    
            $some_news_blog = Cache::remember('some_news_blog', now()->addMinutes(5), function () {
                return News::select('news.*')
                ->join('project_home_pages as orders', 'orders.news_id', '=', 'news.id') // asumsi relasinya begitu
                ->whereHas('category', function ($query) {
                    $query->where('name', '!=', 'Project References');
                })
                ->orderBy('orders.sort_order', 'ASC')
                ->orderBy('news.created_at', 'DESC')
                ->with(['category', 'order'])
                ->take(5)
                ->get();
            });

            $some_testimonial = Cache::remember('homepage_testimonial', now()->addMinutes(5), function (){
                return Testimonials::all();
            });
    
            $data = [
                'header' => $header,
                'some_product' => $some_product,
                'some_project_reference' => $some_project_reference,
                'some_testimonial' => $some_testimonial,
                'some_news_blog' => $some_news_blog,
            ];
    
            return FormatResponseJson::success($data);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
}
