<?php

namespace App\Http\Middleware;

use App\Models\PulsaKegiatan;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidatePulsaToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->route('token');

        if (! $token || ! PulsaKegiatan::where('token', $token)->where('status', 'open')->exists()) {
            return abort(404);
        }

        return $next($request);
    }
}
