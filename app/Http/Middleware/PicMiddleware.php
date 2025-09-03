<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class PicMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->role == User::ROLE_PIC) {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized. Hanya PIC yang boleh mengakses'], 403);
    }
}
