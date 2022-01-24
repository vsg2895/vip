<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    // Allowed localizations
    public static $localizations = [ 'hy', 'en', 'ru' ];

    // Set language function
    public function index(Request $request, $locale = 'hy', $new_locale){
        // Check localization
        if(!in_array($new_locale, self::$localizations)){ // Wrong localization
            // Redirect home with current localization
            return redirect()->route('home', ['locale' => app()->getLocale()]);
        }else{
            // Redirect to back route 
            return redirect(str_replace('/'.app()->getLocale(), '/'.$new_locale, url()->previous()));            
        }
    }
}
