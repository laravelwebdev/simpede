<?php

namespace App\Http\Middleware;

use App\Models\ShareLink;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateAccessToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->query('token');

        if (!$token || !ShareLink::where('token', $token)->exists()) {
            return abort(401);
        }

        return $next($request);

    }
}
