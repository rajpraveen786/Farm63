<?php

namespace App\Http\Middleware;

use Closure;

class EmptyCart
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
        $session=[];
        if (!$request->session()->has('cart')) {
            $request->session()->put('cart', []);
        }


        if (!$request->session()->has('wishlist')) {
            $request->session()->put('wishlist', []);
        }
        return $next($request);
    }
}
