<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Cache;
use App\Models\ContactUs;
class EmailMessageController extends Controller
{
    public function index()
    {
        return view("admin.email_message.index");
    }
    public function fetchEmailMessages()
    {
        try {
            //code...
            $emailMessages = ContactUs::all();
            return FormatResponseJson::success($emailMessages,'email contact us berhasil diambil');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 404);
        }
        
    }
}
