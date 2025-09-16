<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetLanguage
{
    /**
     * use Illuminate\Support\Facades\Session;
     *
     * @param  \Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $language = \Session::get('languageName');

        if (empty($language)) {
            $language = Auth::user() ? (Auth::user()->language ? Auth::user()->language : 'en') : 'en';
        }

        \App::setLocale($language);

        return $next($request);
    }
}
