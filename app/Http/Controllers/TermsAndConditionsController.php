<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TermsAndConditions;

class TermsAndConditionsController extends Controller
{
    // Make this page function
    public function index(Request $request){
        // Get middleware data
        $data = $request->data;

        // Get data
        $item = TermsAndConditions::first();

        // Make breadcrumbs data
        $breadcrumbs = array('home','terms-and-conditions');

        // Push data
        $data['item'] = $item;
        $data['breadcrumbs'] = $breadcrumbs;

        // Send data to view
        return view('pages.terms-and-conditions')->with($data);
    }
}
