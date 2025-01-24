<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use JsonSerializable;
use App\Helpers\FormatResponseJson;
use App\Models\HistoryAboutUs;
use App\Models\WhyPralonAboutUs;
use App\Models\Vision;
use App\Models\ValuePralonAboutUs;
use App\Models\Certificate;
class AboutUsController extends Controller
{
    public function index(): View
    {
        return view('users.about_us.index');
    }
    public function fetchContentAboutUs()
    {
        try {
            $history = HistoryAboutUs::first();
            $why = WhyPralonAboutUs::with(['detail'])->first();
            $visi_misi = Vision::with(['mision'])->first();
            $value = ValuePralonAboutUs::all();
            $certificates = Certificate::all();

            $content = [
                'history'=> $history,
                'why'=> $why,
                'visi_misi'=> $visi_misi,
                'value'=> $value,
                'certificates'=> $certificates,
            ];
            return FormatResponseJson::success($content, 'content about us fetch successfully');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null,$th->getMessage(),500);
        }
    }
}
