<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Categories;
use App\Products;
use App\ProductDescriptions;
use App\ProductCountdown;
use App\ProductPrices;
use App\ProductEmbeds;
use App\ProductImages;
use App\ProductInStocks;
use App\ProductUnits;
use App\ProductOptions;
use App\ProductRequireds;
use App\ProductReviews;
use App\SmallSlider;
use App\NewProducts;
use App\Cart;
use App\ProductCategories;
use App\Wishlist;
use Illuminate\Http\Request;

class ProductsController extends Controller
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
        $page_name = 'Products';

        // Get items
        $items = Products::with([
            'prices',
            'categories'
        ])->orderBy('id','desc')->paginate(12);

        // Get menu items
        $menu_items = Categories::where('url','category')->get();

        // Push data
        $data['page_name'] = $page_name;
        $data['add_from_new_page'] = true;
        $data['items'] = $items;
        $data['menu_items'] = $menu_items;
        $data['route'] = $request->segment(4);

        // Send data to blade
        return view('admin.'.$data['route'].'.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Add New Product';

        // Get items
        $items = Products::with([
            'prices',
            'categories',
        ])->orderBy('id','desc')->get();

        // Get menu items
        $menu_items = Categories::where('url','category')->get();

        // Push data
        $data['page_name'] = $page_name;
        $data['add'] = false;
        $data['items'] = $items;
        $data['menu_items'] = $menu_items;
        $data['route'] = $request->segment(4);

        // Send data to blade
        return view('admin.'.$data['route'].'.create')->with($data);
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
            'url' => 'required|max:255|unique:products',
            'position_id' => 'required',
            'title_hy' => 'required|max:255',
            'description_hy' => 'required',
            'main_price' => 'required',
            'img' => 'required',
            'in_stock' => 'required',
            'unit_hy' => 'required|max:255',
            'category_id' => 'required',
            'active' => 'required|max:255',
        ]);

        // Lang Validation
        if($request->has('title_en') && $request->title_en != null){
            $title_en = $request->title_en;
        }else{
            $title_en = $request->title_hy;
        }

        if($request->has('title_ru') && $request->title_ru != null){
            $title_ru = $request->title_ru;
        }else{
            $title_ru = $request->title_hy;
        }

        // Lang Validation
        if($request->has('description_en') && $request->description_en != null){
            $description_en = $request->description_en;
        }else{
            $description_en = $request->description_hy;
        }

        if($request->has('description_ru') && $request->description_ru != null){
            $description_ru = $request->description_ru;
        }else{
            $description_ru = $request->description_hy;
        }

        // Lang Validation
        if($request->has('unit_en') && $request->unit_en != null){
            $unit_en = $request->unit_en;
        }else{
            $unit_en = $request->unit_hy;
        }

        if($request->has('unit_ru') && $request->unit_ru != null){
            $unit_ru = $request->unit_ru;
        }else{
            $unit_ru = $request->unit_hy;
        }

        // Make data
        $item = new Products;
        $item->url = $request->url;
        $item->title_en = $title_en;
        $item->title_ru = $title_ru;
        $item->title_hy = $request->title_hy;
        $item->position_id = $request->position_id;
        $item->active = $request->active;
        $item->category_id = $request->category_id;

        // Get image data
        if($request->has('img')){
            // Get filename with extenstion
            $filenameWithExt = $request -> file('img')->getClientOriginalName();
            
            // Get just fileNameToStore
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            // Get just ext
            $extenstion = $request->file('img')->getClientOriginalExtension();
            
            // Filename to store
            $fileNameToStore = 'SolarShop_'.time().'.'.$extenstion;
            
            // Upload image
            $request->img->move(public_path('assets/images/product'), $fileNameToStore);
            
            // Push data
            $item->img = $fileNameToStore;
        }else{
            return redirect()->back()->with('error','error');
        }

        // Save 
        $item->save();

        // Make description data
        $item_description = new ProductDescriptions;
        $item_description->description_en = $description_en;
        $item_description->description_ru = $description_ru;
        $item_description->description_hy = $request->description_hy;
        $item_description->product_id = $item->id;

        // Save description
        $item_description->save();

        // Make unit data
        $item_unit = new ProductUnits;
        $item_unit->unit_en = $unit_en;
        $item_unit->unit_ru = $unit_ru;
        $item_unit->unit_hy = $request->unit_hy;
        $item_unit->product_id = $item->id;

        // Save unit
        $item_unit->save();

        // Make stock data
        $item_stock = new ProductInStocks;
        $item_stock->count = $request->in_stock;
        $item_stock->product_id = $item->id;

        // Save stock
        $item_stock->save();

        // Chck countdown data        
        if($request->has('countdown_value') && $request->countdown_value != null){
            // Make countdown data
            $item_countdown = new ProductCountdown;
            $item_countdown->value = $request->countdown_value;
            $item_countdown->product_id = $item->id;

            // Save countdown
            $item_countdown->save();
        }

        // Check price data
        if($request->has('sale_price') && $request->sale_price > 0){
            $sale_price = $request->sale_price;
        }else{
            $sale_price = 0;
        }

        // Check price sale main data
        if($request->main_price < $sale_price){
            $price = $request->main_price;
        }else{
            if($sale_price > 0){
                $price = $sale_price;
            }else{
                $price = $request->main_price;
            }
        }

        // Make prices data
        $item_prices = new ProductPrices;
        $item_prices->main_price = $request->main_price;
        $item_prices->sale_price = $sale_price;
        $item_prices->price = $price;
        $item_prices->product_id = $item->id;
        
        // Check prices badge data
        if($request->has('badge_text') && $request->badge_text != null){
            $item_prices->badge_show = $request->badge_text;
        }

        // Save description
        $item_prices->save();

        // Chck embed data        
        if($request->has('embed') && $request->embed != null){
            // Make embed data
            $item_embed = new ProductEmbeds;
            $item_embed->url = $request->embed;
            $item_embed->product_id = $item->id;

            // Save embed
            $item_embed->save();
        }

        // Chck special offers data        
        if($request->has('special') && $request->special != null){
            // Make special data
            $item_special = new SmallSlider;
            $item_special->product_id = $item->id;

            // Save embed
            $item_special->save();
        }

        // Chck new produts data        
        if($request->has('new') && $request->new != null){
            // Make new data
            $item_new = new NewProducts;
            $item_new->product_id = $item->id;

            // Save embed
            $item_new->save();
        }

        // Get image data
        if($request->has('gallery')){
            foreach ($request->gallery as $key => $gallery) {
                // Get filename with extenstion
                $filenameWithExt = $gallery->getClientOriginalName();
                
                // Get just fileNameToStore
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                
                // Get just ext
                $extenstion = $gallery->getClientOriginalExtension();
                
                // Filename to store
                $fileNameToStore = 'SolarShop_'.time().$key.'.'.$extenstion;
                
                // Upload image
                $gallery->move(public_path('assets/images/product'), $fileNameToStore);
    
                // Make gallery data
                $gallery = new ProductImages;
                $gallery->img = $fileNameToStore;
                $gallery->product_id = $item->id;
                
                // Save
                $gallery->save();
            }
        }

        // Success Redirect
        return redirect()->route('products-admin-index', ['locale' => app()->getLocale(), 'currency' => 'amd'])->with('added','added');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function store_option(Request $request, $locale = 'hy', $currency = 'amd', $id)
    {
        // Validation
        $request->validate([
            'key_hy' => 'required|max:255',
            'value_hy' => 'required|max:255',
        ]);

        // Lang Validation
        if($request->has('key_en') && $request->key_en != null){
            $key_en = $request->key_en;
        }else{
            $key_en = $request->key_hy;
        }

        if($request->has('key_ru') && $request->key_ru != null){
            $key_ru = $request->key_ru;
        }else{
            $key_ru = $request->key_hy;
        }

        // Lang Validation
        if($request->has('value_en') && $request->value_en != null){
            $value_en = $request->value_en;
        }else{
            $value_en = $request->value_hy;
        }

        if($request->has('value_ru') && $request->value_ru != null){
            $value_ru = $request->value_ru;
        }else{
            $value_ru = $request->value_hy;
        }

        // Push data
        $item = new ProductOptions;
        $item->key_en = $key_en;
        $item->key_ru = $key_ru;
        $item->key_hy = $request->key_hy;
        $item->value_en = $value_en;
        $item->value_ru = $value_ru;
        $item->value_hy = $request->value_hy;
        $item->product_id = $id;

        // Save
        $item->save();

        // Success Redirect
        return redirect()->back()->with('added','added');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function store_category(Request $request, $locale = 'hy', $currency = 'amd', $id)
    {
        // Validation
        $request->validate([
            'category_id' => 'required',
        ]);

        // Push data
        $item = new ProductCategories;
        $item->category_id = $request->category_id;
        $item->position_id = 1;
        $item->product_id = $id;

        // Save
        $item->save();

        // Success Redirect
        return redirect()->back()->with('added','added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $locale = 'hy', $currency = 'amd', $id)
    {
        //. Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Products / Update';

        // Get item
        $item = Products::with([
            'categories',
            'images',
            'embeds',
            'description',
            'countdown',
            'unit',
            'in_stock',
            'options',
            'product_categories',
        ])->findOrFail($id);

        // Get menu items
        $menu_items = Categories::where('url','category')->get();

        // Push data
        $data['item'] = $item;
        $data['page_name'] = $page_name;
        $data['menu_items'] = $menu_items;
        $data['route'] = $request->segment(4);

        // Send data to blade
        return view('admin.'.$data['route'].'.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update_option(Request $request, $locale = 'hy', $currency = 'hy', $id)
    {
        // Validation
        $request->validate([
            'key_en' => 'required|max:255',
            'key_ru' => 'required|max:255',
            'key_hy' => 'required|max:255',
            'value_en' => 'required|max:255',
            'value_ru' => 'required|max:255',
            'value_hy' => 'required|max:255',
        ]);

        // Push data
        $item['key_en'] = $request->key_en;
        $item['key_ru'] = $request->key_ru;
        $item['key_hy'] = $request->key_hy;
        $item['value_en'] = $request->value_en;
        $item['value_ru'] = $request->value_ru;
        $item['value_hy'] = $request->value_hy;

        // Update
        ProductOptions::findOrFail($id)->update($item);

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update_category(Request $request, $locale = 'hy', $currency = 'hy', $id)
    {
        // Validation
        $request->validate([
            'category_id' => 'required',
        ]);

        // Push data
        $item['category_id'] = $request->category_id;

        // Update
        ProductCategories::findOrFail($id)->update($item);

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update_image(Request $request, $locale = 'hy', $currency = 'hy', $id)
    {
        // Validation
        $request->validate([
            'img' => 'required',
        ]);

        // Get image data
        if($request->has('img')){
            // Get filename with extenstion
            $filenameWithExt = $request -> file('img')->getClientOriginalName();
            
            // Get just fileNameToStore
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            // Get just ext
            $extenstion = $request->file('img')->getClientOriginalExtension();
            
            // Filename to store
            $fileNameToStore = 'Solarshop_'.time().'.'.$extenstion;
            
            // Upload image
            $request->img->move(public_path('assets/images/product'), $fileNameToStore);

            // Get this item
            $current_item = ProductImages::findOrFail($id);

            // Check image directory
            if(isset($current_item->img) && $current_item->img != null && file_exists(public_path('assets/images/product/'.$current_item->img))){
                // Unlink old image
                unlink(public_path('assets\images\product\\'.$current_item->img));
            }
            
            // Push data
            $item['img'] = $fileNameToStore;
        
            // Update
            ProductImages::findOrFail($id)->update($item);

            // Success Redirect
            return redirect()->back()->with('updated','updated');
        }else{
            return redirect()->back()->with('error','error');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update_embed(Request $request, $locale = 'hy', $currency = 'hy', $id)
    {
        // Validation
        $request->validate([
            'url' => 'required',
        ]);

        // Push data
        $item['url'] = $request->url;

        // Update
        ProductEmbeds::findOrFail($id)->update($item);

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale = 'hy', $currency = 'amd', $id)
    {
        // Validation
        $request->validate([
            'url' => 'required|max:255',
            'position_id' => 'required',
            'title_hy' => 'required|max:255',
            'description_hy' => 'required',
            'main_price' => 'required',
            'in_stock' => 'required',
            'unit_hy' => 'required|max:255',
            'category_id' => 'required',
            'active' => 'required|max:255',
        ]);

        // Lang Validation
        if($request->has('title_en') && $request->title_en != null){
            $title_en = $request->title_en;
        }else{
            $title_en = $request->title_hy;
        }

        if($request->has('title_ru') && $request->title_ru != null){
            $title_ru = $request->title_ru;
        }else{
            $title_ru = $request->title_hy;
        }

        // Lang Validation
        if($request->has('description_en') && $request->description_en != null){
            $description_en = $request->description_en;
        }else{
            $description_en = $request->description_hy;
        }

        if($request->has('description_ru') && $request->description_ru != null){
            $description_ru = $request->description_ru;
        }else{
            $description_ru = $request->description_hy;
        }

        // Lang Validation
        if($request->has('unit_en') && $request->unit_en != null){
            $unit_en = $request->unit_en;
        }else{
            $unit_en = $request->unit_hy;
        }

        if($request->has('unit_ru') && $request->unit_ru != null){
            $unit_ru = $request->unit_ru;
        }else{
            $unit_ru = $request->unit_hy;
        }

        // Make data
        $item = Products::findOrFail($id);
        $item->url = $request->url;
        $item->title_en = $title_en;
        $item->title_ru = $title_ru;
        $item->title_hy = $request->title_hy;
        $item->position_id = $request->position_id;
        $item->active = $request->active;
        $item->category_id = $request->category_id;

        // Get image data
        if($request->has('img')){
            // Get filename with extenstion
            $filenameWithExt = $request -> file('img')->getClientOriginalName();
            
            // Get just fileNameToStore
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            // Get just ext
            $extenstion = $request->file('img')->getClientOriginalExtension();
            
            // Filename to store
            $fileNameToStore = 'SolarShop_'.time().'.'.$extenstion;

            // Check image directory
            if(isset($item->img) && $item->img != null && file_exists(public_path('assets/images/product/'.$item->img))){
                // Unlink old image
                unlink(public_path('assets\images\product\\'.$item->img));
            }
            
            // Upload image
            $request->img->move(public_path('assets/images/product'), $fileNameToStore);
            
            // Push data
            $item->img = $fileNameToStore;
        }

        // Save 
        $item->save();

        // Make description data
        $item_description = ProductDescriptions::where('product_id', $id)->first();
        $item_description->description_en = $description_en;
        $item_description->description_ru = $description_ru;
        $item_description->description_hy = $request->description_hy;
        $item_description->product_id = $id;

        // Save description
        $item_description->save();

        // Make unit data
        $item_unit = ProductUnits::where('product_id', $id)->first();
        $item_unit->unit_en = $unit_en;
        $item_unit->unit_ru = $unit_ru;
        $item_unit->unit_hy = $request->unit_hy;
        $item_unit->product_id = $id;

        // Save unit
        $item_unit->save();

        // Make stock data
        $item_stock = ProductInStocks::where('product_id', $id)->first();
        $item_stock->count = $request->in_stock;
        $item_stock->product_id = $id;

        // Save stock
        $item_stock->save();

        // Chck countdown data        
        if($request->has('countdown_value') && $request->countdown_value != null){
            // Check exists
            $countdowns = ProductCountdown::where('product_id', $id)->get();
            
            // Get count
            if(count($countdowns) > 0){
                 // Make countdown data
                $item_countdown = ProductCountdown::where('product_id', $id)->first();
            }else{
                // Make countdown data
                $item_countdown = new ProductCountdown;
            }
           
            $item_countdown->value = $request->countdown_value;
            $item_countdown->product_id = $id;

            // Save countdown
            $item_countdown->save();
        }

        // Check price data
        if($request->has('sale_price') && $request->sale_price > 0){
            $sale_price = $request->sale_price;
        }else{
            $sale_price = 0;
        }

        // Check price sale main data
        if($request->main_price < $sale_price){
            $price = $request->main_price;
        }else{
            if($sale_price > 0){
                $price = $sale_price;
            }else{
                $price = $request->main_price;
            }
        }

        // Make prices data
        $item_prices = ProductPrices::where('product_id', $id)->first();
        $item_prices->main_price = $request->main_price;
        $item_prices->sale_price = $sale_price;
        $item_prices->price = $price;
        $item_prices->product_id = $id;
        
        // Check prices badge data
        if($request->has('badge_text') && $request->badge_text != null){
            $item_prices->badge_show = $request->badge_text;
        }

        // Save description
        $item_prices->save();

        // Chck embed data        
        if($request->has('embed') && $request->embed != null){
            // Make countdown data
            $item_embed = new ProductEmbeds;
            $item_embed->url = $request->embed;
            $item_embed->product_id = $id;

            // Save embed
            $item_embed->save();
        }

        // Chck special offers data        
        if($request->has('special') && $request->special != null){
            // Check exists
            $special = SmallSlider::where('product_id', $id)->get();
            
            // Get count
            if(count($special) < 1){
                // Make special data
                $item_special = new SmallSlider;
                $item_special->product_id = $id;
            
                // Save embed
                $item_special->save();
            }else{
                // Delete
                SmallSlider::where('product_id', $id)->delete();
            }
        }

        // Chck new produts data       
        if($request->has('new') && $request->new != null){
            // Check exists
            $news = NewProducts::where('product_id', $id)->get();
            
            // Get count
            if(count($news) < 1){
                // Make new data
                $item_new = new NewProducts;
                $item_new->product_id = $id;
            
                // Save embed
                $item_new->save();
            }else{
                // Delete
                NewProducts::where('product_id', $id)->delete();
            }
        }

        // Get image data
        if($request->has('gallery')){
            foreach ($request->gallery as $key => $gallery) {
                // Get filename with extenstion
                $filenameWithExt = $gallery->getClientOriginalName();
                
                // Get just fileNameToStore
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                
                // Get just ext
                $extenstion = $gallery->getClientOriginalExtension();
                
                // Filename to store
                $fileNameToStore = 'SolarShop_'.time().$key.'.'.$extenstion;
                
                // Upload image
                $gallery->move(public_path('assets/images/product'), $fileNameToStore);
    
                // Make gallery data
                $gallery = new ProductImages;
                $gallery->img = $fileNameToStore;
                $gallery->product_id = $id;
                
                // Save
                $gallery->save();
            }
        }

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }     

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy_option(Request $request, $locale = 'hy', $currency = 'amd', $id)
    {
        // Delete
        ProductOptions::findOrFail($id)->delete();
        
        // Send data to view
        return redirect()->back()->with('deleted','deleted');
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy_category(Request $request, $locale = 'hy', $currency = 'amd', $id)
    {
        // Delete
        ProductCategories::findOrFail($id)->delete();
        
        // Send data to view
        return redirect()->back()->with('deleted','deleted');
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy_embed(Request $request, $locale = 'hy', $currency = 'amd', $id)
    {
        // Delete
        ProductEmbeds::findOrFail($id)->delete();
        
        // Send data to view
        return redirect()->back()->with('deleted','deleted');
    } 
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy_image(Request $request, $locale = 'hy', $currency = 'amd', $id)
    {
        // Get items
        $item = ProductImages::findOrFail($id);

        // Check image directory
        if(isset($item->img) && $item->img != null && file_exists(public_path('assets/images/product/'.$item->img))){
            // Unlink old image
            unlink(public_path('assets\images\product\\'.$item->img));
        }
        
        // Delete
        ProductImages::findOrFail($id)->delete();

        // Send data to view
        return redirect()->back()->with('deleted','deleted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $locale = 'hy', $currency = 'amd', $id)
    {
        // Get item
        $item = Products::findOrFail($id);

        // Delete from descriptions
        ProductDescriptions::where('product_id', $item->id)->delete();

        // Delete from countdowns
        ProductCountdown::where('product_id', $item->id)->delete();

        // Delete from prices
        ProductPrices::where('product_id', $item->id)->delete();

        // Delete from embeds
        ProductEmbeds::where('product_id', $item->id)->delete();

        // Delete from stocks
        ProductInStocks::where('product_id', $item->id)->delete();

        // Delete from units
        ProductUnits::where('product_id', $item->id)->delete();

        // Delete from small slider
        SmallSlider::where('product_id', $item->id)->delete();

        // Delete from cart
        Cart::where('product_id', $item->id)->where('status', 1)->delete();

        // Delete from wishlist
        Wishlist::where('product_id', $item->id)->delete();

        // Delete from options
        ProductOptions::where('product_id', $item->id)->delete();

        // Delete from requrieds
        ProductRequireds::where('product_id', $item->id)->delete();

        // Delete from reveiws
        ProductReviews::where('product_id', $item->id)->delete();

        // Delete from new products
        NewProducts::where('product_id', $item->id)->delete();

        // Get images data
        $images = ProductImages::where('product_id', $item->id)->get();

        // Loop from images
        foreach($images as $image){
            // Check image directory
            if(isset($image->img) && $image->img != null && file_exists(public_path('assets/images/product/'.$image->img))){
                // Unlink old image
                unlink(public_path('assets\images\product\\'.$image->img));
            }
        }
        
        // Delete from images
        ProductImages::where('product_id', $item->id)->delete();

        // Check image directory
        if(isset($item->img) && $item->img != null && file_exists(public_path('assets/images/product/'.$item->img))){
            // Unlink old image
            unlink(public_path('assets\images\product\\'.$item->img));
        }

        // Delet from products
        Products::findOrFail($id)->delete();

        // Success redirect
        return redirect()->route('products-admin-index', ['locale' => app()->getLocale(), 'currency' => 'amd'])->with('deleted','deleted');

    }
}
