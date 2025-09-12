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
use Mews\Purifier\Facades\Purifier;
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
        $validator = Validator::make($request->all(), [
            'news_blog_title' => 'required|string',
            'news_blog_category' => 'required|string',
            'news_blog_main_image' => 'required|image|max:10240|mimes:jpg,jpeg,png',
            'news_blog_short_desc' => 'required|string',
            'news_blog_detail_image_1' => 'required|image|max:10240|mimes:jpg,jpeg,png',
            'news_blog_detail_image_2' => 'required|image|max:10240|mimes:jpg,jpeg,png',
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
            'news_blog_detail_image_2.required'=> 'Gambar detail 2 tidak boleh kosong',
            'news_blog_header_content.required'=> 'Konten paragraf awal tidak boleh kosong',
            'news_blog_content.required'=> 'Konten paragraf akhir tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return FormatResponseJson::error(null, ['errors' => $validator->errors()], 422);
        }

        try {
            DB::transaction(function () use ($request) {
                // XSS cleaning untuk input text
                $title = Purifier::clean($request->input('news_blog_title'));
                $category = Purifier::clean($request->input('news_blog_category'));
                $shortDesc = Purifier::clean($request->input('news_blog_short_desc'));
                $headerContent = Purifier::clean($request->input('news_blog_header_content'));
                $content = Purifier::clean($request->input('news_blog_content'));

                // Simpan file ke storage
                $mainImage = $request->file('news_blog_main_image');
                $detailImage1 = $request->file('news_blog_detail_image_1');
                $detailImage2 = $request->file('news_blog_detail_image_2');

                $mainImageName = Str::slug(pathinfo($mainImage->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $mainImage->getClientOriginalExtension();
                $detailImage1Name = Str::slug(pathinfo($detailImage1->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $detailImage1->getClientOriginalExtension();
                $detailImage2Name = Str::slug(pathinfo($detailImage2->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $detailImage2->getClientOriginalExtension();

                $mainImagePath = $mainImage->storeAs('uploads/news_blog', $mainImageName, 'public');
                $detailImage1Path = $detailImage1->storeAs('uploads/news_blog/detail', $detailImage1Name, 'public');
                $detailImage2Path = $detailImage2->storeAs('uploads/news_blog/detail', $detailImage2Name, 'public');

                // Insert News
                $news = News::create([
                    'news_category_id' => $category,
                    'title' => $title,
                    'image' => 'storage/' . $mainImagePath,
                    'short_desc' => $shortDesc,
                    'header_content' => $headerContent,
                    'content' => $content,
                    'date' => now(),
                    'created_at' => now(),
                    'updated_at' => null
                ]);

                // Insert Detail Images
                NewsImageDetail::create([
                    'news_id' => $news->id,
                    'file_name' => 'storage/' . $detailImage1Path,
                    'ordering' => 1,
                ]);
                NewsImageDetail::create([
                    'news_id' => $news->id,
                    'file_name' => 'storage/' . $detailImage2Path,
                    'ordering' => 2,
                ]);
            });

            return FormatResponseJson::success(null, 'News and blog created successfully');
        } catch (\Exception $e) {
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
        $validator = Validator::make($request->all(), [
            'news_blog_title' => 'required|string',
            'news_blog_category' => 'required|string',
            'news_blog_short_desc' => 'required|string',
            'news_blog_header_content' => 'required|string',
            'news_blog_content' => 'required|string',
            'news_blog_main_image' => 'nullable|image|max:10240|mimes:jpg,jpeg,png',
            'news_blog_detail_image_1' => 'nullable|image|max:10240|mimes:jpg,jpeg,png',
            'news_blog_detail_image_2' => 'nullable|image|max:10240|mimes:jpg,jpeg,png',
        ], [
            'news_blog_title.required'=> 'Title tidak boleh kosong',
            'news_blog_category.required'=> 'Kategori tidak boleh kosong',
            'news_blog_short_desc.required'=> 'Deskripsi singkat tidak boleh kosong',
            'news_blog_header_content.required'=> 'Konten paragraf awal tidak boleh kosong',
            'news_blog_content.required'=> 'Konten paragraf akhir tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return FormatResponseJson::error(null, ['errors' => $validator->errors()], 422);
        }

        try {
            DB::transaction(function () use ($request) {
                $news = News::findOrFail($request->get('news_blog_id'));

                // Update text fields
                $news->update([
                    'news_category_id' => $request->news_blog_category,
                    'title' => Purifier::clean($request->news_blog_title),
                    'short_desc' => Purifier::clean($request->news_blog_short_desc),
                    'header_content' => Purifier::clean($request->news_blog_header_content),
                    'content' => Purifier::clean($request->news_blog_content),
                ]);

                // Update main image if uploaded
                if ($request->hasFile('news_blog_main_image')) {
                    $this->replaceImage(
                        $news->image,
                        $request->file('news_blog_main_image'),
                        "uploads/news_blog",
                        function ($path) use ($news) {
                            $news->update(['image' => 'storage/' . $path]);
                        }
                    );
                }

                // Update detail images if uploaded
                foreach ([1, 2] as $order) {
                    $detailImageField = "news_blog_detail_image_{$order}";
                    if ($request->hasFile($detailImageField)) {
                        $detailImage = NewsImageDetail::where('news_id', $news->id)
                            ->where('ordering', $order)
                            ->firstOrFail();

                        $this->replaceImage(
                            $detailImage->file_name,
                            $request->file($detailImageField),
                            "uploads/news_blog/detail",
                            function ($path) use ($detailImage) {
                                $detailImage->update(['file_name' => 'storage/' . $path]);
                            },
                            "_$order"
                        );
                    }
                }
            });

            return FormatResponseJson::success(null, 'News and blog updated successfully');
        } catch (ValidationException $e) {
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Helper untuk hapus file lama & upload file baru.
     */
    private function replaceImage($oldPath, $newFile, $folder, $callback, $suffix = '')
    {
        // Hapus file lama
        if ($oldPath && \Storage::disk('public')->exists(str_replace('storage/', '', $oldPath))) {
            \Storage::disk('public')->delete(str_replace('storage/', '', $oldPath));
        }

        // Generate slug nama file baru
        $slugName = Str::slug(pathinfo($newFile->getClientOriginalName(), PATHINFO_FILENAME));
        $newFileName = "{$slugName}{$suffix}." . $newFile->getClientOriginalExtension();

        // Simpan file baru
        $path = $newFile->storeAs($folder, $newFileName, 'public');

        // Jalankan callback update
        $callback($path);
    }

}
