<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcriptions;
use App\Helpers\FormatResponseJson;
class SubcriptionController extends Controller
{
    public function index()
    {
        return view("admin.subcription.index");
    }
    public function fetchSubcriptions()
    {
        try {
            $subcriptions = Subcriptions::orderBy('id','desc')->get();
            return FormatResponseJson::success($subcriptions, 'subcriptions fetched successfully');
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
}
