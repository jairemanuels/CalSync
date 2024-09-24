<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;

class PlatformController extends Controller
{
    public function index()
    {
        return view('platform::index');
    }

    public function customers()
    {
        return view('platform::customers.index');
    }
}
