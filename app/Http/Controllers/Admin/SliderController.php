<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Slider;
use App\ImageHandler;
use Illuminate\Http\Request;

class SliderController extends Controller
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
        $page_name = 'Slider';

        // Get items
        $items = Slider::orderBy('id','desc')->get();

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
            'title_en' => 'required|max:255',
            'title_ru' => 'required|max:255',
            'title_hy' => 'required|max:255',
            'description_en' => 'required',
            'description_ru' => 'required',
            'description_hy' => 'required',
            'url' => 'required',
            'position_id' => 'required',
            'img' => 'required',
        ]);

        // Make data
        $item = new Slider;
        $item->title_en = $request->title_en;
        $item->title_ru = $request->title_ru;
        $item->title_hy = $request->title_hy;
        $item->description_en = $request->description_en;
        $item->description_ru = $request->description_ru;
        $item->description_hy = $request->description_hy;
        $item->url = $request->url;
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
            $image->saveImg(pathBackMakeForwardSlash(public_path('\assets\img\slider\\'.$fileNameToStore)));
            
            // Push data
            $item->img = $fileNameToStore;
        }else{
            // Error redirect
            return redirect()->back()>with('error','error');
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
        $page_name = 'Slider / Update';

        // Get item
        $item = Slider::findOrFail($id);
        
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
            'title_en' => 'required|max:255',
            'title_ru' => 'required|max:255',
            'title_hy' => 'required|max:255',
            'description_en' => 'required',
            'description_ru' => 'required',
            'description_hy' => 'required',
            'url' => 'required',
            'position_id' => 'required',
        ]);

        // Get data
        $item = Slider::findOrFail($id);

        // Make data
        $item['title_en'] = $request->title_en;
        $item['title_ru'] = $request->title_ru;
        $item['title_hy'] = $request->title_hy;
        $item['description_en'] = $request->description_en;
        $item['description_ru'] = $request->description_ru;
        $item['description_hy'] = $request->description_hy;
        $item['url'] = $request->url;
        $item['position_id'] = $request->position_id;

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
            $image->saveImg(pathBackMakeForwardSlash(public_path('\assets\img\slider\\'.$fileNameToStore)));
            
            // Get old image data
            $old_image = $item->img;

            // Check old image
            if(file_exists(pathBackMakeForwardSlash(public_path('\assets\img\slider\\'.$fileNameToStore)))){
                // Remove old image-
                $image->removeOldImg(pathBackMakeForwardSlash(public_path('\assets\img\slider\\'.$old_image)));
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
        $item = Slider::findOrFail($id);
        
        // Make data
        $image = new ImageHandler();
        
        // Check old image
        if(file_exists(pathBackMakeForwardSlash(public_path('\assets\img\slider\\'.$item->img)))){
            // Remove old image-
            $image->removeOldImg(pathBackMakeForwardSlash(public_path('\assets\img\slider\\'.$item->img)));
        }
        
        // Delete from itmes
        Slider::findOrFail($id)->delete();

        // Success Redirect
        return redirect()->back()->with('deleted','deleted');
    }
}
