<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->status === 'Banned') {
            if (!$request->is('banned')) {
                return redirect()->route('banned');
            }
        } elseif ($request->is('banned')) {
            return redirect()->route('colocation.index');
        }

        return $next($request);
    }
}
