<?php

namespace App\Http\Middleware;

use App\Model\Address as ModelAddress;
use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

class Address
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
        if(Auth::check() && !$request->session()->has('address')){
            $uid=Auth::user()->id;
            $xdata=ModelAddress::where('uid',$uid)->where('default',1)->first();
            if(!$xdata || ModelAddress::where('uid',$uid)->count()>0){
                $xdata=ModelAddress::where('uid',$uid)->first();
            }
            $request->session()->put('address',$xdata->id??null);
        }
        return $next($request);
    }
}
