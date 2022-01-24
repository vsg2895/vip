<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Message;
use App\UserMessage;
use App\ChatMessage;
use App\ChatUserMessage;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    // Admin Validation
    public function __construct() 
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
    //     // Get fata from middleware
    //     $data = $request->data;

    //     // Get page name
    //     $page_name = 'Messages';

    //     // Get items
    //     $items = Message::orderBy('id','desc')->get();

    //     // Push data
    //     $data['page_name'] = $page_name;
    //     $data['items'] = $items;
    //     $data['route'] = $request->segment(3);

    //     // Send data to blade
    //     return view('admin.'.$data['route'].'.index')->with($data);
    // }
    public function index(Request $request)
    {
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Messages';

        // Get items
        $items = ChatUserMessage::with(
            'sender',
            'receiver',
            'message'
        )->orderBy('id','desc')->get();


        // Push data
        $data['page_name'] = $page_name;
        $data['items'] = $items;
        $data['route'] = $request->segment(3);

        // Send data to blade
        return view('admin.'.$data['route'].'.index')->with($data);
    }

    public function index2(Request $request)
    {
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'User Messages';

        // Get items
        $items = UserMessage::with(
            'sender',
            'geter'
        )->orderBy('id','desc')->get();


        // Push data
        $data['page_name'] = $page_name;
        $data['items'] = $items;
        $data['route'] = $request->segment(3);

        // Send data to blade
        return view('admin.'.$data['route'].'.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function show(Messages $messages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function edit(Messages $messages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $locale = 'hy', $id)
    // {
    //     // Get value
    //     $value = Messages::where('id',$id)->get('readed')->toArray();

    //    // Get new value
    //     if(isset($value[0]) && $value[0] != null){
    //         if($value[0]['readed'] == 0){
    //             $new_value = 1;
    //         }else{
    //             $new_value = 0;
    //         }
    //     }else{
    //         // Error Redirect
    //         return redirect()->back()->with('error','error');
    //     }
    
    //     // Make data
    //     $data = array(
    //         'readed' => intval($new_value),
    //     );
    
    //     // Update
    //     Messages::findOrFail($id)->update($data);

    //     // Success Redirect
    //     return redirect()->back()->with('updated','updated');
    // }
    public function update(Request $request, $locale = 'hy', $id)
    {
        // Get value
        $value = ChatUserMessage::where('id',$id)->get('seen_status')->toArray();

       // Get new value
        if(isset($value[0]) && $value[0] != null){
            if($value[0]['seen_status'] == 0){
                $new_value = 1;
            }else{
                $new_value = 0;
            }
        }else{
            // Error Redirect
            return redirect()->back()->with('error','error');
        }
    
        // Make data
        $data = array(
            'seen_status' => intval($new_value),
        );
    
        // Update
        ChatUserMessage::findOrFail($id)->update($data);

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function destroy(Messages $messages)
    {
        //
    }
}
