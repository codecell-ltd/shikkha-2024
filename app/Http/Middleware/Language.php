<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if(session()->has('locale'))
        {
            App::setLocale(session('locale'));
        }
        else
        {
            // App::setLocale('bn');
            if(Auth::check())
            {
                App::setLocale(authUser()->language);
            }
            // else
            // {
            //     // App::setLocale('bn');
            // }
        }
        
        return $next($request);
    }
}
