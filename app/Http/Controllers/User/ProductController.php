<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Helpers\FormatResponseJson;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\productBrocure;
use App\Models\productPriceList;
use App\Models\LogUserDownload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Mail;
use App\Mail\CompanyMail;
use App\Models\EmailTemplate;
class ProductController extends Controller
{
    public function index(): View
    {
        return view('users.product.index');
    }
    public function fetchCategories()
    {
        $product_categories = ProductCategory::orderBy('ordering','ASC')->get();
        return FormatResponseJson::success($product_categories, 'categories fetch successfully');
    }
    public function fetchProduct()
    {
        try {
            $product = Product::orderBy('id','ASC')->paginate(8);
            
            // return FormatResponseJson::success($product, 'data produk berhasil diambil');
            return response()->json($product);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null,$th->getMessage(),500);
        }
    }
    public function detailProduct($id, $slug)
    {
        $product = Product::with(['detailProduct.feature', 'detailImage', 'brocure', 'priceList'])
        ->where('id', $id)
        ->where('slug', $slug)
        ->orderBy('id','ASC')
        ->firstOrFail();
        
        $related_products = Product::where('id', '!=', $id)
        ->inRandomOrder()->take(3)->get();
        // dd($product);
        return view('users.product.product_detail', compact('product', 'related_products'));
    }
    public function fetchProductByCategoty(Request $request)
    {
        try {
            $category_id = $request->category_id;
            if ($category_id == 0) {
                $product = Product::orderBy('id','ASC')->paginate(8);
            } else {
                $product = Product::where('category_id',$category_id)->paginate(8);
            }
            return response()->json($product);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null,$th->getMessage(),404);
        }
    }
    // public function downloadCatalog(Request $request)
    public function downloadCatalog($catalog)
    {
        try {
            $existing_brocure = productBrocure::where('file_name', $catalog)->first();
            $file_path = public_path($existing_brocure->brocure_file);
            if (file_exists($file_path)) {
                return response()->download($file_path);
            }
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null,$th->getMessage(),404);
        }
    }
    public function downloadPriceList($pricelist)
    {
        try {
            $existing_price_list = productPriceList::where('file_name', $pricelist)->first();
            // dd($existing_price_list);
            $file_path = public_path($existing_price_list->price_list_file);
            if (file_exists($file_path)) {
                return response()->download($file_path);
            }
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null,$th->getMessage(),404);
        }

    }
    public function storeLogUserDownload(Request $request)
    {
        try {
            $log = LogUserDownload::create([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'email'=> $request->email,
            ]);
    
            // $file = $request->product_brocure;
            return FormatResponseJson::success($log,'success');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null,'Field tidak boleh kosong', 500);
        }
    }
    public function sendEmailDownloaded(Request $request)
    {
        try {
            // dd($request->all());
            $name = $request->name;
            $email = $request->email;
            $phone_number = $request->phone_number;
            $type_service = $request->type_service;
            $message_contact = $request->message_contact;

            // $existing_template = EmailTemplate::where('email_type', 'lke', '%'.'penjualan'.'%')->first();
            $existing_template = EmailTemplate::where('email_type', 'lke', '%penjualan%')->first();
            dd($existing_template);
            Mail::to($email)->send(new CompanyMail([
                'title' => 'The Title',
                'body' => 'Salam hangat,<br/>Sales Marketing Pralon',
            ]));
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
