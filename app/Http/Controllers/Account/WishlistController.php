<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\WishlistPost;
use App\WishlistUser;
use App\WishlistSearch;

class WishlistController extends Controller
{
    // Pagination items count
    protected $pagination_items_count = 4;

    // Auth Validation
    public function __construct() 
    {
        $this->middleware('auth');
    }

    // Posts
    public function index(Request $request, $locale = 'hy'){
        // Get middleware data
        $data = $request->data;

        // Get wished posts
        $posts = WishlistPost::with(['post'])->where('user_id', Auth::user()->id)->paginate($this->pagination_items_count);

        // Push data
        $data['posts'] = $posts;
        $data['page_name_account_aside'] = 'wishlist';

        // Chek request type
        if($request->ajax()){ // Axios request
            // Send data to view
            return view('account.wishlist.content')->with($data);
        }else{
            // Send data to view
            return view('account.wishlist.index')->with($data);
        }
    }

    // Users
    public function users(Request $request, $locale = 'hy'){
        // Get middleware data
        $data = $request->data;

        // Get wished users
        $users = WishlistUser::with(['user'])->where('wished_user_id', Auth::user()->id)->paginate($this->pagination_items_count);

        // Push data
        $data['users'] = $users;
        $data['page_name_account_aside'] = 'wishlist';

        // Chek request type
        if($request->ajax()){ // Axios request
            // Send data to view
            return view('account.wishlist.users')->with($data);
        }else{
            // Send data to view
            return view('account.wishlist.index')->with($data);
        }
    }

    // Searchs
    public function searchs(Request $request, $locale = 'hy'){
        // Get middleware data
        $data = $request->data;

        // Get wished searchs
        $posts = WishlistSearch::with(['post'])->where('user_id', Auth::user()->id)->paginate($this->pagination_items_count);

        // Push data
        $data['posts'] = $posts;
        $data['page_name_account_aside'] = 'wishlist';

        // Chek request type
        if($request->ajax()){ // Axios request
            // Send data to view
            return view('account.wishlist.searchs')->with($data);
        }else{
            // Send data to view
            return view('account.wishlist.index')->with($data);
        }
    }
}
