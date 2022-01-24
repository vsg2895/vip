<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class OrdersController extends Controller
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
        $page_name = 'Orders';

        // Get items
        $items = Order::with('user')->orderBy('id','desc')->get();

        // Get users
        $users = User::orderBy('id', 'desc')->get();

        // Push data
        $data['page_name'] = $page_name;
        $data['add'] = true;
        $data['items'] = $items;
        $data['users'] = $users;
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
            'service_fr' => 'required|max:255',
            'address_fr' => 'required|max:255',
            'status_fr' => 'required|max:255',
            'description_fr' => 'required',
            'client_name_fr' => 'required',
            'phone' => 'required',
            'price' => 'required',
            'type' => 'required',
            'user_id' => 'required',
        ]);

        // Lang Validation
        if($request->has('service_en') && $request->service_en != null){
            $service_en = $request->service_en;
        }else{
            $service_en = $request->service_fr;
        }

        if($request->has('service_ru') && $request->service_ru != null){
            $service_ru = $request->service_ru;
        }else{
            $service_ru = $request->service_fr;
        }

        // Lang Validation
        if($request->has('description_en') && $request->description_en != null){
            $description_en = $request->description_en;
        }else{
            $description_en = $request->description_fr;
        }

        if($request->has('description_ru') && $request->description_ru != null){
            $description_ru = $request->description_ru;
        }else{
            $description_ru = $request->description_fr;
        }

        // Lang Validation
        if($request->has('client_name_en') && $request->client_name_en != null){
            $client_name_en = $request->client_name_en;
        }else{
            $client_name_en = $request->client_name_fr;
        }

        if($request->has('client_name_ru') && $request->client_name_ru != null){
            $client_name_ru = $request->client_name_ru;
        }else{
            $client_name_ru = $request->client_name_fr;
        }

        // Lang Validation
        if($request->has('description_en') && $request->description_en != null){
            $description_en = $request->description_en;
        }else{
            $description_en = $request->description_fr;
        }

        // Lang Validation
        if($request->has('address_en') && $request->address_en != null){
            $address_en = $request->address_en;
        }else{
            $address_en = $request->address_fr;
        }

        if($request->has('address_ru') && $request->address_ru != null){
            $address_ru = $request->address_ru;
        }else{
            $address_ru = $request->address_fr;
        }

        // Lang Validation
        if($request->has('status_en') && $request->status_en != null){
            $status_en = $request->status_en;
        }else{
            $status_en = $request->status_fr;
        }

        if($request->has('status_ru') && $request->status_ru != null){
            $status_ru = $request->status_ru;
        }else{
            $status_ru = $request->status_fr;
        }

        // Make data
        $order = new Order;
        $order->service_en = $service_en;
        $order->service_ru = $service_ru;
        $order->service_fr = $request->service_fr;
        $order->address_en = $address_en;
        $order->address_ru = $address_ru;
        $order->address_fr = $request->address_fr;
        $order->client_name_en = $client_name_en;
        $order->client_name_ru = $client_name_ru;
        $order->client_name_fr = $request->client_name_fr;
        $order->status_en = $status_en;
        $order->status_ru = $status_ru;
        $order->status_fr = $request->status_fr;
        $order->description_en = $description_en;
        $order->description_ru = $description_ru;
        $order->description_fr = $request->description_fr;
        $order->phone = $request->phone;
        $order->type = $request->type;
        $order->price = $request->price;
        $order->user_id = $request->user_id;

        // Save data
        $order->save();

        // Success Redirect
        return redirect()->back()->with('added','added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $locale = 'hy', $id)
    {
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Orders / Update';

        // Get item
        $item = Order::with(['user'])->findOrFail($id);

        // Get users 
        $users = User::orderBy('id', 'desc')->get();

        // Push data
        $data['item'] = $item;
        $data['users'] = $users;
        $data['add'] = false;
        $data['page_name'] = $page_name;
        $data['route'] = $request->segment(3);

        // Send data to blade
        return view('admin.'.$data['route'].'.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale = 'hy', $id)
    {
        // Validation
        $request->validate([
            'service_en' => 'required|max:255',
            'service_ru' => 'required|max:255',
            'service_fr' => 'required|max:255',
            'address_en' => 'required|max:255',
            'address_ru' => 'required|max:255',
            'address_fr' => 'required|max:255',
            'client_name_en' => 'required|max:255',
            'client_name_ru' => 'required|max:255',
            'client_name_fr' => 'required|max:255',
            'status_en' => 'required|max:255',
            'status_ru' => 'required|max:255',
            'status_fr' => 'required|max:255',
            'description_en' => 'required',
            'description_ru' => 'required',
            'description_fr' => 'required',
            'phone' => 'required',
            'price' => 'required',
            'material_price' => 'required',
            'type' => 'required',
            'user_id' => 'required',
        ]);

        // Make data
        $item['service_en'] = $request->service_en;
        $item['service_ru'] = $request->service_ru;
        $item['service_fr'] = $request->service_fr;
        $item['client_name_en'] = $request->client_name_en;
        $item['client_name_ru'] = $request->client_name_ru;
        $item['client_name_fr'] = $request->client_name_fr;
        $item['address_en'] = $request->address_en;
        $item['address_ru'] = $request->address_ru;
        $item['address_fr'] = $request->address_fr;
        $item['status_en'] = $request->status_en;
        $item['status_ru'] = $request->status_ru;
        $item['status_fr'] = $request->status_fr;
        $item['description_en'] = $request->description_en;
        $item['description_ru'] = $request->description_ru;
        $item['description_fr'] = $request->description_fr;
        $item['phone'] = $request->phone;
        $item['type'] = $request->type;
        $item['price'] = $request->price;
        $item['material_price'] = $request->material_price;
        $item['user_id'] = $request->user_id;

        // Save data
        Order::findOrFail($id)->update($item);

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $locale = 'hy', $id)
    {
        // Delete from orders data
        Order::findOrFail($id)->delete();

        // Delete from carts
        Cart::where('order_id', $id)->delete();

        // Success Redirect
        return redirect()->back()->with('deleted','deleted');
    }
}
