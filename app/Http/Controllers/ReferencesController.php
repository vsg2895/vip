<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reference;

class ReferencesController extends Controller
{
    // Make this page function
    public function index(Request $request){
        // Get middleware data
        $data = $request->data;

        // Get data
        $item = Reference::first();

        // Make breadcrumbs data
        $breadcrumbs = array('home','reference');

        // Push data
        $data['item'] = $item;
        $data['breadcrumbs'] = $breadcrumbs;

        // Send data to view
        return view('pages.references')->with($data);
    }
}
