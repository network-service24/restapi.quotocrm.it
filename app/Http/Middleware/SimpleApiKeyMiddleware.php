<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SimpleApiKeyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-KEY');

        if ($apiKey !== config('app.api_key')) {
            return response()->json(['message' => 'Accesso negato'], 401);
        }

        return $next($request);
    }
}
