<?php

namespace App\Http\Controllers\User;

use App\Traits\AutoSanitize;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Helpers\FormatResponseJson;
use App\Helpers\SanitizeHelper;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\productBrocure;
use App\Models\productPriceList;
use App\Models\LogUserDownload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Mail;
use App\Mail\CompanyMail;
use App\Models\EmailTemplate;
use App\Notifications\AdminGeneralNotification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;
class ProductController extends Controller
{
    // use AutoSanitize;

    // public function __construct()
    // {
    //     $this->sanitizeRequest();
    // }
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
            $category_id = strip_tags($request->category_id);
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

    public function storeLogUserDownload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'phone_number'  => 'required|string|max:20',
            'email'         => 'required|email|max:255',
            'id'            => 'required|integer|exists:products,id',
            'type'          => 'required|string|in:brocure,pricelist',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        LogUserDownload::create([
            'name'          => $request->name,
            'phone_number'  => $request->phone_number,
            'email'         => $request->email,
            'product_id'    => $request->id,
            'type_download' => $request->type,
        ]);

        // generate signed download url
        if ($request->type === 'brocure') {
            $file  = productBrocure::where('product_id', $request->id)
            ->where('status', 'active')
            ->firstOrFail();
            $route = 'download-catalog';
        } else {
            $file  = productPriceList::where('product_id', $request->id)
            ->where('status', 'active')
            ->firstOrFail();
            $route = 'download-pricelist';
        }

        $encrypted = Crypt::encryptString($file->file_name);

        $url = URL::temporarySignedRoute(
            $route,
            now()->addMinutes(1),
            ['file' => $encrypted]
        );

        return FormatResponseJson::success(
            ['download_url' => $url],
            'success'
        );
    }

    public function downloadCatalog($file)
    {
        try {
            $fileName = Crypt::decryptString($file);

            $brocure = productBrocure::where('file_name', $fileName)->firstOrFail();

            $filePath = public_path($brocure->brocure_file);
            if (!file_exists($filePath)) {
                throw new \Exception("File brosur tidak ada di server.");
            }

            // 🔔 NOTIFIKASI (FIX & VALID)
            $admin = User::first();

            $admin->notify(new AdminGeneralNotification([
                'title'   => 'Brochure Downloaded',
                'message' => 'Ada user download brochure',
                'url'     => '/admin/downloads',
                'popup'   => true,
                'icon'    => 'download',
            ]));
            return response()->download($filePath);

        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 404);
        }
    }


    public function downloadPriceList($file)
    {
        try {
            $fileName = Crypt::decryptString($file);

            $priceList = productPriceList::where('file_name', $fileName)->firstOrFail();

            $filePath = public_path($priceList->price_list_file);
            if (!file_exists($filePath)) {
                throw new \Exception("File pricelist tidak ada di server.");
            }

            // 🔔 NOTIFIKASI
            $admin = User::first();
            $admin->notify(new AdminGeneralNotification([
                'title'   => 'Pricelist Downloaded',
                'message' => 'Ada user download pricelist',
                'url'     => '/admin/downloads',
                'popup'   => true,
                'icon'    => 'download',
            ]));

            return response()->download($filePath);

        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 404);
        }
    }

    public function sendEmailDownloaded(Request $request)
    {
        try {
            $name = strip_tags($request->name);
            $email = strip_tags($request->email);
            $phone_number = strip_tags($request->phone_number);
            $type_service = strip_tags($request->type_service);
            $message_contact = strip_tags($request->message_contact);

            $existing_template = EmailTemplate::where('email_type', 'like', '%penjualan%')->first();

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
