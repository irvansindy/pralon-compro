<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Cache;
use App\Models\Product;
use App\Models\News;
class HomeController extends Controller
{
    public function index(): View
    {
        return view('users.home.index');
    }
    public function fetchContent()
    {
        try {
            $some_product = Cache::remember('some_product', now()->addMinutes(10), function () {
                // Ambil produk tetap (B, C, A) dengan urutan yang ditentukan
                $fixedProducts = Product::whereIn('name', ['Pralon HDPE', 'Pipa uPVC SNI', 'Pralon Standard'])
                    ->orderByRaw("FIELD(name, 'Pralon HDPE', 'Pipa uPVC SNI', 'Pralon Standard')")
                    ->get();
            
                // Ambil 7 produk lainnya secara acak, kecuali yang sudah diambil
                $randomProducts = Product::whereNotIn('name', ['Pralon HDPE', 'Pipa uPVC SNI', 'Pralon Standard'])
                    // ->inRandomOrder()
                    ->limit(10)
                    ->get();
            
                // Gabungkan hasil
                return $fixedProducts->merge($randomProducts);
            });
    
            $some_project_reference = Cache::remember('some_project_reference', now()->addMinutes(10), function () {
                return News::whereHas('category', function ($query) {
                    $query->where('name', 'Project References');
                })->inRandomOrder()->take(5)->get();
            });
    
            $some_news_blog = Cache::remember('some_news_blog', now()->addMinutes(10), function () {
                return News::with(['category'])->whereHas('category', function ($query) {
                    $query->where('name', '!=', 'Project References');
                })->inRandomOrder()->take(5)->get();
            });
    
            $data = [
                'some_product' => $some_product,
                'some_project_reference' => $some_project_reference,
                'some_news_blog' => $some_news_blog,
            ];
    
            return FormatResponseJson::success($data);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
}
