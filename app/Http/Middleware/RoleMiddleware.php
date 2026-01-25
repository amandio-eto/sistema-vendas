<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,...$roles)
    {
         $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        // Cek apakah role user ada di list role yang diijinkan
        if (!in_array($user->roles, $roles)) {
            return redirect()->back()->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
        return $next($request);
    }
}
