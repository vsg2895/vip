<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
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
        $page_name = 'Gallery';

        // Get items
        $items = Gallery::orderBy('id','desc')->get();

        // Push data
        $data['page_name'] = $page_name;
        $data['add'] = true;
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
        // Validation
        $request->validate([
            'img' => 'required',
        ]);

        // Make data
        $item = new Gallery;

        // Get image data
        if($request->has('img')){
            // Get filename with extenstion
            $filenameWithExt = $request -> file('img')->getClientOriginalName();
            
            // Get just fileNameToStore
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            // Get just ext
            $extenstion = $request->file('img')->getClientOriginalExtension();
            
            // Filename to store
            $fileNameToStore = 'Logistic_'.time().'.'.$extenstion;
            
            // Upload image
            $request->img->move(public_path('assets/images/gallery'), $fileNameToStore);
            
            // Push data
            $item->img = $fileNameToStore;
        }else{
            return redirect()->back()->with('error','error');
        }

        // Save data
        $item->save();

        // Success Redirect
        return redirect()->back()->with('added','added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $locale = 'hy', $id)
    {
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Gallery / Update';

        // Get item
        $item = Gallery::findOrFail($id);
        
        // Push data
        $data['item'] = $item;
        $data['page_name'] = $page_name;
        $data['route'] = $request->segment(3);

        // Send data to blade
        return view('admin.'.$data['route'].'.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale = 'hy', $id)
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
            $fileNameToStore = 'Logistic_'.time().'.'.$extenstion;
            
            // Upload image
            $request->img->move(public_path('assets/images/gallery'), $fileNameToStore);
            
            // Get current category row
            $current_item = Gallery::findOrFail($id);

            // Check image directory
            if(isset($current_item->img) && $current_item->img != null && file_exists(public_path('assets/images/gallery/'.$current_item->img))){
                // Unlink old image
                unlink(public_path('assets\images\gallery\\'.$current_item->img));
            }

            // Push data
            $item['img'] = $fileNameToStore;
        }

        // Save data
        Gallery::findOrFail($id)->update($item);

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $locale = 'hy', $id)
    {
        // Get item
        $gallery = Gallery::findOrFail($id);

        // Check image directory
        if(isset($gallery->img) && $gallery->img != null && file_exists(public_path('img/slider/'.$gallery->img))){
            // Unlink old image
            unlink(public_path('img\slider\\'.$gallery->img));
        }
        
        // Delete from itmes
        Gallery::findOrFail($id)->delete();

        // Success Redirect
        return redirect()->back()->with('deleted','deleted');
    }
}
