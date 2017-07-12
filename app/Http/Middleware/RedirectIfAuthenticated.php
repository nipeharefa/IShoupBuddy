<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $auth = Auth::guard($guard);

        if ($auth->check()) {
            $links = '/';
            switch (request()->user()->role) {
                case 0:
                    $links = '/admin/product';
                    break;
                case 1:
                    $links = '/';
                    break;
                default:
                    $links = '/vendor/product';
                    break;
            }

            return redirect($links);
        }

        return $next($request);
    }
}
