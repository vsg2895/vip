<?php

namespace App\Http\Controllers\Admin;

use App\CurrencyApi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurrencyApiController extends Controller
{
    // Admin Validation
    public function __construct(Request $request) 
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
        $page_name = 'Currency API';

        // Get items
        $item = CurrencyApi::first();

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
     * @param  \App\CurrencyApi  $currencyApi
     * @return \Illuminate\Http\Response
     */
    public function show(CurrencyApi $currencyApi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CurrencyApi  $currencyApi
     * @return \Illuminate\Http\Response
     */
    public function edit(CurrencyApi $currencyApi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CurrencyApi  $currencyApi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale = 'hy', $id)
    {
        // Validation
        $request->validate([
            'amd' => 'required',
            'usd' => 'required',
            'rub' => 'required',
        ]);

        // Get data
        $item = CurrencyApi::findOrFail($id);
        
        // Make data
        $item->amd = $request->amd;
        $item->usd = $request->usd;
        $item->rub = $request->rub;

        // Save data
        $item->save();

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CurrencyApi  $currencyApi
     * @return \Illuminate\Http\Response
     */
    public function destroy(CurrencyApi $currencyApi)
    {
        //
    }
}
