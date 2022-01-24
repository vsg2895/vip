<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Translation;
use Illuminate\Http\Request;
use App\ConfirmTermsAndConditions;

class TranslationsController extends Controller
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
        $page_name = 'Translations';

        // Get items
        $items = Translation::orderBy('id','desc')->get();

        // Push data
        $data['items'] = $items;
        $data['page_name'] = $page_name;
        $data['add'] = true;
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
            'selector' => 'required|max:255',
            'locale' => 'required|max:255',
            'translations' => 'required',
        ]);

        // Make data
        $item = new Translation;
        $item->selector = $request->selector;
        $item->locale = $request->locale;
        $item->translations = $request->translations;

        // Save data
        $item->save();

        // Success Redirect
        return redirect()->back()->with('added','added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $locale = 'hy',  $id)
    {
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Translations / Update';

        // Get item
        $item = Translation::findOrFail($id);
        
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
     * @param  \App\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function edit(Translation $translation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale = 'hy',  $id)
    {
        // Validation
        $request->validate([
            'selector' => 'required|max:255',
            'locale' => 'required|max:255',
            'translations' => 'required',
        ]);
        
        // Get data
        $item = Translation::findOrFail($id);
        $item->selector = $request->selector;
        $item->locale = $request->locale;
        $item->translations = $request->translations;

        // Update
        $item->save();

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $locale = 'hy',  $id)
    {
        // Delete from itmes
        Translation::findOrFail($id)->delete();

        // Success Redirect
        return redirect()->back()->with('deleted','deleted');
    }
}
