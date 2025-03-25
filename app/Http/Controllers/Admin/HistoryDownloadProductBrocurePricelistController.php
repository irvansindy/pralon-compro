<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogUserDownload;
use App\Helpers\FormatResponseJson;
use App\Exports\BrocureExport;
use App\Exports\PricelistExport;
use Maatwebsite\Excel\Facades\Excel;

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
            $start_date = $request->start_date_brocure;
            $end_date = $request->end_date_brocure;

            $query = LogUserDownload::where('type_download', 'brocure');

            // Filter berdasarkan product_id jika bukan "all"
            if ($product_id !== 'all') {
                $query->where('product_id', $product_id);
            }

            // Filter berdasarkan range tanggal jika tidak kosong
            if (!is_null($start_date) && !is_null($end_date)) {
                $query->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59']);
            }

            $history_download_brocure = $query->get();

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
            $start_date = $request->start_date_pricelist;
            $end_date = $request->end_date_pricelist;

            $query = LogUserDownload::where('type_download', 'pricelist');

            // Filter berdasarkan product_id jika bukan "all"
            if ($product_id !== 'all') {
                $query->where('product_id', $product_id);
            }

            // Filter berdasarkan range tanggal jika tidak kosong
            if (!is_null($start_date) && !is_null($end_date)) {
                $query->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59']);
            }

            $history_download_pricelist = $query->get();

            return FormatResponseJson::success($history_download_pricelist, 'Data berhasil diambil');
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 404);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
    public function exportBrocure(Request $request)
    {
        return Excel::download(new BrocureExport($request->product_id, $request->start_date_brocure, $request->end_date_brocure), 'history_download_brocure.xlsx');
    }
    public function exportPricelist(Request $request)
    {
        return Excel::download(new PricelistExport($request->product_id, $request->start_date_pricelist, $request->end_date_pricelist), 'history_download_pricelist.xlsx');
    }
}
