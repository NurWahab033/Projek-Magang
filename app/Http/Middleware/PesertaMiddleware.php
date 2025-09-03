<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class PesertaMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->role == User::ROLE_PESERTA) {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized. Hanya Peserta yang boleh mengakses'], 403);
    }
}
