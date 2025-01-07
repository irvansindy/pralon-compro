<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\DetailProduct;
use App\Models\DetailImageProduct;
use App\Models\productBrocure;
use App\Models\productPriceList;
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
            $product = Product::with(['detailProduct', 'detailImage', 'priceList', 'price_list'])
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
            // 
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
            // 
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
    public function fetchBrocureByProductId(Request $request)
    {
        try {
            $existing_price_list = productBrocure::where('product_id', $request->id)->orderBy('date', 'DESC')->get();
            return FormatResponseJson::success($existing_price_list, 'product price_lists fetched successfully');
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function storeBrocure(Request $request)
    {
        try {
            
            $validator = Validator::make($request->all(), [
                'brocure_file' => 'required|file|max:50000|mimes:pdf',
                'brocure_date' => 'required|date',
            ], [
                'brocure_file.required'=> 'File tidak boleh kosong',
                'brocure_file.mimes'=> 'File harus berekstensi pdf',
                'brocure_file.max'=> 'File size maksimal 20 MB',
                'brocure_date.required'=> 'Tanggal efektif tidak boleh kosong',
            ]);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            // existing product and product brocure
            $existing_product = Product::where('id',$request->product_id_for_brocure)->first(['id', 'name']);
            // dd($existing_product);
            $check_existing_brocure = productBrocure::where('product_id','=', $request->product_id_for_brocure)
            ->get();
            $total_current_brocure = $check_existing_brocure->count();

            // master file brocure
            $file_brocure_file = $request->file('brocure_file');
            $slug_name = Str::slug($file_brocure_file->getClientOriginalName()." ".$existing_product->name." ".$total_current_brocure+1, '-');
            $file_brocure_file_name = $slug_name.'.'.$file_brocure_file->getClientOriginalExtension();
            dd($slug_name);

            $data_brocure = [
                'product_id' => $request->product_id_for_brocure,
                'brocure_file' => 'storage/uploads/brocure/'.$file_brocure_file_name,
                'status' => 'active',
                'date' => $request->brocure_date,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $create_brocure = productBrocure::create($data_brocure);
            if ($create_brocure) {
                $file_brocure_file->move(public_path('storage/uploads/brocure/'), $file_brocure_file_name);
            }

            // update other brocure to inactive
            $other_brochures = productBrocure::where('id',  '!=' , $create_brocure->id)
            ->where('product_id','=', $request->product_id_for_brocure)
            ->get();
            // dd($other_brochures);
            $other_brochures->each(function ($item) use ($request) {
                $item->status = 'inactive';
                $item->save();
            });
            return FormatResponseJson::success($create_brocure,'product brocure created successfully');

        } catch (ValidationException $e) {
            // Return validation errors as JSON response
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function updateStatusBrocure(Request $request)
    {
        // 
        // update current brocure to active
        $brocure = productBrocure::findOrFail($request->id);
        $brocure->status = $request->status;
        $brocure->save();

        // update other brocure to inactive
        $other_brochures = productBrocure::where('id',  '!=' , $request->id)
        ->where('product_id','=', $request->product_id)
        ->get();
        // dd($other_brochures);
        $other_brochures->each(function ($item) use ($request) {
            $item->status = 'inactive';
            $item->save();
        });

        return response()->json(['message' => 'Status updated successfully'], 200);
    }
    public function fetchPriceListByProductId(Request $request)
    {
        try {
            $existing_price_list = productPriceList::where('product_id', $request->id)->orderBy('date', 'DESC')->get();
            return FormatResponseJson::success($existing_price_list, 'product price lists fetched successfully');
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function storePriceList(Request $request)
    {
        try {
            
            $validator = Validator::make($request->all(), [
                'price_list_file' => 'required|file|max:50000|mimes:pdf',
                'price_list_date' => 'required|date',
            ], [
                'price_list_file.required'=> 'File tidak boleh kosong',
                'price_list_file.mimes'=> 'File harus berekstensi pdf',
                'price_list_file.max'=> 'File size maksimal 20 MB',
                'price_list_date.required'=> 'Tanggal efektif tidak boleh kosong',
            ]);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            // existing product and product price_list
            $existing_product = Product::where('id',$request->product_id_for_price_list)->first(['id', 'name']);
            $check_existing_price_list = productPriceList::where('product_id','=', $request->product_id_for_price_list)
            ->get();
            $total_current_price_list = $check_existing_price_list->count();

            // master file price_list
            $file_price_list_file = $request->file('price_list_file');
            $slug_name = Str::slug($file_price_list_file->getClientOriginalName()." ".$existing_product->name." ".$total_current_price_list+1, '-');
            $file_price_list_file_name = $slug_name.'.'.$file_price_list_file->getClientOriginalExtension();
            // dd($slug_name);

            $data_price_list = [
                'product_id' => $request->product_id_for_price_list,
                'price_list_file' => 'storage/uploads/price_list/'.$file_price_list_file_name,
                'status' => 'active',
                'date' => $request->price_list_date,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $create_price_list = productPriceList::create($data_price_list);
            if ($create_price_list) {
                $file_price_list_file->move(public_path('storage/uploads/price_list/'), $file_price_list_file_name);
            }

            // update other price_list to inactive
            $other_brochures = productPriceList::where('id',  '!=' , $create_price_list->id)
            ->where('product_id','=', $request->product_id_for_price_list)
            ->get();
            // dd($other_brochures);
            $other_brochures->each(function ($item) use ($request) {
                $item->status = 'inactive';
                $item->save();
            });
            return FormatResponseJson::success($create_price_list,'product price_list created successfully');

        } catch (ValidationException $e) {
            // Return validation errors as JSON response
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function updateStatusPriceList(Request $request)
    {
        // 
        // update current price_list to active
        $price_list = productPriceList::findOrFail($request->id);
        $price_list->status = $request->status;
        $price_list->save();

        // update other price_list to inactive
        $other_brochures = productPriceList::where('id',  '!=' , $request->id)
        ->where('product_id','=', $request->product_id)
        ->get();
        // dd($other_brochures);
        $other_brochures->each(function ($item) use ($request) {
            $item->status = 'inactive';
            $item->save();
        });

        return response()->json(['message' => 'Status updated successfully'], 200);
    }
}
