<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class AdminMiddleware
{
        public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->role == User::ROLE_ADMIN) {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized. Hanya Admin yang boleh mengakses'], 403);
    }
}
