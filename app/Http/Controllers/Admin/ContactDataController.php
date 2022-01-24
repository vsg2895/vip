<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ContactDatas;
use Illuminate\Http\Request;

class ContactDataController extends Controller
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
        $page_name = 'Contact Datas';

        // Get items
        $items = ContactDatas::orderBy('id','desc')->get();
        
        // Push data
        $data['items'] = $items;
        $data['add'] = true;
        $data['page_name'] = $page_name;
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
            'value_fr' => 'required|max:255',
            'type' => 'required|max:255',
        ]);

        // Lang Validation
        if($request->has('value_en') && $request->value_en != null){
            $value_en = $request->value_en;
        }else{
            $value_en = $request->value_fr;
        }

        if($request->has('value_ru') && $request->value_ru != null){
            $value_ru = $request->value_ru;
        }else{
            $value_ru = $request->value_fr;
        }

        // Make data
        $item = new ContactDatas;
        $item->value_en = $value_en;
        $item->value_ru = $value_ru;
        $item->value_fr = $request->value_fr;
        $item->type = $request->type;

        // Save data
        $item->save();

        // Success Redirect
        return redirect()->back()->with('added','added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactData  $contactData
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $locale = 'hy', $id)
    {
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Contact Data / Update';

        // Get item
        $item = ContactDatas::findOrFail($id);
        
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
     * @param  \App\Models\ContactData  $contactData
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactData $contactData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactData  $contactData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale = 'hy', $id)
    {
        // Validation
        $request->validate([
            'value_en' => 'required|max:255',
            'value_ru' => 'required|max:255',
            'value_fr' => 'required|max:255',
            'type' => 'required|max:255',
        ]);

        // Make data
        $item['value_en'] = $request->value_en;
        $item['value_ru'] = $request->value_ru;
        $item['value_fr'] = $request->value_fr;
        $item['type'] = $request->type;

        // Save data
        ContactDatas::findOrFail($id)->update($item);

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactData  $contactData
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $locale = 'hy', $id)
    {
        // Delete from itmes
        ContactDatas::findOrFail($id)->delete();

        // Success Redirect
        return redirect()->back()->with('deleted','deleted');
    }
}
