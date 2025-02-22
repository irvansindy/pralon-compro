<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\DB;
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
            $some_product = Product::inRandomOrder()->inRandomOrder()->take(8)->get();
            $some_project_reference = News::whereHas('category', function ($query) use ($some_product) {
                $query->where('name', 'Project References');
            })->inRandomOrder()->take(5)->get();
            $some_news_blog = News::with(['category'])->whereHas('category', function ($query) use ($some_product) {
                $query->where('name', '!=', 'Project References');
            })->inRandomOrder()->take(5)->get();
            $data = [
                'some_product'=> $some_product,
                'some_project_reference'=> $some_project_reference,
                'some_news_blog'=> $some_news_blog,
            ];
            return FormatResponseJson::success($data);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null,$th->getMessage(), 500);
        }
    }
}
