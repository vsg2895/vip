<?php

namespace App\Http\Controllers;

use App\Ad;
use App\FilterInputOption;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Slider;
use App\SparePartModel;
use App\SparePart;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    // Make this page function
    public function index(Request $request)
    {
        // Get middleware data
        $data = $request->data;
        // Check data
//        if (Session::has('my_previous') && Session::get('my_previous') != "" && !is_null(Session::get('my_previous'))) {
//            if (Session::get('my_previous') == "create-post-level-3" || Session::get('my_previous') == "create-post-level-3-spare") {
//                // Loop from input sessions
//                foreach (array_keys(Session::all()) as $key) {
//                    // Check input key
//                    if (strpos($key, 'add_post_') !== false || strpos($key, 'error_') !== false || strpos($key, 'my_') !== false) {
//                        // Unset this session
//                        Session::pull($key);
//                    }
//                }
//                return redirect()->route('home', app()->getLocale());
//            }
//        }
        // Get slider data
        $slider_items = Slider::orderBy('position_id', 'desc')->limit(6)->get();

        // Get top cateories
        $top_categories = Category::where('top', 1)->orWhere('root',2)->get();

        // Check top category data
        if (count($top_categories) == 0) { // Result not found
            // Get random categories
            $top_categories = Category::where('parent_id', 0)->inRandomOrder()->limit(10)->get();
        }

        // Get top posts data
        $top_posts = Post::where(['primary' => 1, 'active' => 1])->with('wishlist')->orderBy('updates', 'desc')->limit(60)->get();
//        @dd($top_posts);
        $top_posts_all = Post::where(['primary' => 1, 'active' => 1])->with('wishlist')->orderBy('updates', 'desc')->get();
        // Check primary posts data
        if (count($top_posts) == 0) { // Result not found

            // Get top posts when primary is empty
            $top_posts = Post::where(['top' => 1, 'active' => 1])->with('wishlist')->orderBy('updates', 'desc')->limit(60)->get();
            $top_posts_all = Post::where(['top' => 1, 'active' => 1])->with('wishlist')->orderBy('updates', 'desc')->get();

        }
        // Get hurry posts data
        $hurry_posts = Post::where(['hurry' => 1, 'active' => 1])->with('wishlist')->orderBy('updates', 'desc')->limit(20)->get();
        $hurry_posts_all = Post::where(['hurry' => 1, 'active' => 1])->with('wishlist')->orderBy('updates', 'desc')->get();

        // Get services data
        $services = Post::where(['has_services' => 1, 'active' => 1])->with('wishlist')->orderBy('updates', 'desc')->limit(20)->get();
        $services_all = Post::where(['has_services' => 1, 'active' => 1])->with('wishlist')->orderBy('updates', 'desc')->get();

        // Get posts data
        $posts = Post::where(['active' => 1])->with('wishlist')->orderBy('updates', 'desc')->limit(20)->get();
        $posts_all = Post::where(['active' => 1])->with('wishlist')->orderBy('updates', 'desc')->get();
//        My added
        $sidebar_ads = Ad::where('type', 'list_sidebar')->orderBy('updated_at', 'desc')->limit(8)->get();
// end my added
        $spares = SparePartModel::all();

        // Push data
        $data['slider_items'] = $slider_items;
        $data['top_categories'] = $top_categories;
        $data['top_posts_all'] = $top_posts_all;
        $data['hurry_posts_all'] = $hurry_posts_all;
        $data['services_all'] = $services_all;
        $data['posts_all'] = $posts_all;
        $data['top_posts'] = $top_posts;
        $data['services'] = $services;
        $data['hurry_posts'] = $hurry_posts;
        $data['posts'] = $posts;
        $data['spares'] = $spares;
// my added
        $data['sidebar_ads'] = $sidebar_ads;

//  end my added
        // Send data to view
//        dd($data);
        return view('pages.home')->with($data);
    }

    public function spare_parts_index(Request $request, $locale, $id)
    {
        $spares_original = SparePart::with(['location'])->where('model_id', $id)->get();

        return response()->json($spares_original)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET');
    }

}
