<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SiteData;
use Illuminate\Http\Request;

class SiteDataController extends Controller
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
        $page_name = 'Site Datas';

        // Get items
        $item = SiteData::first();

        // Push data
        $data['page_name'] = $page_name;
        $data['add'] = false;
        $data['item'] = $item;
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
     * @param  \App\SiteData  $siteData
     * @return \Illuminate\Http\Response
     */
    public function show(SiteData $siteData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SiteData  $siteData
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteData $siteData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SiteData  $siteData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale = 'hy', $id)
    {
        // Validation
        $request->validate([
            'name_en' => 'required|max:255',
            'name_ru' => 'required|max:255',
            'name_hy' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:255',
            'map' => 'required',
        ]);

        // Make data
        $item['name_en'] = $request->name_en;
        $item['name_ru'] = $request->name_ru;
        $item['name_hy'] = $request->name_hy;
        $item['email'] = $request->email;
        $item['phone'] = $request->phone;
        $item['map'] = $request->map;

        // Save data
        SiteData::first()->update($item);

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SiteData  $siteData
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiteData $siteData)
    {
        //
    }
}
