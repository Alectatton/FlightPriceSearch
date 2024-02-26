<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomCors
{
    public function handle(Request $request, Closure $next)
    {
        $origin = $request->headers->get('Origin');
        $allowedOrigins = ['http://localhost:5173', 'http://127.0.0.1:5173', 'localhost:5173'];

        $response = $next($request);

        if (in_array($origin, $allowedOrigins)) {
            \Log::info('Origin: ' . $origin . ' is allowed');

            $response->headers->set('Access-Control-Allow-Origin', $origin);
        }

        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*')
            ->header('Access-Control-Allow-Credentials', true)
            ->header('Access-Control-Allow-Headers', 'X-Requested-With,Content-Type,X-Token-Auth,Authorization')
            ->header('Accept', 'application/json');
    }
}
