<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if (auth()->user()->role == $role) {
                    return $next($request);
                }
            }
            return abort(401, 'Unauthorized');
        }
    }
}
