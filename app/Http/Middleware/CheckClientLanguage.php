<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\App;
class CheckClientLanguage
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
        // first check if language is set in session (in case if user set preferable language manually)
        $lang = session()->get('language');
        // if user didnt set language manually use his default browser language
        if (!isset($lang)) {
            $lang = isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]) ? substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2) : '';
            // check language
            if ($lang == 'bs' || $lang == 'hr' || $lang == 'sr') {
                $lang = 'bs';
            } else if ($lang == 'de') {
                $lang = 'de';
            } else {
                $lang = 'en';
            }
        }
        // set language to the App object
        App::setlocale($lang);
        return $next($request);
        // see: https://stackoverflow.com/questions/3650006/get-country-of-ip-address-with-php
    }
}