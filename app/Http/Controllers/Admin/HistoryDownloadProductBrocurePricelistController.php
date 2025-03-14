<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogUserDownload;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Cache;
class HistoryDownloadProductBrocurePricelistController extends Controller
{
    public function index()
    {
        return view('admin.history_download.index');
    }
    public function fetchHistoryDownloadBrocure(Request $request)
    {
        try {
            $product_id = $request->product_id;

            $history_download_brocure = LogUserDownload::where('type_download', 'brocure')->get();

            return FormatResponseJson::success($history_download_brocure, 'Data berhasil diambil');
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 404);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
    public function fetchHistoryDownloadPricelist(Request $request)
    {
        try {
            $product_id = $request->product_id;

            $history_download_pricelist = LogUserDownload::where('type_download', 'pricelist')->get();
            return FormatResponseJson::success($history_download_pricelist, 'Data berhasil diambil');
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 404);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
}
