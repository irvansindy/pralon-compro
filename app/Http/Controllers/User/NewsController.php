<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
    public function fetchNewsOld(Request $request)
    {
        try {
            // Mengambil parameter dari request
            $offset = $request->offset ?? 0;
            $limit = $request->limit ?? 5;
            $category = $request->category;
            $search = $request->search;
            $init_search = $request->init_search ?? false;

            // Query dasar dengan relasi
            $news_query = News::with(['category', 'NewsImageDetail']);

            // Jika init_search false, kembalikan semua data berita
            if (!$init_search) {
                $news = $news_query->orderBy('date', 'desc')->get();
            } else {
                // Filter berdasarkan kategori jika ada
                if (!empty($category)) {
                    $news_query->whereHas('category', function ($q) use ($category) {
                        $q->where('id', $category);
                    })->orWhere('news_category_id', $category);
                }

                // Filter berdasarkan pencarian jika ada
                if (!empty($search)) {
                    $news_query->where(function ($q) use ($search) {
                        $q->whereHas('category', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhere('title', 'like', '%' . $search . '%')
                        ->orWhere('date', 'like', '%' . $search . '%');
                    });
                }

                // Batasi hasil berdasarkan offset dan limit
                $news = $news_query
                    ->orderBy('date', 'desc')
                    ->offset($offset)
                    ->limit($limit)
                    ->get();
            }

            // Kembalikan respon berhasil
            return FormatResponseJson::success($news, 'Berita berhasil diambil');
        } catch (\Throwable $th) {
            // Tangani error
            return FormatResponseJson::error(null, $th->getMessage(), 404);
        }
    }
    public function fetchNews(Request $request)
    {
        try {
            // Ambil parameter dari request
            $offset = $request->offset ?? 0; // Offset awal, default 0
            $limit = $request->limit ?? 5;   // Default 5 data per load
            $category = $request->category; // Kategori, opsional
            $search = $request->search;     // Pencarian, opsional
            
            // Query dasar
            $news_query = News::with(['category']);

            if ($offset >= 15) {
                return FormatResponseJson::success([], 'Tidak ada data lagi untuk dimuat');
            }

            // Filter kategori jika ada
            if (!empty($category)) {
                $news_query->whereHas('category', function ($q) use ($category) {
                    $q->where('id', $category);
                })->orWhere('news_category_id', $category);
            }

            // Filter pencarian jika ada
            if (!empty($search)) {
                $news_query->where(function ($q) use ($search) {
                    $q->whereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhere('title', 'like', '%' . $search . '%')
                    ->orWhere('date', 'like', '%' . $search . '%');
                });
            }

            // Ambil data berdasarkan offset dan limit
            $news = $news_query
                ->orderBy('date', 'desc')
                ->offset($offset)
                ->limit($limit)
                ->get();
            
            return FormatResponseJson::success($news, 'Berita berhasil dimuat');
        } catch (\Throwable $th) {
            // Tangani error
            return FormatResponseJson::error(null, $th->getMessage(), 404);
        }
    }


}
