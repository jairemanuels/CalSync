<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;

class PlatformController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('platform::index', ['user' => $user]);
    }

    public function customers()
    {
        $user = auth()->user();
        return view('platform::customers.index', ['user' => $user]);
    }

    public function events()
    {
        $user = auth()->user();
        return view('platform::events.index', ['user' => $user]);
    }
}
