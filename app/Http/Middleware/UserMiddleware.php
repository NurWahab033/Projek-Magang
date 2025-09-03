<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && in_array($request->user()->role, [
            User::ROLE_PENDAFTAR
        ])) {
            return $next($request);
        }

        return response()->json([
            'message' => 'Unauthorized. Hanya Pendaftar atau Peserta yang boleh mengakses'
        ], 403);
    }
}
