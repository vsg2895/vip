<?php

namespace App\Http\Controllers\Admin;

use App\CardData;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CardDatasController extends Controller
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
        $page_name = 'Card Datas';

        // Get items
        $item = CardData::first();

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
     * @param  \App\CardData  $cardData
     * @return \Illuminate\Http\Response
     */
    public function show(CardData $cardData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CardData  $cardData
     * @return \Illuminate\Http\Response
     */
    public function edit(CardData $cardData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CardData  $cardData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale = 'hy', $id)
    {
        // Validation
        $request->validate([
            'card_number' => 'required|max:255',
            'title_en' => 'required|max:255',
            'title_ru' => 'required|max:255',
            'title_fr' => 'required|max:255',
            'description_en' => 'required',
            'description_ru' => 'required',
            'description_fr' => 'required',
            'recipient' => 'required',
        ]);

        // Make data
        $item['title_en'] = $request->title_en;
        $item['title_ru'] = $request->title_ru;
        $item['title_fr'] = $request->title_fr;
        $item['description_en'] = $request->description_en;
        $item['description_ru'] = $request->description_ru;
        $item['description_fr'] = $request->description_fr;
        $item['recipient'] = $request->recipient;
        $item['card_number'] = $request->card_number;

        // Get image data
        if($request->has('img')){
            // Get filename with extenstion
            $filenameWithExt = $request -> file('img')->getClientOriginalName();
            
            // Get just fileNameToStore
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            // Get just ext
            $extenstion = $request->file('img')->getClientOriginalExtension();
            
            // Filename to store
            $fileNameToStore = 'card.png';
            
            // Upload image
            $request->img->move(public_path('assets/img/card-data'), $fileNameToStore);
            
            // Push data
            $item['img'] = $fileNameToStore;
        }

        // Save data
        CardData::first()->update($item);

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CardData  $cardData
     * @return \Illuminate\Http\Response
     */
    public function destroy(CardData $cardData)
    {
        //
    }
}
