<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HandleLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Get locale from session, default to 'id' (Indonesian)
        $locale = Session::get('locale', 'id');
        
        // Validate the locale
        if (!in_array($locale, ['en', 'id'])) {
            $locale = 'id';
        }
        
        // Set the application locale
        App::setLocale($locale);
        
        return $next($request);
    }
}