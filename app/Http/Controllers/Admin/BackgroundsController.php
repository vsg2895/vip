<?php

namespace App\Http\Controllers\Admin;

use App\Backgrounds;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackgroundsController extends Controller
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
        $page_name = 'Backgrounds';

        // Get items
        $items = Backgrounds::orderBy('id','desc')->get();

        // Push data
        $data['page_name'] = $page_name;
        $data['add'] = false;
        $data['items'] = $items;
        $data['route'] = $request->segment(4);

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
     * @param  \App\Backgrounds  $backgrounds
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $locale = 'hy', $currency = 'amd', $id)
    {
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Backgrounds / Update';

        // Get item
        $item = Backgrounds::findOrFail($id);
        
        // Push data
        $data['item'] = $item;
        $data['page_name'] = $page_name;
        $data['route'] = $request->segment(4);

        // Send data to blade
        return view('admin.'.$data['route'].'.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Backgrounds  $backgrounds
     * @return \Illuminate\Http\Response
     */
    public function edit(Backgrounds $backgrounds)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Backgrounds  $backgrounds
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale = 'hy', $currency = 'amd', $id)
    {
        // Validation
        $request->validate([
            'img' => 'required',
        ]);

       // Get image data
       if($request->has('img')){
            // Get filename with extenstion
            $filenameWithExt = $request -> file('img')->getClientOriginalName();
            
            // Get just fileNameToStore
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            // Get just ext
            $extenstion = $request->file('img')->getClientOriginalExtension();
            
            // Filename to store
            $fileNameToStore = 'SolarShop_'.time().'.'.$extenstion;
            
            // Upload image
            $request->img->move(public_path('assets/images/backgrounds'), $fileNameToStore);
            
            // Get current category row
            $current_item = Backgrounds::findOrFail($id);

            // Check image directory
            if(isset($current_item->img) && $current_item->img != null && file_exists(public_path('assets/images/backgrounds/'.$current_item->img))){
                // Unlink old image
                unlink(public_path('assets\images\backgrounds\\'.$current_item->img));
            }

            // Push data
            $item['img'] = $fileNameToStore;

            // Save data
            Backgrounds::findOrFail($id)->update($item);
        }else{
            // Error Redirect
            return redirect()->back()->with('error');
        }

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Backgrounds  $backgrounds
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $locale = 'hy', $currency = 'amd', $id)
    {
        //
    }
}
