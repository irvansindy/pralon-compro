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
use Mews\Purifier\Facades\Purifier;
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
            $product = Product::with(['detailProduct', 'detailImage'])
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

            $validator = Validator::make($request->all(), [
                'master_product_name'           => 'required|string|max:255',
                'master_product_full_name'      => 'required|string|max:255',
                'master_product_category'       => 'required|integer',
                'master_product_short_desc'     => 'required|string',
                'master_product_main_desc'      => 'required|string',
                'master_product_detail_title'   => 'required|string',
                'master_product_detail_subtitle'=> 'required|string',
                'master_product_detail_desc'    => 'required|string',
                'master_product_image'          => 'required|image|max:10000|mimes:jpg,jpeg,png',
                'master_product_image_detail.*' => 'required|image|max:10000|mimes:jpg,jpeg,png',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $cleanData = [
                'category_id'   => (int) $request->master_product_category,
                'name'          => Purifier::clean(strip_tags($request->master_product_name)),
                'full_name'     => Purifier::clean(strip_tags($request->master_product_full_name)),
                'slug'          => Str::slug($request->master_product_name, '-'),
                'short_desc'    => Purifier::clean($request->master_product_short_desc),
                'main_desc'     => Purifier::clean($request->master_product_main_desc),
                'created_at'    => now(),
            ];

            // Upload master image
            $cleanData['image'] = $this->storeImage(
                $request->file('master_product_image'),
                'storage/uploads/master_image/',
                $cleanData['full_name'] . ' master_image'
            );

            $product = Product::create($cleanData);

            // Insert detail
            DetailProduct::create([
                'product_id' => $product->id,
                'title'      => Purifier::clean($request->master_product_detail_title),
                'subtitle'   => Purifier::clean($request->master_product_detail_subtitle),
                'desc'       => Purifier::clean($request->master_product_detail_desc),
                'ordering'   => 1,
                'created_at' => now(),
            ]);

            // Upload multiple detail images
            foreach ($request->file('master_product_image_detail') as $index => $file) {
                DetailImageProduct::create([
                    'product_id'    => $product->id,
                    'image_detail'  => $this->storeImage(
                        $file,
                        'storage/uploads/detail_image/',
                        $cleanData['full_name'] . '_detail_image_' . ($index + 1)
                    ),
                    'ordering'      => $index + 1,
                    'created_at'    => now(),
                ]);
            }

            DB::commit();
            return FormatResponseJson::success($product, 'Product created successfully.');
        } catch (ValidationException $e) {
            DB::rollBack();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function updateProduct(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'master_product_name'           => 'required|string|max:255',
                'master_product_full_name'      => 'required|string|max:255',
                'master_product_category'       => 'required|integer',
                'master_product_short_desc'     => 'required|string',
                'master_product_main_desc'      => 'required|string',
                'master_product_detail_title'   => 'required|string',
                'master_product_detail_subtitle'=> 'required|string',
                'master_product_detail_desc'    => 'required|string',
                'master_product_image'          => 'nullable|image|max:10000|mimes:jpg,jpeg,png',
                'master_product_image_detail_1' => 'nullable|image|max:10000|mimes:jpg,jpeg,png',
                'master_product_image_detail_2' => 'nullable|image|max:10000|mimes:jpg,jpeg,png',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $existing_product = Product::findOrFail($request->master_product_id);

            $cleanData = [
                'name'          => Purifier::clean($request->master_product_name),
                'full_name'     => Purifier::clean($request->master_product_full_name),
                'category_id'   => (int) $request->master_product_category,
                'slug'          => Str::slug($request->master_product_name, '-'),
                'short_desc'    => Purifier::clean($request->master_product_short_desc),
                'main_desc'     => Purifier::clean($request->master_product_main_desc),
            ];

            $existing_product->update($cleanData);

            // Replace master image if uploaded
            if ($request->hasFile('master_product_image')) {
                $this->replaceImage(
                    $existing_product->image,
                    $request->file('master_product_image'),
                    'storage/uploads/master_image/',
                    function ($newPath) use ($existing_product) {
                        $existing_product->update(['image' => $newPath]);
                    }
                );
            }

            // Update product detail
            $existing_detail = DetailProduct::where('product_id', $existing_product->id)->first();
            if ($existing_detail) {
                $existing_detail->update([
                    'title'    => Purifier::clean($request->master_product_detail_title),
                    'subtitle' => Purifier::clean($request->master_product_detail_subtitle),
                    'desc'     => Purifier::clean($request->master_product_detail_desc),
                ]);
            }

            // Replace detail images if uploaded
            $this->updateDetailImage($request, $existing_product->id, 'master_product_image_detail_1', 1);
            $this->updateDetailImage($request, $existing_product->id, 'master_product_image_detail_2', 2);

            DB::commit();
            return FormatResponseJson::success($existing_product, 'Product updated successfully.');
        } catch (ValidationException $e) {
            DB::rollBack();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    private function storeImage($file, $path, $name)
    {
        $slugName = Str::slug($name, '-');
        $fileName = $slugName . '.' . $file->getClientOriginalExtension();
        $fullPath = public_path($path);

        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0755, true);
        }

        $file->move($fullPath, $fileName);

        return $path . $fileName; // Return relative path
    }
    private function replaceImage($oldPath, $file, $path, $updateCallback)
    {
        // Delete old image
        if ($oldPath && file_exists(public_path($oldPath))) {
            unlink(public_path($oldPath));
        }

        // Upload new image
        $newPath = $this->storeImage($file, $path, pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $updateCallback($newPath);
    }
    private function updateDetailImage($request, $productId, $fieldName, $ordering)
    {
        if ($request->hasFile($fieldName)) {
            $detailImage = DetailImageProduct::where('product_id', $productId)
                ->where('ordering', $ordering)
                ->first();

            if ($detailImage) {
                $this->replaceImage(
                    $detailImage->image_detail,
                    $request->file($fieldName),
                    'storage/uploads/detail_image/',
                    function ($newPath) use ($detailImage) {
                        $detailImage->update(['image_detail' => $newPath]);
                    }
                );
            }
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
            $slug_name = Str::slug(pathinfo($file_brocure_file->getClientOriginalName(),PATHINFO_FILENAME)." ".$existing_product->name." ".$total_current_brocure+1, '-');
            $file_brocure_file_name = $slug_name.'.'.$file_brocure_file->getClientOriginalExtension();
            // $slug_name_news_blog_main_image_file = Str::slug(pathinfo($file_brocure_file->getClientOriginalName(),PATHINFO_FILENAME), '-');

            $data_brocure = [
                'product_id' => $request->product_id_for_brocure,
                'file_name' => $file_brocure_file_name,
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
            $slug_name = Str::slug(pathinfo($file_price_list_file->getClientOriginalName(),PATHINFO_FILENAME)." ".$existing_product->name." ".$total_current_price_list+1, '-');
            $file_price_list_file_name = $slug_name.'.'.$file_price_list_file->getClientOriginalExtension();
            // dd($slug_name);

            $data_price_list = [
                'product_id' => $request->product_id_for_price_list,
                'file_name' => $file_price_list_file_name,
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
