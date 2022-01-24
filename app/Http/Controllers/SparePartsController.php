<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SparePart;
use App\Location;
use App\SparePartModel;

class SparePartsController extends Controller
{
    // Make this page function
    public function index(Request $request, $locale = 'hy', $id = NULL){
        // Get middleware data
        $data = $request->data;

        // Check page
        if($id == NULL){ // List
            // Get data
            $items = SparePart::with(['model','location'])->orderBy('id', 'desc')->paginate(12);

            // Get location data
            $locations = Location::orderBy('id', 'desc')->get();

            // Get spare part model data
            $models = SparePartModel::orderBy('id', 'desc')->get();
            
            // Make breadcrumbs data
            $breadcrumbs = array('home','spare-parts');

            // Push data
            $data['items'] = $items;
            $data['breadcrumbs'] = $breadcrumbs;
            $data['locations'] = $locations;
            $data['models'] = $models;

            // Check request type
            if($request->ajax()){ // Axios request
                // Send data to view
                return view('pages.spare-parts-only')->with($data);        
            }else{
                // Send data to view
                return view('pages.spare-parts')->with($data);
            }
        }else{ // Detail
            // Get data
            $item = SparePart::findOrFail($id);

            // Make breadcrumbs data
            $breadcrumbs = array('home','spare-parts',$item->first_name.' '.$item->last_name);

            // Push data
            $data['item'] = $item;
            $data['breadcrumbs'] = $breadcrumbs;

            // Send data to view
            return view('pages.spare-parts-detail')->with($data);
        }
        
    }
}
