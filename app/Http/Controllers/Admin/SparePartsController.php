<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SparePart;
use App\Location;
use App\SparePartModel;
use App\ImageHandler;
use Illuminate\Http\Request;

class SparePartsController extends Controller
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
        $page_name = 'Spare Parts';

        // Get items
        $items = SparePart::with(['location','model'])->orderBy('id','desc')->get();

        $locations = Location::all();
        $models = SparePartModel::all();

        // Push data
        $data['page_name'] = $page_name;
        $data['add'] = true;
        $data['items'] = $items;
        $data['locations'] = $locations;
        $data['models'] = $models;
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:255',
            'location_id' => 'required|max:255',
            'model_id' => 'required|max:255',
            'img' => 'required',
        ]);

        // Make data
        $item = new SparePart;
        $item->first_name = $request->first_name;
        $item->last_name = $request->last_name;
        $item->email = $request->email;
        $item->phone = $request->phone;
        $item->location_id = $request->location_id;
        $item->model_id = $request->model_id;

        // Get image data
        if($request->has('img')){
            // $path = Storage::putFile('avatars', $request->file('avatar'));

            // Get just ext
            $extenstion = $request->file('img')->getClientOriginalExtension();
            
            // Filename to store
            $fileNameToStore = translating('yerevan-vip-img-title').time().'.'.$extenstion;

            $request->file('img')->move(pathBackMakeForwardSlash(public_path('\assets\img\spare-parts\\')), $fileNameToStore);

            // Make data
            /*$image = new ImageHandler();

            // File upload to tmp
            $image->loadImg($request->img);
            
            // Upload image
            $image->saveImg(pathBackMakeForwardSlash(public_path('\assets\img\spare-parts\\'.$fileNameToStore)));
            */
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
     * @param  \App\SparePart  $sparePart
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $locale = 'hy', $id)
    {
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Spare Part / Update';

        // $terms_and_conditions_items = TermsAndConditions::orderBy('id', 'desc')->get();

        // Get confirms
        // $confirms = ConfirmTermsAndConditions::where('user_id', Auth::user()->id)->get();

        $item = SparePart::findOrFail($id);

        // Make array
        $arr = array();

        // Loop from confirms
        // foreach($confirms as $confirm){
        //     array_push($arr, $confirm->terms_id);
        // };

        $locations = Location::all();
        $models = SparePartModel::all();

        // Push data
        $data['item'] = $item;
        // $data['terms_and_conditions_items'] = $terms_and_conditions_items;
        // $data['arr'] = $arr;
        $data['page_name'] = $page_name;
        $data['route'] = $request->segment(3);
        $data['locations'] = $locations;
        $data['models'] = $models;

        // Send data to blade
        return view('admin.'.$data['route'].'.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SparePart  $sparePart
     * @return \Illuminate\Http\Response
     */
    public function edit(SparePart $sparePart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SparePart  $sparePart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale = 'hy', $id)
    {
        // Validation
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required',
            'model_id' => 'required',
            'location_id' => 'required',
        ]);

        // Make data
        $item['first_name'] = $request->first_name;
        $item['last_name'] = $request->last_name;
        $item['email'] = $request->email;
        $item['phone'] = $request->phone;
        $item['model_id'] = $request->model_id;
        $item['location_id'] = $request->location_id;


        // Save data
        SparePart::findOrFail($id)->update($item);

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SparePart  $sparePart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $locale, $id)
    {
        
        $deleted = SparePart::destroy($id);

        if ($deleted)
        {
            return redirect()->back()->with('deleted','deleted');
        } else {
            return redirect()->back()->with('error', 'error');
        }
        
    }
}
