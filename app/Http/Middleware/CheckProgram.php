<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckProgram {
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (auth()->user()->program_verified)
            return $next($request);
        return response()->redirectToRoute('home')->with('error', 'Your application has not been verified yet. Please be patient.');
    }
}
