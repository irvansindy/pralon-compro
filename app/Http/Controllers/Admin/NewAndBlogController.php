<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\News;
class NewAndBlogController extends Controller
{
    public function index()
    {
        return view('admin.new_blog.index');
    }
    public function fetchNews()
    {
        try {
            //code...
            $news = News::orderBy('created_at','desc')->get();
            return FormatResponseJson::success($news, 'news and blog fetched successfully');
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function storeNewsBlog(Request $request)
    {
        
    }
}
