<?php

namespace App\Http\Controllers\User;

use App\Traits\AutoSanitize;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Helpers\FormatResponseJson;
use App\Helpers\SanitizeHelper;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\productBrocure;
use App\Models\productPriceList;
use App\Models\LogUserDownload;
use App\Models\Notifications;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Mail;
use App\Mail\CompanyMail;
use App\Models\EmailTemplate;
use App\Events\DownloadNotification;
use App\Events\GeneralNotificationEvent;
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
        try {
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

            // 📝 Log download
            $log = LogUserDownload::create([
                'name'          => $request->name,
                'phone_number'  => $request->phone_number,
                'email'         => $request->email,
                'product_id'    => $request->id,
                'type_download' => $request->type,
            ]);

            // 🔔 Notifikasi real-time
            $message = $request->type === 'brocure' ? 'New Brochure Download!' : 'New Pricelist Download!';
            Notifications::create([
                'type'    => $request->type,
                'message' => $message,
            ]);

            broadcast(new GeneralNotificationEvent([
                'type'    => $request->type,
                'message' => $message,
                'time'    => now()->toDateTimeString()
            ]));

            // 📦 Ambil file_name & buat signed URL
            if ($request->type === 'brocure') {
                $fileRecord = productBrocure::where('product_id', $request->id)->first();
                $routeName = 'download-catalog';
            } else {
                $fileRecord = productPriceList::where('product_id', $request->id)->first();
                $routeName = 'download-pricelist';
            }

            if (!$fileRecord) {
                throw new \Exception("File tidak ditemukan untuk product ID {$request->id}");
            }
            // dd($fileRecord->file_name);
            $encryptedFileName = Crypt::encryptString($fileRecord->file_name);
            $downloadUrl = URL::temporarySignedRoute(
                $routeName,
                now()->addMinutes(1),
                ['file' => $encryptedFileName]
            );
            // dd($downloadUrl);

            return FormatResponseJson::success(['download_url' => $downloadUrl], 'success');
        } 
        catch (ValidationException $e) {
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } 
        catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }

    public function downloadCatalog($file)
    {
        try {
            $fileName = Crypt::decryptString($file);

            $existing_brocure = productBrocure::where('file_name', $fileName)->first();
            if (!$existing_brocure) {
                throw new \Exception("Brosur tidak ditemukan.");
            }

            $file_path = public_path($existing_brocure->brocure_file);
            if (!file_exists($file_path)) {
                throw new \Exception("File brosur tidak ada di server.");
            }

            $countBrocure = LogUserDownload::where('type_download', 'brocure')->count();
            $countPricelist = LogUserDownload::where('type_download', 'pricelist')->count();
            event(new DownloadNotification("Brosur baru diunduh!", $countBrocure, $countPricelist));

            return response()->download($file_path);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 404);
        }
    }

    public function downloadPriceList($file)
    {
        try {
            $fileName = Crypt::decryptString($file);

            $existing_price_list = productPriceList::where('file_name', $fileName)->first();
            if (!$existing_price_list) {
                throw new \Exception("Pricelist tidak ditemukan.");
            }

            $file_path = public_path($existing_price_list->price_list_file);
            if (!file_exists($file_path)) {
                throw new \Exception("File pricelist tidak ada di server.");
            }

            $countBrocure = LogUserDownload::where('type_download', 'brocure')->count();
            $countPricelist = LogUserDownload::where('type_download', 'pricelist')->count();
            event(new DownloadNotification("Pricelist baru diunduh!", $countBrocure, $countPricelist));

            return response()->download($file_path);
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
