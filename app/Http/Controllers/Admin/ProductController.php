<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\DetailProduct;
use App\Models\DetailImageProduct;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.master.index');
    }
    public function fetchProduct()
    {
        try {
            $products = Product::orderBy('created_at', 'desc')->get();
            return FormatResponseJson::success($products, 'products fetched successfully');
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function fetchProductById(request $request)
    {
        try {
            // dd($request->id);
            $product = Product::with(['detailProduct', 'detailImage', 'priceList', 'brocure'])
            ->where('id', $request->id)
            ->first();
            $categories = ProductCategory::get(['id', 'name']);
            $json_result = [
                'product' => $product,
                'categories' => $categories
            ];
            return FormatResponseJson::success($json_result, 'products fetched successfully');
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function storeProduct(Request $request)
    {
        try {
            DB::beginTransaction();
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'master_product_name' => 'required|string',
                'master_product_full_name' => 'required|string',
                'master_product_category' => 'required|string',
                'master_product_short_desc' => 'required|string',
                'master_product_main_desc' => 'required|string',
                'master_product_detail_title' => 'required|string',
                'master_product_detail_subtitle' => 'required|string',
                'master_product_detail_desc' => 'required|string',
                'master_product_image' => 'required|image|max:10000|mimes:jpg,jpeg,png',
                'master_product_image_detail.*' => 'required|image|max:10000|mimes:jpg,jpeg,png',
            ]);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            // master image
            $file_master_product_image = $request->file('master_product_image');
            $slug_name = Str::slug($request->master_product_full_name.' master_image', '-');
            $file_master_product_image_name = $slug_name.'.'.$file_master_product_image->getClientOriginalExtension();
            
            $master_product = [
                'category_id' => $request->master_product_category,
                'name' => $request->master_product_name,
                'full_name' => $request->master_product_full_name,
                'slug' => Str::of($request->master_product_name)->slug('-'),
                'short_desc' => $request->master_product_short_desc,
                'main_desc' => $request->master_product_main_desc,
                'image' => 'storage/uploads/master_image/'.$file_master_product_image_name,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $create_master_product = Product::create($master_product);
            if($create_master_product) {
                $file_master_product_image->move(public_path('storage/uploads/master_image/'), $file_master_product_image_name);
            }
            // detail image
            $detail_product = [
                'product_id' => $create_master_product->id,
                'title' => $request->master_product_detail_title,
                'subtitle' => $request->master_product_detail_subtitle,
                'desc' => $request->master_product_detail_desc,
                'ordering' => 2,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $create_detail_product = DetailProduct::create($detail_product);
            
            for ($i=0; $i < count($request->master_product_image_detail); $i++) { 
                $file_master_product_image_detail = $request->file('master_product_image_detail')[$i];
                $slug_name = Str::slug($request->master_product_full_name.'detail_image_'.$i, '-');
                $file_master_product_image_detail_name = $slug_name.'.'.$file_master_product_image_detail->getClientOriginalExtension();
                
                $detail_image = [
                    'product_id' => $create_master_product->id,
                    'image_detail' => 'storage/uploads/detail_image/'.$file_master_product_image_detail_name,
                    // 'image_detail' => $file_master_product_image_detail_name,
                    'ordering' => $i+1,
                    // 'created_at' => date('Y-m-d H:i:s'),
                ];
                $create_detail_image = DetailImageProduct::create($detail_image);

                // dd($create_detail_image);
                if ($create_detail_image) {
                    # code...
                    $file_master_product_image_detail->move(public_path('storage/uploads/detail_image/'), $file_master_product_image_detail_name);
                }
            }

            DB::commit();
            return FormatResponseJson::success($master_product,'product created successfully');
        } catch (ValidationException $e) {
            // Return validation errors as JSON response
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function updateProduct(Request $request)
    {
        try {
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'master_product_name' => 'required|string',
                'master_product_full_name' => 'required|string',
                'master_product_category' => 'required|string',
                'master_product_short_desc' => 'required|string',
                'master_product_main_desc' => 'required|string',
                'master_product_detail_title' => 'required|string',
                'master_product_detail_subtitle' => 'required|string',
                'master_product_detail_desc' => 'required|string',
                // 'master_product_image' => 'required|image|max:10000|mimes:jpg,jpeg,png',
                // 'master_product_image_detail.*' => 'required|image|max:10000|mimes:jpg,jpeg,png',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $existing_product = Product::find($request->master_product_id);
            
            if ($existing_product) {
                $existing_product->update([
                    'category_id' => $request->master_product_category,
                    'name' => $request->master_product_name,
                    'full_name' => $request->master_product_full_name,
                    'slug' => Str::of($request->master_product_name)->slug('-'),
                    'short_desc' => $request->master_product_short_desc,
                    'main_desc' => $request->master_product_main_desc,
                ]);
            }

            if($request->master_product_image != null) {
                // check existing master image
                $old_master_image_path = public_path($existing_product->image);
                if (file_exists($old_master_image_path)) {
                    unlink($old_master_image_path);
                }
                // master image
                $file_master_product_image = $request->file('master_product_image');
                $slug_name = Str::slug($request->master_product_full_name.' master_image', '-');
                $file_master_product_image_name = $slug_name.'.'.$file_master_product_image->getClientOriginalExtension();
                $existing_product->update([
                    'update' => 'storage/uploads/master_image/'.$file_master_product_image_name,
                ]);
                $file_master_product_image->move(public_path('storage/uploads/master_image/'), $file_master_product_image_name);
            }

            $existing_product_detail = DetailProduct::where('product_id', $request->master_product_id)->first();
            $existing_product_detail->update([
                'product_id' => $existing_product->id,
                'title' => $request->master_product_detail_title,
                'subtitle' => $request->master_product_detail_subtitle,
                'desc' => $request->master_product_detail_desc,
            ]);

            if($request->master_product_image_detail_1 != null) {
                $existing_detail_image_1 = DetailImageProduct::where('product_id', $request->master_product_id)
                ->where('image_detail', $request->master_product_image_detail_link_1)
                ->first();

                $file_master_product_image_detail = $request->file('master_product_image_detail_1');
                $slug_name = Str::slug($request->master_product_full_name.' detail_image_0', '-');
                $file_master_product_image_detail_name = $slug_name.'.'.$file_master_product_image_detail->getClientOriginalExtension();
                
                $old_detail_image_1_path = public_path($existing_detail_image_1->image_detail);
                if (file_exists($old_detail_image_1_path)) {
                    unlink($old_detail_image_1_path);
                }
                $file_master_product_image_detail->move(public_path('storage/uploads/detail_image/'), $file_master_product_image_detail_name);
            }
            
            if($request->master_product_image_detail_2 != null) {
                $existing_detail_image_2 = DetailImageProduct::where('product_id', $request->master_product_id)
                ->where('image_detail', $request->master_product_image_detail_link_2)
                ->first();

                $file_master_product_image_detail = $request->file('master_product_image_detail_2');
                $slug_name = Str::slug($request->master_product_full_name.' detail_image_1', '-');
                $file_master_product_image_detail_name = $slug_name.'.'.$file_master_product_image_detail->getClientOriginalExtension();
                
                $old_detail_image_2_path = public_path($existing_detail_image_2->image_detail);
                if (file_exists($old_detail_image_2_path)) {
                    unlink($old_detail_image_2_path);
                }
                $file_master_product_image_detail->move(public_path('storage/uploads/detail_image/'), $file_master_product_image_detail_name);
            }

            
            DB::commit();
            return FormatResponseJson::success($existing_product,'product updated successfully.');
        } catch (ValidationException $e) {
            // Return validation errors as JSON response
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
}
