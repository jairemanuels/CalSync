<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;

class SetupController extends Controller
{
    public function create()
    {
        return view('platform::setup.create');
    }
}
