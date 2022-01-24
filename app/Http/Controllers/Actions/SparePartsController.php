<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SparePart;

class SparePartsController extends Controller
{
    // Send filter from spare parts page function
    public function index(Request $request){
        // Get data from middleawre
        $data = $request->data;
        
        // Validation
        $request->validate([
            'spare_location' => 'required',
            'spare_model' => 'required',
        ]);

        // Check data
        if($request->spare_location == NULL || $request->spare_location == '' || $request->spare_location == '#'){ // Default value
            // Make data parameters
            $location_symbol = '!=';
            $location_value = 'DEFAULTVALUE';
        }else{
            // Make data parameters
            $location_symbol = '=';
            $location_value = $request->spare_location;
        }

        // Check data
        if($request->spare_model == NULL || $request->spare_model == '' || $request->spare_model == '#'){ // Default value
            // Make data parameters
            $model_symbol = '!=';
            $model_value = 'DEFAULTVALUE';
        }else{
            // Make data parameters
            $model_symbol = '=';
            $model_value = $request->spare_model;
        }

        // Get data
        $items = SparePart::where('location_id', $location_symbol, $location_value)->where('model_id', $model_symbol, $model_value)->paginate(12);

        // Push data
        $data['items'] = $items;

        // Success response
        return view('pages.spare-parts-only')->with($data);
    }
}
