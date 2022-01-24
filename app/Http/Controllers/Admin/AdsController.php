<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Ad;
use Illuminate\Http\Request;
use App\ImageHandler;

class AdsController extends Controller
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
        $page_name = 'Ads';

        // Get items
        $items = Ad::orderBy('id','desc')->get();
        $top_categories = Category::where('top', 1)->limit(10)->get();

        // Push data
        $data['page_name'] = $page_name;
        $data['add'] = true;
        $data['items'] = $items;
        $data['top_categories'] = $top_categories;
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
            'url' => 'required|max:255',
            'type' => 'required|max:255',
            'position_id' => 'required',
            'img' => 'required',
        ]);

        // Make data
        $item = new Ad;
        $item->url = $request->url;
        $item->type = $request->type;
        $item->position_id = $request->position_id;
        if ($request->category == '0')
        {
            $request->category = null;

        }
        $item->category_id = $request->category;
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
            $image->saveImg(pathBackMakeForwardSlash(public_path('\assets\img\ads\\'.$fileNameToStore)));

            // Push data
            $item->img = $fileNameToStore;
        }else{
            return redirect()->back()->with('error', 'error');
        }

        // Save data
        $item->save();

        // Success Redirect
        return redirect()->back()->with('added','added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $locale = 'hy', $id)
    {
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Ads / Update';

        // Get item
        $item = Ad::findOrFail($id);

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
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale = 'hy', $id)
    {
        // Validation
        $request->validate([
            'url' => 'required|max:255',
            'type' => 'required|max:255',
            'position_id' => 'required',
        ]);

        // Make data
        $item = Ad::findOrFail($id);
        $item->url = $request->url;
        $item->type = $request->type;
        $item->position_id = $request->position_id;

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
            $image->saveImg(pathBackMakeForwardSlash(public_path('\assets\img\ads\\'.$fileNameToStore)));

            // Get old image data
            $old_image = $item->img;

            // Check old image
            if(file_exists(pathBackMakeForwardSlash(public_path('\assets\img\ads\\'.$fileNameToStore)))){
                // Remove old image-
                $image->removeOldImg(pathBackMakeForwardSlash(public_path('\assets\img\ads\\'.$old_image)));
            }

            // Push data
            $item->img = $fileNameToStore;
        }

        // Save data
        $item->save();

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $locale = 'hy', $id)
    {
        // Get item
        $item = Ad::findOrFail($id);

        // Make data
        $image = new ImageHandler();

        // Check old image
        if(file_exists(pathBackMakeForwardSlash(public_path('\assets\img\ads\\'.$item->img)))){
            // Remove old image-
            $image->removeOldImg(pathBackMakeForwardSlash(public_path('\assets\img\ads\\'.$item->img)));
        }

        // Delete from itmes
        Ad::findOrFail($id)->delete();

        // Success Redirect
        return redirect()->back()->with('deleted','deleted');
    }
}
