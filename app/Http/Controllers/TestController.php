<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\SecurityLogHelper;
use App\Models\RequestLog;
use Illuminate\Support\Facades\Log;
use App\Events\SecurityAlertEvent;
use App\Helpers\FormatResponseJson;

class TestController extends Controller
{
    /**
     * GET & POST endpoint untuk testing middleware.
     */
    public function index(Request $request)
    {
        // Ambil semua input ter-sanitize
        $data = $request->all();

        // Simpan log
        $logData = SecurityLogHelper::createLogData('TEST_GET', [
            'query' => $request->query(),
            'body'  => $data
        ]);
        RequestLog::create($logData);
        Log::channel('security')->info('Test GET Request', $logData);
        broadcast(new SecurityAlertEvent($logData))->toOthers();

        return FormatResponseJson::success($data, '✅ GET request berhasil!');
    }
    /**
     * Handle POST request untuk testing middleware.
     */
    public function post(Request $request)
    {
        // Ambil semua input ter-sanitize
        $data = $request->all();

        // Simpan log
        $logData = SecurityLogHelper::createLogData('TEST_POST', [
            'query' => $request->query(),
            'body'  => $data
        ]);
        RequestLog::create($logData);
        Log::channel('security')->info('Test POST Request', $logData);
        broadcast(new SecurityAlertEvent($logData))->toOthers();

        return FormatResponseJson::success($data, '✅ POST request berhasil!');
    }
}
