<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Cache;
class NewsController extends Controller
{
    public function index()
    {
        return view('users.news.index');
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
            $news = News::with(['category', 'NewsImageDetail'])->where('id', $request->id)->first();
            return FormatResponseJson::success($news,'News berhasil diambil');
            // return view('users.news.detail', compact('news'));
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 404);
        }
    }
    public function fetchNewsWithCache(Request $request)
    {
        try {
            $offset = $request->offset ?? 0;
            $limit = $request->limit ?? 5;
            $category = $request->category;
            $search = $request->search;
            $id = $request->id;
            // dd($id);
            // Jika ada id, ambil data berita berdasarkan id dan return hasilnya
            if (!empty($id)) {
                $cacheKey = "news_detail_{$id}";

                $news = Cache::remember($cacheKey, 60, function () use ($id) {
                    return News::with(['category', 'newsImageDetail'])->find($id);
                });

                if ($news) {
                    return FormatResponseJson::success($news, 'Detail berita berhasil dimuat');
                } else {
                    return FormatResponseJson::error(null, 'Berita tidak ditemukan', 404);
                }
            }

            // Cek batas offset
            if ($offset >= 15) {
                return FormatResponseJson::success([], 'Tidak ada data lagi untuk dimuat');
            }

            // Buat cache key unik untuk daftar berita
            $cacheKey = "news_offset_{$offset}_limit_{$limit}_category_" . ($category ?? 'all') . "_search_" . ($search ?? 'none');

            $news = Cache::remember($cacheKey, 60, function () use ($offset, $limit, $category, $search) {
                $news_query = News::with(['category']);

                if (!empty($category)) {
                    $news_query->whereHas('category', function ($q) use ($category) {
                        $q->where('id', $category);
                    })->orWhere('news_category_id', $category);
                }

                if (!empty($search)) {
                    $news_query->where(function ($q) use ($search) {
                        $q->whereHas('category', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhere('title', 'like', '%' . $search . '%')
                        ->orWhere('date', 'like', '%' . $search . '%');
                    });
                }

                return $news_query->orderBy('date', 'desc')->offset($offset)->limit($limit)->get();
            });

            return FormatResponseJson::success($news, 'Berita berhasil dimuat');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 404);
        }
    }

}
