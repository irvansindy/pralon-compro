<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
class HomeController extends Controller
{
    public function index(): View
    {
        return view('users.home.index');
    }
}
