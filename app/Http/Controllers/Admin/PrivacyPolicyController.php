<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\TermsAndConditions;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
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
        $page_name = 'Terms And Conditions';

        // Get items
        $items = TermsAndConditions::orderBy('id','desc')->get();
        
        // Push data
        $data['items'] = $items;
        $data['page_name'] = $page_name;
        $data['add'] = false;
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
            'description_en' => 'required',
            'description_ru' => 'required',
            'description_fr' => 'required',
        ]);

        // Make data
        $item = new PrivacyPolicy;
        $item->description_en = $request->description_en;
        $item->description_ru = $request->description_ru;
        $item->description_fr = $request->description_fr;

        // Save data
        $item->save();

        // Success Redirect
        return redirect()->back()->with('added','added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PrivacyPolicy  $privacyPolicy
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $locale = 'hy', $id)
    {
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Terms And Conditions / Update';

        // Get item
        $item = TermsAndConditions::findOrFail($id);
        
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
     * @param  \App\PrivacyPolicy  $privacyPolicy
     * @return \Illuminate\Http\Response
     */
    public function edit(PrivacyPolicy $privacyPolicy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PrivacyPolicy  $privacyPolicy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale = 'hy', $id)
    {
        // Validation
        $request->validate([
            'description_en' => 'required',
            'description_ru' => 'required',
            'description_fr' => 'required',
        ]);
        
        // Get data
        $item = TermsAndConditions::findOrFail($id);
        $item->description_en = $request->description_en;
        $item->description_ru = $request->description_ru;
        $item->description_fr = $request->description_fr;

        // Update
        $item->save();

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PrivacyPolicy  $privacyPolicy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $locale = 'hy', $id)
    {
        // Delete from itmes
        TermsAndConditions::findOrFail($id)->delete();

        // Success Redirect
        return redirect()->back()->with('deleted','deleted');
    }
}
