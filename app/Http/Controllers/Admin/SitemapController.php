<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sitemap;
use Illuminate\Http\Request;

class SitemapController extends Controller
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
        $page_name = 'Sitemap XML';

        // Get items
        $item = Sitemap::first();

        // Push data
        $data['page_name'] = $page_name;
        $data['item'] = $item;
        $data['route'] = $request->segment(3);

        // Send data to blade
        return view('admin.'.$data['route'].'.show')->with($data);
    }

    public function download(Request $request, $locale = 'hy', $id)
    {
        return response()->download(public_path(). "/sitemap.xml", 'sitemap.xml');
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
     * @param  \App\Models\Sitemap  $sitemap
     * @return \Illuminate\Http\Response
     */
    public function show(Sitemap $sitemap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sitemap  $sitemap
     * @return \Illuminate\Http\Response
     */
    public function edit(Sitemap $sitemap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sitemap  $sitemap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale = 'hy', $id)
    {
        // Validation
        $request->validate([
            'file' => 'required',
        ]);

        // Get image data
        if($request->has('file')){
            // Get filename with extenstion
            $filenameWithExt = $request -> file('file')->getClientOriginalName();
            
            // Get just fileNameToStore
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            // Get just ext
            $extenstion = $request->file('file')->getClientOriginalExtension();
            
            // Filename to store
            $fileNameToStore = 'sitemap1.'.$extenstion;
            
            // Upload image
            $request->file->move(public_path(), $fileNameToStore);
            
        }else{
            return redirect()->back()->with('error','error');
        }

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sitemap  $sitemap
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sitemap $sitemap)
    {
        //
    }
}
