<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;

class ProjectsController extends Controller
{

    public function create()
    {
        return view('platform::projects.create');
    }
}
