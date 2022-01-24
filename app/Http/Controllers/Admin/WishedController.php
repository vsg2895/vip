<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\WishlistUser;
use App\WishlistPost;
use App\WishlistSearch;

class WishedController extends Controller
{
    // Admin Validation
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function index_users(Request $request)
    {
        
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Wishlist Users';

        // Get items
        $items = WishlistUser::with(['user', 'wished_user'])->orderBy('id', 'desc')->get();
        
        // Push data
        $data['items'] = $items;
        $data['page_name'] = $page_name;
        $data['route'] = $request->segment(3);

        // Send data to blade
        return view('admin.'.$data['route'].'.index_users')->with($data);
    }

    public function index_posts(Request $request)
    {
        
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Wishlist Posts';

        // Get items
        $items = WishlistPost::with(['user', 'post'])->orderBy('id', 'desc')->get();
        
        // Push data
        $data['items'] = $items;
        $data['page_name'] = $page_name;
        $data['route'] = $request->segment(3);

        // Send data to blade
        return view('admin.'.$data['route'].'.index_posts')->with($data);
    }

    public function index_searches(Request $request)
    {
        
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Wishlist Searches';

        // Get items
        $items = WishlistSearch::with(['user', 'post'])->orderBy('id', 'desc')->get();
        
        // Push data
        $data['items'] = $items;
        $data['page_name'] = $page_name;
        $data['route'] = $request->segment(3);

        // Send data to blade
        return view('admin.'.$data['route'].'.index_searches')->with($data);
    }

    public function destroy_user(Request $request, $locale = 'hy', $id)
    {
        // Delete from itmes
        WishlistUser::findOrFail($id)->delete();

        // Success Redirect
        return redirect()->back()->with('deleted','deleted');
    }

    public function destroy_post(Request $request, $locale = 'hy', $id)
    {
        // Delete from itmes
        WishlistPost::findOrFail($id)->delete();

        // Success Redirect
        return redirect()->back()->with('deleted','deleted');
    }

    public function destroy_search(Request $request, $locale = 'hy', $id)
    {
        // Delete from itmes
        WishlistSearch::findOrFail($id)->delete();

        // Success Redirect
        return redirect()->back()->with('deleted','deleted');
    }

}
