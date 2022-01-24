<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Reference;
use Illuminate\Http\Request;

class ReferencesController extends Controller
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
        $page_name = 'References';

        // Get items
        $items = Reference::orderBy('id','desc')->get();

        // Push data
        $data['page_name'] = $page_name;
        $data['add'] = false;
        $data['items'] = $items;
        $data['route'] = $request->segment(3);

        // Send data to blade
        return view('admin.'.$data['route'].'.index')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reference  $reference
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $locale = 'hy', $id)
    {
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'References / Update';

        // Get item
        $item = Reference::findOrFail($id);
        
        // Push data
        $data['item'] = $item;
        $data['page_name'] = $page_name;
        $data['route'] = $request->segment(3);

        // Send data to blade
        return view('admin.'.$data['route'].'.show')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reference  $reference
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

        // Make data
        $item = Reference::findOrFail($id);
        $item->title_en = $request->title_en;
        $item->title_ru = $request->title_ru;
        $item->title_hy = $request->title_hy;
        $item->description_en = $request->description_en;
        $item->description_ru = $request->description_ru;
        $item->description_hy = $request->description_hy;

        // Save data
        $item->save();

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }
}
