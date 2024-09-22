<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Tenant;

class IdentifyTenantMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!Tenant::where('user_id', $user->id)->exists()) {
            return redirect()->route('setup.create');
        }

        return $next($request);
    }
}
