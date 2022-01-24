<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Make this page function
    public function index(Request $request){
        // Get middleware data
        $data = $request->data;

        // Make breadcrumbs data
        $breadcrumbs = array('home','reference','contacts');

        // Push data
        $data['breadcrumbs'] = $breadcrumbs;

        // Send data to view
        return view('pages.contacts')->with($data);
    }
}
