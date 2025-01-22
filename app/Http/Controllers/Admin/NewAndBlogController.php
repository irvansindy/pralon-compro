<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use App\Models\News;
use App\Models\NewsImageDetail;
use App\Models\NewsCategory;
class NewAndBlogController extends Controller
{
    public function index()
    {
        return view('admin.news_blog.index');
    }
    public function fetchNewsBlog()
    {
        try {
            //code...
            $news = News::orderBy('created_at','desc')->get();
            return FormatResponseJson::success($news, 'news and blog fetched successfully');
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function fetchNewsBlogCategory()
    {
        try {
            $categorie = NewsCategory::orderBy('created_at','desc')->get(['id','name']);
            return FormatResponseJson::success($categorie,'categories fetched successfully');
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function storeNewsBlog(Request $request)
    {
        try {
            DB::beginTransaction();
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'news_blog_title' => 'required|string',
                'news_blog_category' => 'required|string',
                'news_blog_main_image' => 'required|image|max:10000|mimes:jpg,jpeg,png',
                'news_blog_short_desc' => 'required|string',
                'news_blog_detail_image_1' => 'required|image|max:10000|mimes:jpg,jpeg,png',
                'news_blog_detail_image_2' => 'required|image|max:10000|mimes:jpg,jpeg,png',
                'news_blog_header_content' => 'required|string',
                'news_blog_content' => 'required|string',
            ], [
                'news_blog_title.required'=> 'Title tidak boleh kosong',
                'news_blog_category.required'=> 'Kategori tidak boleh kosong',
                
                'news_blog_main_image.required'=> 'Gambar utama tidak boleh kosong',
                'news_blog_main_image.image'=> 'File harus berbentuk gambar',
                'news_blog_main_image.mimes'=> 'Format gambar harus jpg, jpeg, png',
                'news_blog_main_image.max'=> 'Gambar maksimal 10MB',

                'news_blog_short_desc.required'=> 'Deskripsi singkat tidak boleh kosong',

                'news_blog_detail_image_1.required'=> 'Gambar detail 1 tidak boleh kosong',
                'news_blog_detail_image_1.image'=> 'File harus berbentuk gambar',
                'news_blog_detail_image_1.mimes'=> 'Format gambar harus jpg, jpeg, png',
                'news_blog_detail_image_1.max'=> 'Gambar maksimal 10MB',
                
                'news_blog_detail_image_2.required'=> 'Gambar detail 2 tidak boleh kosong',
                'news_blog_detail_image_2.image'=> 'File harus berbentuk gambar',
                'news_blog_detail_image_2.mimes'=> 'Format gambar harus jpg, jpeg, png',
                'news_blog_detail_image_2.max'=> 'Gambar maksimal 10MB',
                
                'news_blog_header_content.required'=> 'Konten paragraf awal tidak boleh kosong',
                'news_blog_content.required'=> 'Konten paragraf akhir tidak boleh kosong',
            ]);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            // master file news_blog_main_image
            $file_news_blog_main_image_file = $request->file('news_blog_main_image');
            $slug_name_news_blog_main_image_file = Str::slug(pathinfo($file_news_blog_main_image_file->getClientOriginalName(),PATHINFO_FILENAME), '-');
            $file_news_blog_main_image_file_name = $slug_name_news_blog_main_image_file.'.'.$file_news_blog_main_image_file->getClientOriginalExtension();
            
            // master file news_blog_detail_image_1
            $file_news_blog_detail_image_1_file = $request->file('news_blog_detail_image_1');
            $slug_name_news_blog_detail_image_1_file = Str::slug(pathinfo($file_news_blog_detail_image_1_file->getClientOriginalName(),PATHINFO_FILENAME), '-');
            $file_news_blog_detail_image_1_file_name = $slug_name_news_blog_detail_image_1_file.'.'.$file_news_blog_detail_image_1_file->getClientOriginalExtension();
            
            // master file news_blog_detail_image_2
            $file_news_blog_detail_image_2_file = $request->file('news_blog_detail_image_2');
            $slug_name_news_blog_detail_image_2_file = Str::slug(pathinfo($file_news_blog_detail_image_2_file->getClientOriginalName(),PATHINFO_FILENAME), '-');
            $file_news_blog_detail_image_2_file_name = $slug_name_news_blog_detail_image_2_file.'.'.$file_news_blog_detail_image_2_file->getClientOriginalExtension();

            $data_news_blog = [
                'news_category_id'=> $request->news_blog_category,
                'title'=> $request->news_blog_title,
                'image'=> 'storage/uploads/news_blog/'.$file_news_blog_main_image_file_name,
                'short_desc'=> $request->news_blog_short_desc,
                'header_content'=> $request->news_blog_header_content,
                'content'=> $request->news_blog_content,
                'date'=> date('Y-m-d H:i:s'),
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> null
            ];

            $create_news_blog = News::create($data_news_blog);

            $data_detail_image_1 = [
                'news_id'=> $create_news_blog->id,
                'file_name'=> 'storage/uploads/news_blog/detail/'.$file_news_blog_detail_image_1_file_name,
                'ordering' => 1,
            ];
            $data_detail_image_2 = [
                'news_id'=> $create_news_blog->id,
                'file_name'=> 'storage/uploads/news_blog/detail/'.$file_news_blog_detail_image_2_file_name,
                'ordering' => 2
            ];

            $create_detail_image_1 = NewsImageDetail::create($data_detail_image_1);
            $create_detail_image_2 = NewsImageDetail::create($data_detail_image_2);

            if ($create_news_blog) {
                $file_news_blog_main_image_file->move(public_path('storage/uploads/news_blog/'), $file_news_blog_main_image_file_name);
            }

            if ($create_detail_image_1 && $create_detail_image_2) {
                $file_news_blog_detail_image_1_file->move(public_path('storage/uploads/news_blog/detail/'), $file_news_blog_detail_image_1_file_name);
                $file_news_blog_detail_image_2_file->move(public_path('storage/uploads/news_blog/detail/'), $file_news_blog_detail_image_2_file_name);
            }

            DB::commit();
            return FormatResponseJson::success($create_news_blog, 'News and blog created successfully');
        } catch (ValidationException $e) {
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function fetchNewsBlogById(Request $request)
    {
        try {
            $news_blog = News::with(['category', 'NewsImageDetail'])
            ->findOrFail(intval($request->get('id')));
            return FormatResponseJson::success($news_blog, 'news and blog fetched successfully');
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        } catch (\Throwable $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function updateNewsBlog(Request $request)
    {
        try {
            DB::beginTransaction();
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'news_blog_title' => 'required|string',
                'news_blog_category' => 'required|string',
                'news_blog_short_desc' => 'required|string',
                'news_blog_header_content' => 'required|string',
                'news_blog_content' => 'required|string',
            ], [
                'news_blog_title.required'=> 'Title tidak boleh kosong',
                'news_blog_category.required'=> 'Kategori tidak boleh kosong',

                'news_blog_short_desc.required'=> 'Deskripsi singkat tidak boleh kosong',
                
                'news_blog_header_content.required'=> 'Konten paragraf awal tidak boleh kosong',
                'news_blog_content.required'=> 'Konten paragraf akhir tidak boleh kosong',
            ]);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $existing_news_blog = News::find($request->get('news_blog_id'));

            $ordering_1 = $request->news_blog_detail_image_1 != null ? 1 : null;
            $ordering_2 = $request->news_blog_detail_image_2 != null ? 2 : null;

            $data_news_blog = [
                'news_category_id'=> $request->news_blog_category,
                'title'=> $request->news_blog_title,
                'short_desc'=> $request->news_blog_short_desc,
                'header_content'=> $request->news_blog_header_content,
                'content'=> $request->news_blog_content,
            ];

            $existing_news_blog->update($data_news_blog);

            if ($ordering_1 != null) {
                # code...
                $existing_news_blog_image_detail_1 = NewsImageDetail::where('news_id', $existing_news_blog->id)
                ->where('ordering', $ordering_1)
                ->first();

                $file_news_blog_detail_image_1_file = $request->file('news_blog_detail_image_1');
                $slug_name_news_blog_detail_image_1_file = Str::slug(pathinfo($file_news_blog_detail_image_1_file->getClientOriginalName(),PATHINFO_FILENAME), '-');
                $file_news_blog_detail_image_1_file_name = $slug_name_news_blog_detail_image_1_file.'.'.$file_news_blog_detail_image_1_file->getClientOriginalExtension();
                
                $old_detail_image_1_path = public_path($existing_news_blog_image_detail_1->file_name);
                if (file_exists($old_detail_image_1_path)) {
                    unlink($old_detail_image_1_path);
                }
                $existing_news_blog_image_detail_1->update([
                    'file_name' => 'storage/uploads/news_blog/detail/'.$file_news_blog_detail_image_1_file_name
                ]);
                $file_news_blog_detail_image_1_file->move(public_path('storage/uploads/news_blog/detail/'), $file_news_blog_detail_image_1_file_name);
            }

            if ($ordering_2 != null) {
                # code...
                $existing_news_blog_image_detail_2 = NewsImageDetail::where('news_id', $existing_news_blog->id)
                ->where('ordering', $ordering_2)
                ->first();

                $file_news_blog_detail_image_2_file = $request->file('news_blog_detail_image_2');
                $slug_name_news_blog_detail_image_1_file = Str::slug(pathinfo($file_news_blog_detail_image_2_file->getClientOriginalName(),PATHINFO_FILENAME), '-');
                $file_news_blog_detail_image_2_file_name = $slug_name_news_blog_detail_image_1_file.'.'.$file_news_blog_detail_image_2_file->getClientOriginalExtension();

                $old_detail_image_2_path = public_path('storage/uploads/news_blog/detail/'.$existing_news_blog_image_detail_2->file_name);
                if (file_exists($old_detail_image_2_path)) {
                    unlink($old_detail_image_2_path);
                }
                $existing_news_blog_image_detail_2->update([
                    'file_name'=> 'storage/uploads/news_blog/detail/'.$file_news_blog_detail_image_2_file_name
                ]);
                $file_news_blog_detail_image_2_file->move(public_path('storage/uploads/news_blog/detail/'), $file_news_blog_detail_image_2_file_name);
            }

            DB::commit();

            return formatResponseJson::success($existing_news_blog, 'News and blog updated successfully');
        } catch (ValidationException $e) {
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
}
