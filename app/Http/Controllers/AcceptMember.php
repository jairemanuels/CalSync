<?php

namespace App\Http\Controllers;

use App\Models\TeamRequest;
use App\Models\User;

class AcceptMember extends Controller
{
    public function accept($requestId)
    {
        $request = TeamRequest::findOrFail($requestId);
        $request->accept();

        return redirect()->back()->with('success', 'User has been accepted');
    }
}
