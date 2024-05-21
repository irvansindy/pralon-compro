<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Helpers\FormatResponseJson;
class ContactUsController extends Controller
{
    public function index()
    {
        return view('users.contact_us.index');
    }
    public function fetch(Request $request)
    {
        try {
            $contact_us = ContactUs::all();
            return FormatResponseJson::success($contact_us, 'success');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null,$th->getMessage(), 500);
        }
    }
}
