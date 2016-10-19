<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Config;
use App;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;

class Language
{
    public function __construct(Application $app, Redirector $redirector, Request $request)
    {
        $this->app = $app;
        $this->redirector = $redirector;
        $this->request = $request;
    }

    /**
     *  We handle the web request and setup language.
     *  We go from default setting, and see if we can update it with browser lang,
     *  cookie lang and finally url lang. Note: Default and browser lang are the ones
     *  with less precedence, and url on top.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $urlLang = $request->input('lang');
        $cookieLang = $request->cookie('locale');
        $browserLang = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
        $locale = Config::get('app.locale');

        if (!empty($browserLang) and in_array($browserLang, Config::get('app.languages'))) {
            $locale = $browserLang;
        }

        if (!empty($cookieLang) and in_array($cookieLang, Config::get('app.languages'))) {
            $locale = $cookieLang;
        }

        if (!empty($urlLang) and in_array($urlLang, Config::get('app.languages'))) {
            $locale = $urlLang;
        }

        // This is just for the beta
        if ($request->url() != url()->to('/')) {
            App::setLocale('en');
        } else {
            App::setLocale($locale);
        }

        if ($request->hasCookie('locale') && $cookieLang == $locale) {
            return $next($request);
        } else {
            $response = $next($request);

            return $response->withCookie(cookie()->forever('locale', $locale));
        }
    }
}
