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

        if(!$user) {
            return redirect()->route('login');
        }

        $tenant = Tenant::where('user_id', $user->id)->first();

        if (!$tenant) {
            return redirect()->route('projects.create');
        }

        $request->merge(['tenant' => $tenant]);

        return $next($request);
    }
}
