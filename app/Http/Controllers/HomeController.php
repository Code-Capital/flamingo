<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function dashboard(): View
    {
        return view('dashboard');
    }
}
