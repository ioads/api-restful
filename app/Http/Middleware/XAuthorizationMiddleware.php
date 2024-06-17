<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class XAuthorizationMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->header('X-Authorization')) {
            return response()->json(['error' => 'Unauthorized.'], 401);
        }

        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized.'], 401);
        }

        return $next($request);
    }
}
