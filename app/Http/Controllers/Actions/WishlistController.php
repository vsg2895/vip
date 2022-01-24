<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\WishlistPost;
use App\WishlistUser;
use App\WishlistSearch;

class WishlistController extends Controller
{
    // Posts function
    public function index(Request $request, $locale = 'hy', $post_id){
        // Validation 
        if(!isset($post_id) || $post_id == NULL || !Auth::check()){
            // Error response
            echo 0; exit;
        }

        // Get data 
        $item = WishlistPost::where(['post_id' => $post_id, 'user_id' => Auth::user()->id])->first();

        // Check data
        if($item != null){ // Already exist this post in this user wishlist
            // Remove from wishlist
            $item->delete();

            // Success response deleted
            echo 2; exit;
        }else{ // Not exists yest
            // Make data
            $wishlist = new WishlistPost;
            $wishlist->user_id = Auth::user()->id;
            $wishlist->post_id = $post_id;

            // Save data
            $wishlist->save();

            // Success response added
            echo 1; exit;
        }
    }

    // Searchs function
    public function searchs(Request $request, $locale = 'hy', $post_id){
        // Validation 
        if(!isset($post_id) || $post_id == NULL || !Auth::check()){
            // Error response
            echo 0; exit;
        }

        // Get data 
        $item = WishlistSearch::where(['post_id' => $post_id, 'user_id' => Auth::user()->id])->first();

        // Check data
        if($item != null){ // Already exist this post in this user wishlist
            // Remove from wishlist
            $item->delete();

            // Success response deleted
            echo 1; exit;
        }
    }

    // Users function
    public function users(Request $request, $locale = 'hy', $user_id){
        // Validation 
        if(!isset($user_id) || $user_id == NULL || !Auth::check()){
            // Error response
            echo 0; exit;
        }

        // Get data 
        $item = WishlistUser::where(['user_id' => $user_id, 'wished_user_id' => Auth::user()->id])->first();

        // Check data
        if($item != null){ // Already exist this user in this user wishlist
            // Remove from wishlist
            $item->delete();

            // Success response deleted
            echo 1; exit;
        }
    }
}
