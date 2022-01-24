<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
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
    public function index(Request $request)
    {
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Booking';

        // Get items
        $items = Booking::orderBy('id','desc')->get();

        // Push data
        $data['page_name'] = $page_name;
        $data['items'] = $items;
        $data['route'] = $request->segment(4);

        // Send data to blade
        return view('admin.'.$data['route'].'.index')->with($data);
    }

    public function download(Request $request, $locale = 'en', $id){
        // Get data
        $works = Booking::findOrFail($id);
        
        // Download
        return response()->download(public_path()."/img//files/".$works->file);
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
     * @param  \App\Works  $Works
     * @return \Illuminate\Http\Response
     */
    public function show(Works $Works)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Works  $Works
     * @return \Illuminate\Http\Response
     */
    public function edit(Works $Works)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Works  $Works
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale = 'hy', $currency = 'amd', $id)
    {
        // Get value
        $value = Booking::where('id',$id)->get('readed')->toArray();

        // Get new value
        if(isset($value[0]) && $value[0] != null){
            if($value[0]['readed'] == 0){
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
            'readed' => intval($new_value),
        );
    
        // Update
        Booking::findOrFail($id)->update($data);

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $Works
     * @return \Illuminate\Http\Response
     */
    public function destroy(Works $Works)
    {
        //
    }
}
