<?php

namespace App\Http\Middleware;
//namespace App\Http\Controllers\Auth;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Cache;

class CheckUserOnline
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            $expiresAt = Carbon::now()->addMinutes(1);
            Cache::put('user-is-online-' . $user->id, true, $expiresAt);

        }

        return $next($request);
    }
}
