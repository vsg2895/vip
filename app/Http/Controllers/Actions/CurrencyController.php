<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    // Set Currency function
    public function index(Request $request){
        // Check currency reuqest
        if($request->segment(3) != null && $request->segment(2) != null){
            // Set currency
            $request->session()->put('currency', $request->set_currency);
        }

        // Redsirect to back route 
        return redirect()->back();
    }
}
