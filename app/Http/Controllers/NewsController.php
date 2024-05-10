<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;
use App\Helpers\FormatResponseJson;
class NewsController extends Controller
{
    public function index()
    {
        return view('users.news.index');
    }
    public function fetchNews(Request $request)
    {
        try {
            $offset = $request->offset;
            $limit = $request->limit;
            $category = $request->category;
            $search = $request->search;

            $news_query = News::with(['category', 'imageDetail']);
            if ($category == NULL || $search == NULL) {
                // dd($request->search);
                if ($request->init_search == true) {
                    // dd($request->init_search);
                    $news = $news_query->orderBy('date', 'desc')->get();
                } else {
                    $news = $news_query->orderBy('date', 'desc')
                    ->offset($offset)
                    ->limit($limit)
                    ->get();
                }
            } else {
                if (!empty($category)) {
                    $news_query->whereHas('category', function ($q) use ($category) {
                        $q->where('id', $category);
                    })->orWhere('news_category_id', $category);
                }
    
                if(!empty($search)) {
                    $news_query->whereHas('category', function ($q) use ($search) {
                        $q->where('name','like','%'.$search.'%');
                    })
                    ->orWhere('title','like','%'.$search.'%')
                    ->orWhere('date','like','%'.$search.'%');
                }
                $news = $news_query->orderBy('date','desc')->get();
            }
            return FormatResponseJson::success($news, 'Berita berhasil diambil');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 404);
        }
    }
    public function fetchNewsCategories()
    {
        try {
            $categories = NewsCategory::all();
            return FormatResponseJson::success($categories,'Kategori berhasil diambil');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 404);
        }
    }
    public function fetchRecentPost()
    {
        try {
            $recent_posts = News::orderBy('date','desc')->limit(3)->get(['id', 'title', 'date', 'image']);
            return FormatResponseJson::success($recent_posts,'recent post berhasil diambil');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 404);
        }
    }
    public function fetchNewsDetail(Request $request)
    {
        try {
            $news = News::with(['category', 'imageDetail'])->where('id', $request->id)->first();
            return FormatResponseJson::success($news,'News berhasil diambil');
            // return view('users.news.detail', compact('news'));
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 404);
        }
    }
}
