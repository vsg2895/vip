<?php

namespace App\Http\Controllers\Admin;

use App\FooterLinks;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FooterLinksController extends Controller
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
        $page_name = 'Footer Links';

        // Get items
        $items = FooterLinks::orderBy('id','desc')->get();

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
            'title_fr' => 'required|max:255',
            'url' => 'required|max:255',
            'position_id' => 'required',
        ]);

        // Lang Validation
        if($request->has('title_en') && $request->title_en != null){
            $title_en = $request->title_en;
        }else{
            $title_en = $request->title_fr;
        }

        if($request->has('title_ru') && $request->title_ru != null){
            $title_ru = $request->title_ru;
        }else{
            $title_ru = $request->title_fr;
        }

        // Make data
        $item = new FooterLinks;
        $item->title_en = $title_en;
        $item->title_ru = $title_ru;
        $item->title_fr = $request->title_fr;
        $item->position_id = $request->position_id;
        $item->url = $request->url;

        // Save data
        $item->save();

        // Success Redirect
        return redirect()->back()->with('added','added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FooterLinks  $footerLinks
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $locale = 'hy', $id)
    {
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Footer Links / Update';

        // Get item
        $item = FooterLinks::findOrFail($id);

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
     * @param  \App\FooterLinks  $footerLinks
     * @return \Illuminate\Http\Response
     */
    public function edit(FooterLinks $footerLinks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FooterLinks  $footerLinks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale = 'hy', $id)
    {
        // Validation
        $request->validate([
            'title_en' => 'required|max:255',
            'title_ru' => 'required|max:255',
            'title_fr' => 'required|max:255',
            'position_id' => 'required',
            'url' => 'required',
        ]);

        // Make data
        $item['title_en'] = $request->title_en;
        $item['title_ru'] = $request->title_ru;
        $item['title_fr'] = $request->title_fr;
        $item['position_id'] = $request->position_id;
        $item['url'] = $request->url;

        // Save data
        FooterLinks::findOrFail($id)->update($item);

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FooterLinks  $footerLinks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $locale = 'hy', $id)
    {
         // Delete from itmes
         FooterLinks::findOrFail($id)->delete();

         // Success Redirect
         return redirect()->back()->with('deleted','deleted');
    }
}
