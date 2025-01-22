<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Helpers\FormatResponseJson;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\DetailProduct;
use App\Models\ProductDetailFeature;
use App\Models\LogUserDownload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Mail;
use App\Mail\CompanyMail;
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
        // return response()->json($product);
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
    public function downloadCatalog(Request $request)
    {
        try {
            // dd($request->catalog);
            $file_path = public_path('assets/file/brocure/'. $request->catalog);
            if (file_exists($file_path)) {
                // return Response::download($file_path);
                return response()->download($file_path);
            }
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null,$th->getMessage(),404);
        }
    }
    public function downloadPriceList(Request $request)
    {
        try {
            // dd($request->catalog);
            $file_path = public_path('assets/file/pricelist/'. $request->pricelist);
            if (file_exists($file_path)) {
                // return Response::download($file_path);
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
    
            $file = $request->product_brocure;
            return FormatResponseJson::success($log,'success');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null,'Field tidak boleh kosong', 500);
        }
    }
    public function sendEmailDownloaded(Request $request)
    {
        Mail::to('irvanmuhammad22@gmail.com')->send(new CompanyMail([
            'title' => 'The Title',
            'body' => 'The Body',
        ]));
    }
}
