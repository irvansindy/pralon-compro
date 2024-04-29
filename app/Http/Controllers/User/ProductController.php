<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Helpers\FormatResponseJson;
use App\Models\Product;
use App\Models\DetailProduct;
use App\Models\ProductDetailFeature;
class ProductController extends Controller
{
    public function index(): View
    {
        return view('users.product.index');
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
        // dd($related_products);
        return view('users.product.product_detail', compact('product', 'related_products'));
    }
}
