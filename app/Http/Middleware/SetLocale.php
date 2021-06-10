<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
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
        if($request->has('set_locale_to') && in_array($request->set_locale_to, ['en', 'hu']))
        {
            App::setLocale($request->set_locale_to);
            session(['locale' => $request->set_locale_to]);
//            dd('asdf');
        }
        elseif(session()->has('locale'))
        {
            App::setLocale(session('locale'));
//            dd('bbb');
        }

        return $next($request);
    }
}
