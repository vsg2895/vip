<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserRating;
use App\User;

class UsersController extends Controller
{
    // Send message from contacts page function
    public function send_review(Request $request, $locale = 'hy', $user_id){
        // Get data
        $user = User::where('id', $user_id)->first();
        
        // Validation
        if(!Auth::check() || $user == NULL){
            // Error response
            echo 0; exit;
        }
        
        // Validation
        $request->validate([
            'rate' => 'required|numeric',
            'description' => 'required|max:99999',
        ]);

        // Get data
        $user_rate = UserRating::where(['rater_user_id' => Auth::user()->id, 'user_id' => $user_id])->first();

        // Check data
        if($user_rate == NULL){ // Datas not exists
            // Make data
            $item = new UserRating;
        }else{ // Data already exists
            // Get data
            $item = $user_rate;
        }

        // Make data
        $item->user_id = $user_id;
        $item->rater_user_id = Auth::user()->id;
        $item->rate = $request->rate;
        $item->description = $request->description;

        // Save data
        $item->save();

        // Success response
        echo 1; exit;
    }
}
