<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeaderHomePage;
use App\Models\HistoryAboutUs;
use App\Models\Product;
use App\Models\News;
use App\Models\Testimonials;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
class HomePageController extends Controller
{
    public function index()
    {
        return view('admin.homepage.index');
    }
    public function fetchHeader(Request $request)
    {
        try {
            $header = HeaderHomePage::first();
            $header != null ? $message = 'Header Home Page fetched successfully' : $message = 'Header Home Page empty';
            return FormatResponseJson::success($header, $message);
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function createOrUpdateHeader(Request $request)
    {
        try {
            // Validasi dasar
            $rules = [
                'header_title' => 'required|string',
                'header_subtitle' => 'required|string',
                'header_description' => 'required|string',
            ];

            // Tambah validasi image kalau ada file
            if ($request->hasFile('header_image_cover')) {
                $rules['header_image_cover'] = 'image|mimes:jpg,jpeg,png,webp|max:2048';
            }

            // Tambah validasi video kalau ada file
            if ($request->hasFile('header_video')) {
                $rules['header_video'] = 'file|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime|max:10240';
            }

            $messages = [
                'header_title.required' => 'Judul header wajib diisi.',
                'header_title.string' => 'Judul header harus berupa teks.',
                'header_subtitle.required' => 'Subjudul header wajib diisi.',
                'header_subtitle.string' => 'Subjudul header harus berupa teks.',
                'header_description.required' => 'Deskripsi header wajib diisi.',
                'header_description.string' => 'Deskripsi header harus berupa teks.',
                'header_image_cover.image' => 'File yang diunggah harus berupa gambar.',
                'header_image_cover.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
                'header_image_cover.max' => 'Ukuran gambar maksimal 2MB.',
                'header_video.file' => 'File yang diunggah harus berupa file video.',
                'header_video.mimetypes' => 'Format video harus MP4, AVI, MPEG, atau MOV.',
                'header_video.max' => 'Ukuran video maksimal 20MB.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            // Cek apakah data sudah ada
            $existing_header = HeaderHomePage::where('id', $request->header_id)->first();
            // Inisialisasi variabel path
            $imagePath = $existing_header->image_cover ?? null;
            $videoPath = $existing_header->video ?? null;

            // Cek & hapus file lama jika ada upload baru
            if ($request->hasFile('header_image_cover')) {
                if ($existing_header && $existing_header->image_cover && \Storage::disk('public')->exists($existing_header->image_cover)) {
                    \Storage::disk('public')->delete($existing_header->image_cover);
                }

                $imagePath = $request->file('header_image_cover')->store('uploads/headers/images', 'public');
            }

            if ($request->hasFile('header_video')) {
                if ($existing_header && $existing_header->video_path && \Storage::disk('public')->exists($existing_header->video_path)) {
                    \Storage::disk('public')->delete($existing_header->video_path);
                }

                $videoPath = $request->file('header_video')->store('uploads/headers/videos', 'public');
            }
            // Simpan / update data
            $header = HeaderHomePage::updateOrCreate(
                ['id' => $request->header_id],
                [
                    'title' => $request->header_title,
                    'subtitle' => $request->header_subtitle,
                    'description' => $request->header_description,
                    'video' => $videoPath,
                    'image_cover' => $imagePath,
                ]
            );
            return FormatResponseJson::success($header, 'Header Home Page saved successfully');
        } catch (ValidationException $e) {
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function fetchProduct(Request $request)
    {
        try {
            $homeProducts = DB::table('product_home_pages')
            ->rightJoin('products', 'product_home_pages.product_id', '=', 'products.id')
            ->select(
                'products.id as product_id',
                'products.name as product_name',
                'products.full_name as product_full_name',
                'products.image as product_image',
                'product_home_pages.id as homepage_id',
                'product_home_pages.sort_order'
            )
            ->orderBy('product_home_pages.sort_order')
            ->get();
        
            return FormatResponseJson::success($homeProducts, 'Product Home Page fetched successfully');
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function reOrderProduct(Request $request)
    {
        try {
            foreach ($request->order as $item) {
                $product = Product::with('homepage')->find($item['id']);
    
                if ($product) {
                    if (!$product->homepage) {
                        $product->homepage()->create([
                            'sort_order' => $item['sort_order']
                        ]);
                    } else {
                        $product->homepage->sort_order = $item['sort_order'];
                        $product->homepage->save();
                    }
                }
            }
    
            return FormatResponseJson::success(true, 'Product Home Page reordered successfully');
        } catch (\Exception $e) {
            \Log::error('Reorder Error: ' . $e->getMessage());
    
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function fetchAboutUs(Request $request)
    {
        try {
            $about_us = HistoryAboutUs::first();
            $about_us != null ? $message = 'About Us Page fetched successfully' : $message = 'About Us Page empty';
            return FormatResponseJson::success($about_us, $message);
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function createOrUpdateAboutUs(Request $request)
    {
        try {
            // dd($request->all());
            $validation = Validator::make($request->all(), [
                'history_title' => 'required|string',
                'history_subtitle' => 'required|string',
                'history_source_thumbnail_video' => 'nullable|image|max:10000|mimes:jpg,jpeg,png',
                'history_source_video' => 'required|string',
                'history_desc' => 'required|string',
            ], [
                'history_title.required' => 'Judul wajib diisi.',
                'history_title.string' => 'Judul harus berupa teks.',
            
                'history_subtitle.required' => 'Subjudul wajib diisi.',
                'history_subtitle.string' => 'Subjudul harus berupa teks.',
            
                'history_source_thumbnail_video.image' => 'Thumbnail harus berupa file gambar.',
                'history_source_thumbnail_video.max' => 'Ukuran thumbnail maksimal 10MB.',
                'history_source_thumbnail_video.mimes' => 'Format thumbnail harus jpg, jpeg, atau png.',
            
                'history_source_video.required' => 'Sumber video wajib diisi.',
                'history_source_video.string' => 'Sumber video harus berupa teks.',
            
                'history_desc.required' => 'Deskripsi wajib diisi.',
                'history_desc.string' => 'Deskripsi harus berupa teks.',
            ]);
            
            
            if ($validation->fails()) {
                throw new ValidationException($validation);
            }
            
            $thumbnailPath = null;

            if ($request->hasFile('history_source_thumbnail_video')) {
                $file = $request->file('history_source_thumbnail_video');
                $slug_name = Str::slug($request->history_title . ' thumbnail_video', '-');
                $fileName = $slug_name . '.' . $file->getClientOriginalExtension();
                $uploadPath = public_path('storage/uploads/thumbnail_video/');
                $newThumbnailPath = 'storage/uploads/thumbnail_video/' . $fileName;

                // Ambil data lama (untuk cek thumbnail sebelumnya)
                $existingData = HistoryAboutUs::find($request->id);
                if ($existingData && $existingData->source_thumbnail_video) {
                    $oldFile = public_path($existingData->source_thumbnail_video);
                    if (file_exists($oldFile)) {
                        @unlink($oldFile); // hapus file lama
                    }
                }

                // Upload file baru
                $file->move($uploadPath, $fileName);

                // Set path baru
                $thumbnailPath = $newThumbnailPath;
            }

            $data = [
                'title' => $request->history_title,
                'subtitle' => $request->history_subtitle,
                'desc' => $request->history_desc,
                'source_video' => $request->history_source_video,
                'link' => $request->history_link,
            ];
            if ($thumbnailPath) {
                $data['source_thumbnail_video'] = $thumbnailPath;
            }

            // Misal berdasarkan title yang unik (atau ganti pakai 'id' kalau ada form update dengan ID)
            $about_us = HistoryAboutUs::updateOrCreate(
                ['id' => $request->history_id],
                $data
            );

            return FormatResponseJson::success($about_us, 'About Us Page saved successfully');
            
        } catch (ValidationException $e) {
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function fetchProjectReferences(Request $request)
    {
        try {
            $project_references = DB::table('project_home_pages')
            ->rightJoin('news', 'project_home_pages.news_id', '=', 'news.id')
            ->join('news_categories','news_categories.id','=','news.news_category_id')
            ->select(
                'news.id as news_id',
                'news.title as news_title',
                'news.short_desc as project_location',
                'project_home_pages.id as homepage_id',
                'project_home_pages.sort_order'
            )->where('news_categories.name','=', 'Project References')
            ->orderBy('project_home_pages.sort_order')
            ->get();
            // news
            return FormatResponseJson::success($project_references,'Project References fetched successfully');
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function reOrderProjectReferences(Request $request)
    {
        try {
            foreach ($request->order as $item) {
                $project = News::with('order')->find($item['id']);
                // dd($project);
                if ($project) {
                    if (!$project->order) {
                        $project->order()->create([
                            'sort_order' => $item['sort_order']
                        ]);
                    } else {
                        $project->order->sort_order = $item['sort_order'];
                        $project->order->save();
                    }
                }
            }
    
            return FormatResponseJson::success(true, 'Project References Home Page reordered successfully');
        } catch (\Exception $e) {
            \Log::error('Reorder Error: ' . $e->getMessage());
    
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function fetchTestimonials(Request $request)
    {
        try {
            $testimonial = Testimonials::orderBy('created_at')->get();
            count($testimonial) > 0 ? $message = 'Testimonials fetched successfully' : $message = 'Testimonials empty';
            return FormatResponseJson::success($testimonial, $message);
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function createOrUpdateTestimonial(Request $request)
    {
        try {
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'testi_name' => 'required|string',
                'testi_position' => 'required|string',
                'testi_message' => 'required|string',
            ], [
                'testi_name.required'=> 'Nama tidak boleh kosong',
                'testi_position.required'=> 'Posisi tidak boleh kosong',
                'testi_message.required'=> 'PEsan tidak boleh kosong',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $data = [
                'name' => $request->testi_name,
                'position' => $request->testi_position,
                'message' => $request->testi_message,
            ];

            $testimoni = Testimonials::updateOrCreate([
                'id'=> $request->testi_id,
            ],$data);
            return FormatResponseJson::success($testimoni, 'Testimonial saved successfully');
        } catch (ValidationException $e) {
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function fetchTestimonialById(Request $request)
    {
        try {
            $testimonial = Testimonials::where('id', $request->id)->first();
            $testimonial != null ? $message = 'Testimonials fetched successfully' : $message = 'Testimonials empty';
            return FormatResponseJson::success($testimonial, $message);
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function fetchNews(Request $request)
    {
        try {
            $project_references = DB::table('project_home_pages')
            ->rightJoin('news', 'project_home_pages.news_id', '=', 'news.id')
            ->join('news_categories','news_categories.id','=','news.news_category_id')
            ->select(
                'news.id as news_id',
                'news.title as news_title',
                'news.short_desc as project_location',
                'project_home_pages.id as homepage_id',
                'project_home_pages.sort_order'
            )->where('news_categories.name','!=', 'Project References')
            ->orderBy('project_home_pages.sort_order')
            ->get();
            // news
            return FormatResponseJson::success($project_references,'Project References fetched successfully');
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function reOrderNews(Request $request)
    {
        try {
            foreach ($request->news as $item) {
                $project = News::with('order')->find($item['id']);
                // dd($project);
                if ($project) {
                    if (!$project->order) {
                        $project->order()->create([
                            'sort_order' => $item['sort_order']
                        ]);
                    } else {
                        $project->order->sort_order = $item['sort_order'];
                        $project->order->save();
                    }
                }
            }
    
            return FormatResponseJson::success(true, 'Project References Home Page reordered successfully');
        } catch (\Exception $e) {
            \Log::error('Reorder Error: ' . $e->getMessage());
    
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
}
