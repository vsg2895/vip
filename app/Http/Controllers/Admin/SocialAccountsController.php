<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SocialAccount;
use Illuminate\Http\Request;

class SocialAccountsController extends Controller
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
        $page_name = 'Social Accounts';

        // Get items
        $items = SocialAccount::orderBy('id','desc')->get();
        
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
            'icon' => 'required|max:255',
            'url' => 'required|max:255',
            'position_id' => 'required|max:255',
        ]);

        // Make data
        $item = new SocialAccount;
        $item->icon = $request->icon;
        $item->url = $request->url;
        $item->position_id = $request->position_id;

        // Save data
        $item->save();

        // Success Redirect
        return redirect()->back()->with('added','added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SocialAccount  $socialAccount
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $locale = 'hy', $id)
    {
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Social Account / Update';

        // Get item
        $item = SocialAccount::findOrFail($id);
        
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
     * @param  \App\SocialAccount  $socialAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialAccount $socialAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SocialAccount  $socialAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale = 'hy', $id)
    {
        // Validation
        $request->validate([
            'icon' => 'required|max:255',
            'url' => 'required|max:255',
            'position_id' => 'required|max:255',
        ]);
        
        // Get data
        $item = SocialAccount::findOrFail($id);
        $item->icon = $request->icon;
        $item->url = $request->url;
        $item->position_id = $request->position_id;

        // Update
        $item->save();

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SocialAccount  $socialAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $locale = 'hy', $id)
    {
        // Delete from itmes
        SocialAccount::findOrFail($id)->delete();

        // Success Redirect
        return redirect()->back()->with('deleted','deleted');
    }
}
