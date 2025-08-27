<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Update the application language
     */
    public function update(Request $request, $locale)
    {
        // Validate the locale
        if (!in_array($locale, ['en', 'id'])) {
            $locale = 'id'; // Default to Indonesian
        }
        
        // Set the application locale
        App::setLocale($locale);
        
        // Store the locale in session
        Session::put('locale', $locale);
        
        return redirect()->back();
    }
}