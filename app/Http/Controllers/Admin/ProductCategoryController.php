<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
class ProductCategoryController extends Controller
{
    public function index()
    {
        return view('admin.product.categories.index');
    }
    public function fetchCategories()
    {
        try {
            $categories = ProductCategory::all();
            return FormatResponseJson::success($categories, 'product categories fetched successfully');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, 'product categories fetched unsuccessfully', 500);
        }
    }
    public function storeCategory(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'product_category_name'=> 'required|string|unique:product_categories,name',
            ], [
                'product_category_name.required' => 'Kategori tidak boleh kosong',
                'product_category_name.unique' => 'Kategori tersebut sudah tersedia'
            ]);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            $latest = ProductCategory::latest()->first();
            $data = [
                'name' => $request->product_category_name,
                'ordering' => $latest->ordering + 1,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $category = ProductCategory::create($data);
            DB::commit();
            return FormatResponseJson::success($category,'product category created successfully');
        } catch (ValidationException $e) {
            // Return validation errors as JSON response
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function updateCategory(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'product_category_name'=> 'required|string|unique:product_categories,name',
            ], [
                'product_category_name.required' => 'Kategori tidak boleh kosong',
                'product_category_name.unique' => 'Kategori tersebut sudah tersedia'
            ]);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            $existing_category = ProductCategory::where('id', $request->product_category_id)->first();
            // dd($existing_category);
            // $data = ;
            if ($existing_category) {
                $existing_category->update([
                    'name' => $request->product_category_name,
                ]);
            }
            DB::commit();
            return FormatResponseJson::success($existing_category,'product category updated successfully');
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
