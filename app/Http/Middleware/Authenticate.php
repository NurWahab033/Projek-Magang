<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
        // Untuk API/Sanctum biasanya return null agar menghasilkan 401 JSON
        if ($request->expectsJson()) {
            return null;
        }

        // Atau arahkan ke route login bila web:
        return route('login');
    }
}
