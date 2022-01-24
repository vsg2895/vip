<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    // Send message from contacts page function
    public function index(Request $request){
        // Validation
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'email:rfc,dns',
            'phone' => 'required|numeric',
            'message' => 'required|max:99999',
        ]);

        // Make data
        $item = new Message;
        $item->name = $request->name;
        $item->email = $request->email;
        $item->phone = $request->phone;
        $item->message = $request->message;

        // Save data
        $item->save();

        // Success response
        echo 1;
    }
}
