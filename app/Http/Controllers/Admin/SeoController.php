<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Seo;
use App\ImageHandler;
use Illuminate\Http\Request;

class SeoController extends Controller
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
        $page_name = 'Seo Optimization';

        // Get items
        $items = Seo::orderBy('id','desc')->get();
        
        // Push data
        $data['items'] = $items;
        $data['page_name'] = $page_name;
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
     * @param  \App\Seo  $seo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $locale = 'hy', $id)
    {
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Seo Optimization / Update';

        // Get item
        $item = Seo::findOrFail($id);
        
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
     * @param  \App\Seo  $seo
     * @return \Illuminate\Http\Response
     */
    public function edit(Seo $seo)
    {
        //
    }


   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seo  $seo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale = 'hy', $id)
    {
        // Validation
        $request->validate([
            'title_en' => 'required|max:255',
            'title_ru' => 'required|max:255',
            'title_hy' => 'required|max:255',
            'description_en' => 'required',
            'description_ru' => 'required',
            'description_hy' => 'required',
        ]);
        
        // Get data
        $item = Seo::findOrFail($id);
        $item->title_en = $request->title_en;
        $item->title_ru = $request->title_ru;
        $item->title_hy = $request->title_hy;
        $item->description_en = $request->description_en;
        $item->description_ru = $request->description_ru;
        $item->description_hy = $request->description_hy;

        // Get image data
        if($request->has('img')){
            // Get just ext
            $extenstion = $request->file('img')->getClientOriginalExtension();
            
            // Filename to store
            $fileNameToStore = translating('yerevan-vip-img-title').time().'.'.$extenstion;

            // Make data
            $image = new ImageHandler();

            // File upload to tmp
            $image->loadImg($request->img);
            
            // Upload image
            $image->saveImg(pathBackMakeForwardSlash(public_path('\assets\img\seo\\'.$fileNameToStore)));
            
            // Get old image data
            $old_image = $item->img;

            // Check old image
            if(file_exists(pathBackMakeForwardSlash(public_path('\assets\img\seo\\'.$fileNameToStore)))){
                // Remove old image-
                $image->removeOldImg(pathBackMakeForwardSlash(public_path('\assets\img\seo\\'.$old_image)));
            }
            
            // Push data
            $item->img = $fileNameToStore;
        }


        // Update
        $item->save();

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seo  $seo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seo $seo)
    {
        //
    }
}
