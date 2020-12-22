<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\User;
use Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::where('email', Auth::user()->email)->first();
        if ($user->role == $roles) {
            return $next($request);
        }

    }
}
