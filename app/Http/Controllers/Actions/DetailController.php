<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PostReport;
use App\UserMessage;
use App\Post;

class DetailController extends Controller
{
    // Make this page function
    public function message(Request $request, $locale = 'hy', $geter_id){
        // Chack auth
        if(!Auth::check() || $geter_id == NULL){
            // Error response
            echo 0; exit;
        }
        
        // Validation
        $request->validate([
            'description' => 'required|max:99999',
        ]);

        // Make data
        $message = new UserMessage;
        $message->name = Auth::user()->first_name.' '.Auth::user()->last_name;
        $message->email = Auth::user()->email;
        $message->description = $request->description;
        $message->sender_id = Auth::user()->id;
        $message->geter_id = $geter_id;

        // Save data
        $message->save();

        // Success response
        echo 1; exit;
    }

    // Make this page function
    public function report(Request $request, $locale = 'hy', $post_id){
        // Validation
        Post::findOrFail($post_id);
        
        // Check auth
        if(Auth::check()){ // Auth
            // Validation
            $request->validate([
                'description' => 'required|max:99999',
            ]);

            // Make data
            $report = new PostReport;
            $report->name = Auth::user()->first_name.' '.Auth::user()->last_name;
            $report->email = Auth::user()->email;
            $report->description = $request->description;
            $report->post_id = $post_id;
            $report->user_id = Auth::user()->id;
        }else{ // Guest
            // Validation
            $request->validate([
                'name' => 'required|max:255',
                'email' => 'email:rfc,dns',
                'description' => 'required|max:99999',
            ]);

            // Make data
            $report = new PostReport;
            $report->name = $request->name;
            $report->email = $request->email;
            $report->description = $request->description;
            $report->post_id = $post_id;
        }

        // Save data
        $report->save();

        // Success response
        echo 1; exit;
    }
}
