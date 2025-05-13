<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Spatie\Analytics\Analytics;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use App\Helpers\FormatResponseJson;
class AnalyticsController extends Controller
{
    public function index()
{
    try {
        // Tidak perlu lagi putenv jika sudah atur .env dan file di path yang benar

        $mostVisited = Analytics::fetchMostVisitedPages(Period::days(7));
        $visitors = Analytics::fetchVisitorsAndPageViews(Period::days(7));

        return FormatResponseJson::success([
            'most_visited' => $mostVisited,
            'visitors' => $visitors,
        ], 'Analytics data fetched successfully');
    } catch (\Exception $e) {
        return FormatResponseJson::error(null, 'Failed to fetch Analytics data: ' . $e->getMessage(), 500);
    }
}

}
