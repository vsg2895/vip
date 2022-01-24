<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlbumsController extends Controller
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
        $page_name = 'Albums';

        // Get items
        $items = Album::orderBy('id','desc')->get();

        // Push data
        $data['page_name'] = $page_name;
        $data['add'] = true;
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
        if($request->gallery != null){
            // Loop from gallery array
            foreach ($request->gallery as $key => $gallery) {
                // Get filename with extenstion
                $filenameWithExt = $gallery->getClientOriginalName();
                
                // Get just fileNameToStore
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                
                // Get just ext
                $extenstion = $gallery->getClientOriginalExtension();
                
                // Filename to store
                $fileNameToStore = 'Albums_'.time().$key.'.'.$extenstion;
                
                // Upload image
                $gallery->move(public_path('img/albums'), $fileNameToStore);

                // Make gallery data
                $gallery = new Album;
                $gallery->img = $fileNameToStore;

                // Save
                $gallery->save();

                // Added reddirect
                return redirect()->back()->with('added','added');
            }
        }else{
            // Error reddirect
            return redirect()->back()->with('error','error');
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale = 'hy', $currency = 'amd', $id)
    {
         // Validation
         $request->validate([
            'img' => 'required',
        ]);

        // Get old image
        $blog_images = Album::findOrFail($id);

        // Image
        if($request->has('img')){
            // get filename with extenstion
            $filenameWithExt = $request -> file('img')->getClientOriginalName();
            // get just fileNameToStore
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // get just ext
            $extenstion = $request->file('img')->getClientOriginalExtension();
            // filename to store
            $fileNameToStore = 'album_'.time().'.'.$extenstion;
            //upload image
            $path = $request->img->move(public_path('/img/albums'), $fileNameToStore);
            // Push data to array
            $update_data = array(
                'img' => $fileNameToStore,
            );
            // Update image
            Album::findOrFail($id)->update($update_data);

            // Check image directory
            if(file_exists(public_path('img/albums/'.$blog_images->img))){
                // Unlink old image
                unlink(public_path('img\albums\\'.$blog_images->img));
            }
            // Success redirect updated
            return redirect()->back()->with('updated','updated');
        }else{
            // Error redirect
            return redirect()->back()->with('error','error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $locale = 'hy', $currency = 'amd', $id)
    {
        // Validation
        $blog_images = Album::findOrFail($id);

        // Check image directory
        if(file_exists(public_path('img/albums/'.$blog_images->img))){
            // Unlink old image
            unlink(public_path('img\albums\\'.$blog_images->img));
        }
        
        Album::findOrFail($id)->delete();

        // Send data to view
        return redirect()->back()->with('deleted','deleted');
    }
}
