<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {

        if(Session::has('lang')){
            App::setLocale(Session::get('lang'));
        }else{
            session()->put('lang', config('app.locale')); 
            session()->put('lang_dir', 'ltr');
        }
        return $next($request);
    }
}
