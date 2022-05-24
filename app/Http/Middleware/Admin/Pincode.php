<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Auth;

class Pincode
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
        if(Auth::user()->permission->general->pincode){
            return $next($request);
        }
        else{
            $request->session()->flash('error', 'Sorry you dont have permission');
            return redirect('/admin');
        }
    }
}
