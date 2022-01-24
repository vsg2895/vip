<?php

namespace App\Http\Controllers;

use App\FilterInputOption;
use App\SparePartModel;
use App\SparePartModelType;
use App\SparePartsStore;
use Illuminate\Http\Request;
use App\Post;
use App\Ad;
use App\Category;
use App\FilterInput;
use App\FilterSpecial;
use App\Location;
use App\PostOption;
use Illuminate\Database\Eloquent\Builder;
use function GuzzleHttp\Promise\all;

class ItemController extends Controller
{
    // Pagination items count
    protected $pagination_items_count = 10;

    // Make this page function
    public function index(Request $request, $locale = 'hy', $id = NULL)
    {
        // Check session
        if ($request->session()->has('filter_category_id')) {
            // Remove session
            $request->session()->forget('filter_category_id');
        }

        // Check session
        if ($request->session()->has('filter_min_price')) {
            // Remove session
            $request->session()->forget('filter_min_price');
        }

        // Check session
        if ($request->session()->has('filter_max_price')) {
            // Remove session
            $request->session()->forget('filter_max_price');
        }

        // Check session
        if ($request->session()->has('filter_location')) {
            // Remove session
            $request->session()->forget('filter_location');
        }

        // Check session
        if ($request->session()->has('filter_post_type')) {
            // Remove session
            $request->session()->forget('filter_post_type');
        }

        // Check session
        if ($request->session()->has('filter_auth_type')) {
            // Remove session
            $request->session()->forget('filter_auth_type');
        }

        // Save session checnges
        $request->session()->save();

        // Check list or detail/
        if ($id == NULL) { // Axios request
            // Check request
            if ($request->ajax()) { // Axios request
                // Get middleware data
                $data = $request->data;

                // Get categroy items data
                $posts = Post::with('wishlist')->where(['top' => 0, 'active' => 1])->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);

                // Push data
                $data['posts'] = $posts;

                // Send data to view
                return view('items.list.content.load-data')->with($data);
            } else { // Get request
                // Get middleware data
                $data = $request->data;

                // Get categroy top items data
                $top_posts = Post::with('wishlist')->where(['top' => 1, 'active' => 1])->orderBy('updated_at', 'desc')->get();

                // Get categroy items data
                $posts = Post::with('wishlist')->where(['top' => 0, 'active' => 1])->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);

                if ($top_posts == null) {
                    $top_posts = SparePartsStore::with('wishlist')->where(['top' => 1, 'active' => 1])->orderBy('updated_at', 'desc')->get();
                }
                if ($posts == null) {
                    $top_posts = SparePartsStore::with('wishlist')->where(['top' => 0, 'active' => 1])->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);;
                }

                // Get sidebar ads data
                $sidebar_ads = Ad::where('type', 'list_sidebar')->orderBy('updated_at', 'desc')->limit(8)->get();

                // Get header ad data
                $header_ad = Ad::where('type', 'list_haedaer')->first();

                // Make breadcrumbs data
                $breadcrumbs = array('home', translating('items'));

                // Get locatioon data
                $locations = Location::orderBy('title_' . app()->getLocale(), 'desc')->get();

                // Push data
                $data['top_posts'] = $top_posts;
                $data['posts'] = $posts;
                $data['sidebar_ads'] = $sidebar_ads;
                $data['header_ad'] = $header_ad;
                $data['has_menu'] = true;
                $data['has_pagination'] = true;
                $data['breadcrumbs'] = $breadcrumbs;
                $data['locations'] = $locations;

                // Send data to view
                return view('items.list.index')->with($data);
            }
        } else { // Detail page
            // Check session
            if ($request->session()->has('filter_category_id')) {
                // Remove session
                $request->session()->forget('filter_category_id');
            }

            // Check session
            if ($request->session()->has('filter_min_price')) {
                // Remove session
                $request->session()->forget('filter_min_price');
            }

            // Check session
            if ($request->session()->has('filter_max_price')) {
                // Remove session
                $request->session()->forget('filter_max_price');
            }

            // Check session
            if ($request->session()->has('filter_location')) {
                // Remove session
                $request->session()->forget('filter_location');
            }

            // Check session
            if ($request->session()->has('filter_post_type')) {
                // Remove session
                $request->session()->forget('filter_post_type');
            }

            // Check session
            if ($request->session()->has('filter_auth_type')) {
                // Remove session
                $request->session()->forget('filter_auth_type');
            }

            // Get middleware data
            $data = $request->data;

            // Get posts data
            $post = Post::with([
                'wishlist',
                'user' => function ($query) {
                    $query->with([
                        'phone_number' => function ($query) {
                            $query->with([
                                'phone_country',
                                'viber_country',
                                'whatsapp_country',
                                'telegram_country',
                            ]);
                        },
                        'country',
                    ]);
                },
                'location',
                'option' => function ($query) {
                    $query->with([
                        'option' => function ($query) {
                            $query->with('unit');
                        },
                    ]);
                },
                'image',
            ])->find($id);

            if (is_null($post)) {

                $post = SparePartsStore::with([
                    'wishlist',
                    'user' => function ($query) {
                        $query->with([
                            'phone_number' => function ($query) {
                                $query->with([
                                    'phone_country',
                                    'viber_country',
                                    'whatsapp_country',
                                    'telegram_country',
                                ]);
                            },
                            'country',
                        ]);
                    },
                    'location',
                ])->find($id);

            }
//            dd($post);
            // Check active
            if (isset($post) && $post->active != 1) {
                // Redirect to home
                return redirect()->route('home', ['locale' => app()->getLocale()]);
            }

            // Check post
            if (isset($post->category_id) && $post->category_id != null) {
                // Get recomendeds posts
                $recomendeds = Post::with([
                    'wishlist',
                ])->where('category_id', $post->category_id)->where('id', '!=', $id)->where('active', 1)->orderBy('updated_at', 'desc')->limit(3)->get(['title', 'price', 'currency_id', 'code', 'img', 'id']);
                if (count($recomendeds) == 0) {
                    $recomendeds = Post::with([
                        'wishlist',
                    ])->where('category_id', $post->category_id)->where('id', '!=', $id)->where('active', 1)->orderBy('updated_at', 'desc')->limit(3)->get(['title', 'code', 'img', 'id']);

                }

//                dd($parents_ids);
            } else {
                // Not exists
                $recomendeds = NULL;
            }

            // Get Ads data

            $parents_ids = [];
            $parents_ids = getParents($post->category_id, $parents_ids);
//            dd($parents_ids);
            $ads = Ad::where('type', 'detail')->whereIn('category_id', $parents_ids)->orderBy('updated_at', 'desc')->limit(2)->get();
            if (count($ads) == 0 || $ads == null) {
                $ads = Ad::where('type', 'detail')->orderBy('updated_at', 'desc')->limit(2)->get();

            }
            // Make breadcrumbs data
            $breadcrumbs = array('home', 'items', $post->title);

            // Push data
            $data['post'] = $post;
            $data['recomendeds'] = $recomendeds;
            $data['ads'] = $ads;
            $data['has_menu'] = true;
            $data['breadcrumbs'] = $breadcrumbs;
//dd($post->user);
            // Send data to view
            return view('items.detail.index')->with($data);
        }
    }

    // Services page
    function services(Request $request, $locale = 'hy')
    {
        // Check session
        if ($request->session()->has('filter_category_id')) {
            // Remove session
            $request->session()->forget('filter_category_id');
        }

        // Check session
        if ($request->session()->has('filter_min_price')) {
            // Remove session
            $request->session()->forget('filter_min_price');
        }

        // Check session
        if ($request->session()->has('filter_max_price')) {
            // Remove session
            $request->session()->forget('filter_max_price');
        }

        // Check session
        if ($request->session()->has('filter_location')) {
            // Remove session
            $request->session()->forget('filter_location');
        }

        // Check session
        if ($request->session()->has('filter_post_type')) {
            // Remove session
            $request->session()->forget('filter_post_type');
        }

        // Check session
        if ($request->session()->has('filter_auth_type')) {
            // Remove session
            $request->session()->forget('filter_auth_type');
        }

        // Check request
        if ($request->ajax()) { // Axios request
            // Get middleware data
            $data = $request->data;

            // Get categroy items data
            $posts = Post::with('wishlist')->where(['has_services' => 1, 'active' => 1])->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);

            // Push data
            $data['posts'] = $posts;

            // Send data to view
            return view('items.list.content.load-data')->with($data);
        } else { // Get request
            // Get middleware data
            $data = $request->data;

            // Get categroy top items data
//            $top_posts = Post::with('wishlist')->where(['has_services' => 1, 'top' => 1, 'active' => 1])->orderBy('updated_at', 'desc')->get();

            // Get categroy items data
            $posts = Post::with('wishlist')->where(['has_services' => 1, 'active' => 1])->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);

            // Get sidebar ads data
            $sidebar_ads = Ad::where('type', 'list_sidebar')->orderBy('updated_at', 'desc')->limit(8)->get();

            // Get header ad data
            $header_ad = Ad::where('type', 'list_haedaer')->first();

            // Make breadcrumbs data
            $breadcrumbs = array('home', translating('items'));

            // Get locatioon data
            $locations = Location::orderBy('title_' . app()->getLocale(), 'desc')->get();
            $page_name = translating('home-section-services-title');
            // Push data
            $data['posts'] = $posts;
            $data['page_name'] = $page_name;
            $data['sidebar_ads'] = $sidebar_ads;
            $data['header_ad'] = $header_ad;
            $data['has_menu'] = true;
            $data['has_pagination'] = true;
            $data['breadcrumbs'] = $breadcrumbs;
            $data['locations'] = $locations;

            // Send data to view
            return view('items.list.more-page')->with($data);
        }
    }

    // Primary page
    function primary(Request $request, $locale = 'hy')
    {
        // Check session
        if ($request->session()->has('filter_category_id')) {
            // Remove session
            $request->session()->forget('filter_category_id');
        }

        // Check session
        if ($request->session()->has('filter_min_price')) {
            // Remove session
            $request->session()->forget('filter_min_price');
        }

        // Check session
        if ($request->session()->has('filter_max_price')) {
            // Remove session
            $request->session()->forget('filter_max_price');
        }

        // Check session
        if ($request->session()->has('filter_location')) {
            // Remove session
            $request->session()->forget('filter_location');
        }

        // Check session
        if ($request->session()->has('filter_post_type')) {
            // Remove session
            $request->session()->forget('filter_post_type');
        }

        // Check session
        if ($request->session()->has('filter_auth_type')) {
            // Remove session
            $request->session()->forget('filter_auth_type');
        }

        // Check request
        if ($request->ajax()) { // Axios request
            // Get middleware data
            $data = $request->data;

            // Get categroy items data
            $posts = Post::with('wishlist')->where(['primary' => 1, 'active' => 1])->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);

            // Push data
            $data['posts'] = $posts;

            // Send data to view
            return view('items.list.content.load-data')->with($data);
        } else { // Get request
            // Get middleware data
            $data = $request->data;

            // Get categroy items data
            $posts = Post::with('wishlist')->where(['primary' => 1, 'active' => 1])->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);

            // Get sidebar ads data
            $sidebar_ads = Ad::where('type', 'list_sidebar')->orderBy('updated_at', 'desc')->limit(8)->get();

            // Get header ad data
            $header_ad = Ad::where('type', 'list_haedaer')->first();

            // Make breadcrumbs data
            $breadcrumbs = array('home', translating('items'));

            // Get locatioon data
            $locations = Location::orderBy('title_' . app()->getLocale(), 'desc')->get();
            $page_name = translating('home-section-main-posts-title');
            // Push data
            $data['posts'] = $posts;
            $data['sidebar_ads'] = $sidebar_ads;
            $data['page_name'] = $page_name;
            $data['header_ad'] = $header_ad;
            $data['has_menu'] = true;
            $data['has_pagination'] = true;
            $data['breadcrumbs'] = $breadcrumbs;
            $data['locations'] = $locations;

            // Send data to view
            return view('items.list.more-page')->with($data);
        }
    }

    // Hurry page
    function hurry(Request $request, $locale = 'hy')
    {
        // Check session
        if ($request->session()->has('filter_category_id')) {
            // Remove session
            $request->session()->forget('filter_category_id');
        }

        // Check session
        if ($request->session()->has('filter_min_price')) {
            // Remove session
            $request->session()->forget('filter_min_price');
        }

        // Check session
        if ($request->session()->has('filter_max_price')) {
            // Remove session
            $request->session()->forget('filter_max_price');
        }

        // Check session
        if ($request->session()->has('filter_location')) {
            // Remove session
            $request->session()->forget('filter_location');
        }

        // Check session
        if ($request->session()->has('filter_post_type')) {
            // Remove session
            $request->session()->forget('filter_post_type');
        }

        // Check session
        if ($request->session()->has('filter_auth_type')) {
            // Remove session
            $request->session()->forget('filter_auth_type');
        }

        // Check request
        if ($request->ajax()) { // Axios request
            // Get middleware data
            $data = $request->data;

            // Get categroy items data
            $posts = Post::with('wishlist')->where(['hurry' => 1, 'active' => 1])->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);

            // Push data
            $data['posts'] = $posts;

            // Send data to view
            return view('items.list.content.load-data')->with($data);
        } else { // Get request
            // Get middleware data
            $data = $request->data;

            // Get categroy items data
            $posts = Post::with('wishlist')->where(['hurry' => 1, 'active' => 1])->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);

            // Get sidebar ads data
            $sidebar_ads = Ad::where('type', 'list_sidebar')->orderBy('updated_at', 'desc')->limit(8)->get();

            // Get header ad data
            $header_ad = Ad::where('type', 'list_haedaer')->first();

            // Make breadcrumbs data
            $breadcrumbs = array('home', translating('items'));

            // Get locatioon data
            $locations = Location::orderBy('title_' . app()->getLocale(), 'desc')->get();
            $page_name = translating('home-section-hurry-posts-title');
            // Push data
            $data['posts'] = $posts;
            $data['page_name'] = $page_name;
            $data['sidebar_ads'] = $sidebar_ads;
            $data['header_ad'] = $header_ad;
            $data['has_menu'] = true;
            $data['has_pagination'] = true;
            $data['breadcrumbs'] = $breadcrumbs;
            $data['locations'] = $locations;

            // Send data to view
            return view('items.list.more-page')->with($data);
        }
    }

//    Home all items
    function posts(Request $request, $locale = 'hy')
    {
        // Check session
        if ($request->session()->has('filter_category_id')) {
            // Remove session
            $request->session()->forget('filter_category_id');
        }

        // Check session
        if ($request->session()->has('filter_min_price')) {
            // Remove session
            $request->session()->forget('filter_min_price');
        }

        // Check session
        if ($request->session()->has('filter_max_price')) {
            // Remove session
            $request->session()->forget('filter_max_price');
        }

        // Check session
        if ($request->session()->has('filter_location')) {
            // Remove session
            $request->session()->forget('filter_location');
        }

        // Check session
        if ($request->session()->has('filter_post_type')) {
            // Remove session
            $request->session()->forget('filter_post_type');
        }

        // Check session
        if ($request->session()->has('filter_auth_type')) {
            // Remove session
            $request->session()->forget('filter_auth_type');
        }

        // Check request
        if ($request->ajax()) { // Axios request
            // Get middleware data
            $data = $request->data;

            // Get categroy items data
            $posts = Post::with('wishlist')->where(['active' => 1])->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);

            // Push data
            $data['posts'] = $posts;

            // Send data to view
            return view('items.list.content.load-data')->with($data);
        } else { // Get request
            // Get middleware data
            $data = $request->data;
//dd('jfhjhdfjhdf');
            // Get categroy items data
            $posts = Post::with('wishlist')->where(['active' => 1])->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);

            // Get sidebar ads data
            $sidebar_ads = Ad::where('type', 'list_sidebar')->orderBy('updated_at', 'desc')->limit(8)->get();

            // Get header ad data
            $header_ad = Ad::where('type', 'list_haedaer')->first();

            // Make breadcrumbs data
            $breadcrumbs = array('home', translating('items'));

            // Get locatioon data
            $locations = Location::orderBy('title_' . app()->getLocale(), 'desc')->get();
            $page_name = translating('home-section-posts-title');
            // Push data
            $data['posts'] = $posts;
            $data['page_name'] = $page_name;
            $data['sidebar_ads'] = $sidebar_ads;
            $data['header_ad'] = $header_ad;
            $data['has_menu'] = true;
            $data['has_pagination'] = true;
            $data['breadcrumbs'] = $breadcrumbs;
            $data['locations'] = $locations;

            // Send data to view
            return view('items.list.more-page')->with($data);
        }
    }

    function top(Request $request, $locale = 'hy')
    {
        // Check session
        if ($request->session()->has('filter_category_id')) {
            // Remove session
            $request->session()->forget('filter_category_id');
        }

        // Check session
        if ($request->session()->has('filter_min_price')) {
            // Remove session
            $request->session()->forget('filter_min_price');
        }

        // Check session
        if ($request->session()->has('filter_max_price')) {
            // Remove session
            $request->session()->forget('filter_max_price');
        }

        // Check session
        if ($request->session()->has('filter_location')) {
            // Remove session
            $request->session()->forget('filter_location');
        }

        // Check session
        if ($request->session()->has('filter_post_type')) {
            // Remove session
            $request->session()->forget('filter_post_type');
        }

        // Check session
        if ($request->session()->has('filter_auth_type')) {
            // Remove session
            $request->session()->forget('filter_auth_type');
        }

        // Check request
        if ($request->ajax()) { // Axios request
            // Get middleware data
            $data = $request->data;

            // Get categroy items data
            $posts = Post::with('wishlist')->where(['primary' => 1, 'active' => 1])->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);

            // Push data
            $data['posts'] = $posts;

            // Send data to view
            return view('items.list.content.load-data')->with($data);
        } else { // Get request
            // Get middleware data
            $data = $request->data;

            // Get categroy items data
            $posts = Post::with('wishlist')->where(['top' => 1, 'active' => 1])->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);

            // Get sidebar ads data
            $sidebar_ads = Ad::where('type', 'list_sidebar')->orderBy('updated_at', 'desc')->limit(8)->get();

            // Get header ad data
            $header_ad = Ad::where('type', 'list_haedaer')->first();

            // Make breadcrumbs data
            $breadcrumbs = array('home', translating('items'));

            // Get locatioon data
            $locations = Location::orderBy('title_' . app()->getLocale(), 'desc')->get();

            // Push data
            $data['posts'] = $posts;

            $data['sidebar_ads'] = $sidebar_ads;
            $data['header_ad'] = $header_ad;
            $data['has_menu'] = true;
            $data['has_pagination'] = true;
            $data['breadcrumbs'] = $breadcrumbs;
            $data['locations'] = $locations;

            // Send data to view
            return view('items.list.more-page')->with($data);
        }
    }


    // Category page
    function category(Request $request, $locale = 'hy', $id)
    {
        // Set or put category id session

//        dd($id);
        $request->session()->put('filter_category_id', $id);

//        dd($request->session()->all());
        // Check session
        if ($request->session()->has('filter_min_price')) {
            // Remove session
            $request->session()->forget('filter_min_price');
        }

        // Check session
        if ($request->session()->has('filter_max_price')) {
            // Remove session
            $request->session()->forget('filter_max_price');
        }

        // Check session
        if ($request->session()->has('filter_location')) {
            // Remove session
            $request->session()->forget('filter_location');
        }

        // Check session
        if ($request->session()->has('filter_post_type')) {
            // Remove session
            $request->session()->forget('filter_post_type');
        }
        if ($request->session()->has('filtr_post_spare_brand')) {
            // Remove session
            $request->session()->forget('filtr_post_spare_brand');
        }

        if ($request->session()->has('filtr_post_spare_model')) {
            // Remove session
            $request->session()->forget('filtr_post_spare_model');
        }

        if ($request->session()->has('filter_min_year')) {
            // Remove session
            $request->session()->forget('filter_min_year');
        }
        if ($request->session()->has('filter_max_year')) {
            // Remove session
            $request->session()->forget('filter_max_year');
        }

        // Check session

        if ($request->session()->has('filter_auth_type')) {
            // Remove session
            $request->session()->forget('filter_auth_type');
//            dd($request->session('filter_auth_type'));
        }
        if ($request->session()->has('filter_post_estate_type')) {
            // Remove session
            $request->session()->forget('filter_post_estate_type');
        }
        if ($request->session()->has('filter_post_elec_type')) {
            // Remove session
            $request->session()->forget('filter_post_elec_type');
        }

        foreach ($request->session()->all() as $key => $session_item) {
            if (strpos($key, 'saved_input_') !== false) {
                $request->session()->forget($key);
            }
        }
        $auto_categorie = Category::where('id', 1)->first();
        $transport_sub_cat = getCategoryChildren(1)->pluck('id');
        $real_estate_sub_cat = getCategoryChildren(2)->pluck('id');
        $electronics_sub_cat = getCategoryChildren(3)->pluck('id');
        $spare_store_sub_cat = getCategoryChildren(78)->pluck('id');
        $transport_sub_cat_ids = [];
        $real_estate_sub_cat_ids = [];
        $elektronics_sub_cat_ids = [];
        $spare_store_cat_ids = [];

        foreach ($spare_store_sub_cat as $v) {

            array_push($spare_store_cat_ids, $v);
        }
        foreach ($electronics_sub_cat as $v) {

            array_push($elektronics_sub_cat_ids, $v);
        }
        foreach ($real_estate_sub_cat as $v) {

            array_push($real_estate_sub_cat_ids, $v);
        }
        foreach ($transport_sub_cat as $v) {

            array_push($transport_sub_cat_ids, $v);
        }

//        dd($transport_sub_cat);
        // Check request
        if ($request->ajax()) { // Axios request

            // Get middleware data
            $data = $request->data;

            // Get category data
            $category = Category::with([
                'special',
                'input',
            ])->findOrFail($id);

            // Get this category sub items
            $sub_items = Category::where('parent_id', $category->id)->get('id');
            $auto_brands = FilterInputOption::where('filter_input_id', 1)->get();
            // Make empty array
            $sub_array = array();

            // Loop from array
            foreach ($sub_items as $sub_item) {
                // Push data
                array_push($sub_array, $sub_item->id);
            }

            // Get categroy items data

            $posts = Post::with('wishlist')->where(['category_id' => $id, 'top' => 0, 'active' => 1])->orWhereIn('category_id', $sub_array)->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);

            // Push data
            $data['posts'] = $posts;

            // Send data to view
            return view('items.list.content.load-data')->with($data);
        } else { // Get request
            // Get middleware data
            $data = $request->data;

            // Get category data
            $category = Category::with([
                'special',
                'input',
            ])->findOrFail($id);
//             dd($category);
            if ($category->root == 2) {
                return redirect()->route('services', ['locale' => app()->getLocale()]);
            }
            // Get this category sub items
            $sub_categories = Category::where('parent_id', $category->id)->get();
            $sub_items = Category::where('parent_id', $category->id)->get('id');

            // Make empty array
            $sub_array = array();

            // Loop from array
            foreach ($sub_items as $sub_item) {
                // Push data
                array_push($sub_array, $sub_item->id);
            }

            // Push array main category
            array_push($sub_array, $id);

//dd($category);
//            dd($category->spare_store);
            if (isset($sub_categories[0]) && !is_null($sub_categories[0]->spare_store)) {

                $top_posts = SparePartsStore::where(['primary' => 1, 'active' => 1])->whereIn('category_id', $sub_array)->inRandomOrder()->get();
                $posts = SparePartsStore::where(['active' => 1])->WhereIn('category_id', $sub_array)->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);

            } else {
                if (!is_null($category->spare_store)) {
//                    dd($category->spare_store);
                    if ($category->spare_store == '0') {
                        $top_posts = SparePartsStore::where(['top' => 1, 'active' => 1, 'type' => 0])->where('category_id', $category->id)->inRandomOrder()->get();
                        $posts = SparePartsStore::where(['active' => 1, 'type' => 0])->where('category_id', $category->id)->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);

                    }
                    if ($category->spare_store == '1') {
                        $top_posts = SparePartsStore::where(['top' => 1, 'active' => 1, 'type' => 1])->where('category_id', $category->id)->inRandomOrder()->get();
                        $posts = SparePartsStore::where(['active' => 1, 'type' => 1])->where('category_id', $category->id)->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);

                    }

                } else {

                    // Get categroy top items data
                    $top_posts = Post::with('wishlist')->where(['top' => 1, 'active' => 1])->whereIn('category_id', $sub_array)->inRandomOrder()->get();
                    // Get categroy items data
                    $posts = Post::with('wishlist')->where(['active' => 1])->WhereIn('category_id', $sub_array)->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);

                }


            }

            // Get sidebar ads data
            $sidebar_ads = Ad::where('type', 'list_sidebar')->orderBy('updated_at', 'desc')->limit(8)->get();

            // Get header ad data
            $header_ad = Ad::where('type', 'list_haedaer')->first();
            $auto_brands = FilterInputOption::where('filter_input_id', 1)->get();
            $default_transport_filter = FilterInput::whereIn('id', [1, 7, 24])->get();
            $spare_models = SparePartModel::all();
            $spare_models_types = SparePartModelType::all();
//            dd($default_transport_filter);
            // Make breadcrumbs data
            $breadcrumbs = array('home', $category['title_' . app()->getLocale()]);

            // Get locatioon data
            $locations = Location::orderBy('title_' . app()->getLocale(), 'desc')->get();

            // Push data
            $data['category'] = $category;
            $data['top_posts'] = $top_posts;
            $data['posts'] = $posts;
            $data['sidebar_ads'] = $sidebar_ads;
            $data['header_ad'] = $header_ad;
            $data['has_menu'] = true;
            $data['has_pagination'] = true;
            $data['breadcrumbs'] = $breadcrumbs;
            $data['locations'] = $locations;
            $data['auto_brands'] = $auto_brands;
            $data['auto_categorie'] = $auto_categorie;
            $data['default_transport_filter'] = $default_transport_filter;
            $data['transport_sub_cat_ids'] = $transport_sub_cat_ids;
            $data['real_estate_sub_cat_ids'] = $real_estate_sub_cat_ids;
            $data['elektronics_sub_cat_ids'] = $elektronics_sub_cat_ids;
            $data['spare_store_cat_ids'] = $spare_store_cat_ids;
            $data['spare_models'] = $spare_models;
            $data['spare_models_types'] = $spare_models_types;


            // Send data to view
            return view('items.list.index')->with($data);
        }
    }

// Global Search

    public function global_search(Request $request, $locale = 'hy')
    {
        $data = $request->data;
        $request->validate([
            'search_value' => 'required',
        ]);
        $array_word = [];
        $search_value = $request->search_value;
        $search_multilang = new \Search_Multilang($search_value, $array_word);
        dd($search_multilang->create_search_words());

        // Get top cateories
        $top_categories = Category::where('top', 1)->orWhere('root', 2)->get();

        // Check top category data
        if (count($top_categories) == 0) { // Result not found
            // Get random categories
            $top_categories = Category::where('parent_id', 0)->inRandomOrder()->limit(10)->get();
        }

        // Get sidebar ads data
        $sidebar_ads = Ad::where('type', 'list_sidebar')->orderBy('updated_at', 'desc')->limit(8)->get();

        // Get header ad data
        $header_ad = Ad::where('type', 'list_haedaer')->first();

        $search_symbol = 'LIKE';
        $search_value = '%' . $search_value . '%';


        // Filtering top post in refresh
        $top_posts = Post::query();
        $top_posts = $top_posts->where('active', 1);
        $top_posts = $top_posts->where('top', 1);
        $top_posts = $top_posts->where('title', $search_symbol, $search_value);
        // Sorting Filtering
        $top_posts = $top_posts->orderBy('updated_at', 'desc');
        $top_posts = $top_posts->get();;

        // Filtering post in refresh
        $posts = Post::query();
        $posts = $posts->where('active', 1);
        $posts = $posts->where('title', $search_symbol, $search_value);
        // Sorting Filtering
        $posts = $posts->orderBy('updated_at', 'desc');
        $posts = $posts->paginate($this->pagination_items_count);


        $data['sidebar_ads'] = $sidebar_ads;
        $data['header_ad'] = $header_ad;
        $data['has_menu'] = true;
        $data['top_categories'] = $top_categories;
        $data['posts'] = $posts;
        $data['top_posts'] = $top_posts;

        // Send data to view
        return view('items.list.index_search')->with($data);


    }


// End Global Search


//    Filtr In spare_store

    public function filter_spare(Request $request, $locale = 'hy', $category_id = NULL, $location = NULL, $min_year = NULL, $max_year = NULL, $brand = NULL, $model = NULL, $search_value = NULL, $request_type = NULL)
    {
        $data = $request->data;

        // Check category
        $default_transport_filter = FilterInput::whereIn('id', [1, 7, 24])->get();
//        dd($default_transport_filter);
        $auto_brands = FilterInputOption::where('filter_input_id', 1)->get();

        $spare_models = SparePartModel::all();
        $spare_models_types = SparePartModelType::all();
        $auto_categorie = Category::where('id', 1)->first();
        $transport_sub_cat = getCategoryChildren(1)->pluck('id');
        $real_estate_sub_cat = getCategoryChildren(2)->pluck('id');
        $electronics_sub_cat = getCategoryChildren(3)->pluck('id');
        $spare_store_sub_cat = getCategoryChildren(78)->pluck('id');
        $transport_sub_cat_ids = [];
        $real_estate_sub_cat_ids = [];
        $elektronics_sub_cat_ids = [];
        $spare_store_cat_ids = [];

        foreach ($spare_store_sub_cat as $v) {

            array_push($spare_store_cat_ids, $v);
        }
        foreach ($electronics_sub_cat as $v) {

            array_push($elektronics_sub_cat_ids, $v);
        }
        foreach ($real_estate_sub_cat as $v) {

            array_push($real_estate_sub_cat_ids, $v);
        }
        foreach ($transport_sub_cat as $v) {

            array_push($transport_sub_cat_ids, $v);
        }

        if ($category_id == 0 || $category_id == NULL) {
            $category_symbol = '>=';
            $category_value = 0;
            $category = NULL;
        } else {
            // Get category data
            $category = Category::with([
                'special',
                'input',
            ])->findOrFail($category_id);

            $category_symbol = '=';
            $category_value = $category_id;
//            dump($category_value);
        }
        if ($category_value != 0 && ($category != NULL && $category->header_position == 8)) {
//            $category_parent = getCat($category_value);
            $sub_items = Category::where('parent_id', $category_value)->get('id');

            // Make empty category id array
            $category_id_arr = array();

            // Loop from array
            foreach ($sub_items as $sub_item) {
                // Push data
                array_push($category_id_arr, (string)$sub_item->id);
            }

//            dd($cat_childs_id);

        }
        if ($location == 'default' || $location == 0 || $location == NULL || empty($location)) {
            $location_symbol = '>=';
            $location_value = 0;
        } else {
            $location_symbol = '=';
            $location_value = $location;
        }

        if ($brand == 'default' || $brand == NULL) {
            $brand_symbol = '>=';
            $brand_value = 'default';
        } else {

            $brand_symbol = '=';
            $brand_value = $brand;
        }

        // Check auth type

        if ($model == 'default' || $model == NULL) {

            $model_symbol = '>=';
            $model_value = 'default';
        } else {
            $model_symbol = '=';
            $model_value = $model;

        }

        // Check min year
        if ($min_year == NULL || $min_year == 0 || empty($min_year) || $min_year == 1990) {
            $min_year_symbol = '>=';
            $min_year_value = 1990;
//            $min_year_value = 'default';
        } else {
            $min_year_symbol = '<=';
            $min_year_value = $min_year;
        }

        // Check max year
        if ($max_year == NULL || $max_year == 0 || empty($max_year) || $max_year == now()->year) {
            $max_year_symbol = '<=';
            $max_year_value = now()->year;
//            $max_year_value = 'default';
        } else {
            $max_year_symbol = '>=';
            $max_year_value = $max_year;
        }

        // Check search value
        if ($search_value == NULL || empty($search_value) || $search_value == 'default') {
            $search_symbol = '!=';
            $search_value = NULL;
        } else {
            $search_symbol = 'LIKE';
            $search_value = '%' . $search_value . '%';
        }

        // Get main items
        $posts = SparePartsStore::query();

        foreach ($request->session()->all() as $key => $session_item) {
            if (strpos($key, 'saved_input_') !== false) {
                $request->session()->forget($key);
            }
        }

        $request->session()->save();

        $posts = $posts->where('active', 1);
        if (!is_null($category->spare_store)) {
            $posts = $posts->where('type', $category->spare_store);
        }
        if ($category->spare_store === 0) {
            if ($min_year_value != 1990) {
                $posts = $posts->whereHas('options', function ($query) use ($model_symbol, $model_value, $brand_symbol, $brand_value, $min_year_symbol, $min_year_value) {
                    $query->where('min_year_spare', $min_year_symbol, $min_year_value);
                    if ($brand_value != "default") {
                        $query->where('brand_spare', $brand_symbol, $brand_value);
                    }
                    if ($model_value != "default") {
                        $query->where('model_spare', $model_symbol, $model_value);
                    }
                });
            }
            if ($max_year_value != now()->year) {
                $posts = $posts->whereHas('options', function ($query) use ($model_symbol, $model_value, $brand_symbol, $brand_value, $max_year_symbol, $max_year_value) {
                    $query->where('max_year_spare', $max_year_symbol, $max_year_value);
                    if ($brand_value != "default") {
                        $query->where('brand_spare', $brand_symbol, $brand_value);
                    }
                    if ($model_value != "default") {
                        $query->where('model_spare', $model_symbol, $model_value);
                    }
                });
            }
        }
        $posts = $posts->where('location_id', $location_symbol, $location_value);
        if ($brand_value != "default") {
            $posts = $posts->whereHas('options', function ($query) use ($brand_symbol, $brand_value) {
                $query->where('brand_spare', $brand_symbol, $brand_value);
            });
//            $posts = $posts->where('brand_spare', $brand_symbol, $brand_value);
        }
        if ($model_value != "default") {
            $posts = $posts->whereHas('options', function ($query) use ($model_symbol, $model_value) {
                $query->where('model_spare', $model_symbol, $model_value);
            });
//            $posts = $posts->where('model_spare', $model_symbol, $model_value);
        }
        if ($search_value != "default" && $search_value != NULL) {
            $posts = $posts->where('title', $search_symbol, $search_value);
        }
        if ($category_value != 0 || $category_value != NULL) {
            if (isset($category_id_arr) && $category_id_arr != NULL) {
                $posts = $posts->whereIn('category_id', $category_id_arr);
            } else {
                $posts = $posts->where('category_id', $category_value);

            }

        }

        // Sorting Filtering
        $posts = $posts->orderBy('updated_at', 'desc');
        $posts = $posts->paginate($this->pagination_items_count);

        $top_posts = SparePartsStore::query();

        // Filtering top post in refresh
        $top_posts = $top_posts->where('active', 1);
        if (!is_null($category->spare_store)) {
            $top_posts = $top_posts->where('type', $category->spare_store);
            $top_posts = $top_posts->where('top', 1);
        } else {
            $top_posts = $top_posts->where('primary', 1);
        }
        if ($category->spare_store === 0) {
            if ($min_year_value != 1990) {
                $top_posts = $top_posts->whereHas('options', function ($query) use ($model_symbol, $model_value, $brand_symbol, $brand_value, $min_year_symbol, $min_year_value) {
                    $query->where('min_year_spare', $min_year_symbol, $min_year_value);
                    if ($brand_value != "default") {
                        $query->where('brand_spare', $brand_symbol, $brand_value);
                    }
                    if ($model_value != "default") {
                        $query->where('model_spare', $model_symbol, $model_value);
                    }
                });
            }
            if ($max_year_value != now()->year) {
                $top_posts = $top_posts->whereHas('options', function ($query) use ($model_symbol, $model_value, $brand_symbol, $brand_value, $max_year_symbol, $max_year_value) {
                    $query->where('max_year_spare', $max_year_symbol, $max_year_value);
                    if ($brand_value != "default") {
                        $query->where('brand_spare', $brand_symbol, $brand_value);
                    }
                    if ($model_value != "default") {
                        $query->where('model_spare', $model_symbol, $model_value);
                    }
                });
            }
        }
        $top_posts = $top_posts->where('location_id', $location_symbol, $location_value);
        if ($brand_value != "default") {
            $top_posts = $top_posts->whereHas('options', function ($query) use ($brand_symbol, $brand_value) {
                $query->where('brand_spare', $brand_symbol, $brand_value);
            });
//            $top_posts = $top_posts->where('brand_spare', $brand_symbol, $brand_value);
        }
        if ($model_value != "default") {
            $top_posts = $top_posts->whereHas('options', function ($query) use ($model_symbol, $model_value) {
                $query->where('model_spare', $model_symbol, $model_value);
            });
//            $top_posts = $top_posts->where('model_spare', $model_symbol, $model_value);
        }
        if ($search_value != "default" && $search_value != NULL) {
            $top_posts = $top_posts->where('title', $search_symbol, $search_value);
        }
        if ($category_value != 0 || $category_value != NULL) {

            if (isset($category_id_arr) && $category_id_arr != NULL) {
                $top_posts = $top_posts->whereIn('category_id', $category_id_arr);
            } else {
                $top_posts = $top_posts->where('category_id', $category_value);

            }

        }
        // Check data

        // Sorting Filtering
        $top_posts = $top_posts->inRandomOrder();
        $top_posts = $top_posts->get();
        // Put sessions
        $request->session()->put('filter_category_id', $category_value);
        $request->session()->put('filter_min_year', $min_year_value);
        $request->session()->put('filter_max_year', $max_year_value);
        $request->session()->put('filter_location', $location_value);
        $request->session()->put('filtr_post_spare_brand', $brand_value);
        $request->session()->put('filtr_post_spare_model', $model_value);
        $request->session()->save();

        // Get sidebar ads data
        $sidebar_ads = Ad::where('type', 'list_sidebar')->orderBy('updated_at', 'desc')->limit(8)->get();
        // Get header ad data
        $header_ad = Ad::where('type', 'list_haedaer')->first();
        // Get locatioon data
        $locations = Location::orderBy('title_' . app()->getLocale(), 'desc')->get();
        // Push data
        $data['category'] = $category;
        $data['posts'] = $posts;
        $data['top_posts'] = $top_posts;
        $data['sidebar_ads'] = $sidebar_ads;
        $data['header_ad'] = $header_ad;
        $data['locations'] = $locations;
        $data['auto_brands'] = $auto_brands;
        $data['auto_categorie'] = $auto_categorie;
        $data['default_transport_filter'] = $default_transport_filter;
        $data['transport_sub_cat_ids'] = $transport_sub_cat_ids;
        $data['real_estate_sub_cat_ids'] = $real_estate_sub_cat_ids;
        $data['elektronics_sub_cat_ids'] = $elektronics_sub_cat_ids;
        $data['spare_store_cat_ids'] = $spare_store_cat_ids;
        $data['spare_models'] = $spare_models;
        $data['spare_models_types'] = $spare_models_types;


        // Check request type
        if ($request->ajax()) { // Axios request
            // Send data to view

            if ($request_type == NULL || $request_type == 'submit') {
                // Get top items
                $top_posts = SparePartsStore::query();
                // Filtering top post in refresh
                $top_posts = $top_posts->where('active', 1);
                if (!is_null($category->spare_store)) {
                    $top_posts = $top_posts->where('type', $category->spare_store);
                    $top_posts = $top_posts->where('top', 1);

                } else {
                    $top_posts = $top_posts->where('primary', 1);

                }
                if ($category->spare_store === 0) {
                    if ($min_year_value != 1990) {
                        $top_posts = $top_posts->whereHas('options', function ($query) use ($model_symbol, $model_value, $brand_symbol, $brand_value, $min_year_symbol, $min_year_value) {
                            $query->where('min_year_spare', $min_year_symbol, $min_year_value);
                            if ($brand_value != "default") {
                                $query->where('brand_spare', $brand_symbol, $brand_value);
                            }
                            if ($model_value != "default") {
                                $query->where('model_spare', $model_symbol, $model_value);
                            }
                        });
                    }
                    if ($max_year_value != now()->year) {
                        $top_posts = $top_posts->whereHas('options', function ($query) use ($model_symbol, $model_value, $brand_symbol, $brand_value, $max_year_symbol, $max_year_value) {
                            $query->where('max_year_spare', $max_year_symbol, $max_year_value);
                            if ($brand_value != "default") {
                                $query->where('brand_spare', $brand_symbol, $brand_value);
                            }
                            if ($model_value != "default") {
                                $query->where('model_spare', $model_symbol, $model_value);
                            }
                        });
                    }

                }
                $top_posts = $top_posts->where('location_id', $location_symbol, $location_value);

                if ($brand_value != "default") {
                    $top_posts = $top_posts->whereHas('options', function ($query) use ($brand_symbol, $brand_value) {
                        $query->where('brand_spare', $brand_symbol, $brand_value);
                    });
//                    $top_posts = $top_posts->where('brand_spare', $brand_symbol, $brand_value);
                }
                if ($model_value != "default") {
                    $top_posts = $top_posts->whereHas('options', function ($query) use ($model_symbol, $model_value) {
                        $query->where('model_spare', $model_symbol, $model_value);
                    });
//                    $top_posts = $top_posts->where('model_spare', $model_symbol, $model_value);
                }
                if ($search_value != "default" && $search_value != NULL) {

                    $top_posts = $top_posts->where('title', $search_symbol, $search_value);
                }
                if ($category_value != 0 || $category_value != NULL) {

                    if (isset($category_id_arr) && $category_id_arr != NULL) {

                        $top_posts = $top_posts->whereIn('category_id', $category_id_arr);
                    } else {
                        $top_posts = $top_posts->where('category_id', $category_value);

                    }

                }
                // Check data

                // Sorting Filtering
                $top_posts = $top_posts->inRandomOrder();
                $top_posts = $top_posts->get();
                // Push data
                $data['top_posts'] = $top_posts;


                $posts = SparePartsStore::query();
                $posts = $posts->where('active', 1);
                if (!is_null($category->spare_store)) {
                    $posts = $posts->where('type', $category->spare_store);
                }
                if ($category->spare_store === 0) {

                    if ($min_year_value != 1990) {
                        $posts = $posts->whereHas('options', function ($query) use ($model_symbol, $model_value, $brand_symbol, $brand_value, $min_year_symbol, $min_year_value) {
                            $query->where('min_year_spare', $min_year_symbol, $min_year_value);
                            if ($brand_value != "default") {
                                $query->where('brand_spare', $brand_symbol, $brand_value);
                            }
                            if ($model_value != "default") {
                                $query->where('model_spare', $model_symbol, $model_value);
                            }
                        });
                    }
                    if ($max_year_value != now()->year) {
                        $posts = $posts->whereHas('options', function ($query) use ($model_symbol, $model_value, $brand_symbol, $brand_value, $max_year_symbol, $max_year_value) {
                            $query->where('max_year_spare', $max_year_symbol, $max_year_value);
                            if ($brand_value != "default") {
                                $query->where('brand_spare', $brand_symbol, $brand_value);
                            }
                            if ($model_value != "default") {
                                $query->where('model_spare', $model_symbol, $model_value);
                            }
                        });
                    }
                }
                $posts = $posts->where('location_id', $location_symbol, $location_value);
                if ($brand_value != "default") {
                    $posts = $posts->whereHas('options', function ($query) use ($brand_symbol, $brand_value) {
                        $query->where('brand_spare', $brand_symbol, $brand_value);
                    });
//                    $posts = $posts->where('brand_spare', $brand_symbol, $brand_value);
                }
                if ($model_value != "default") {
                    $posts = $posts->whereHas('options', function ($query) use ($model_symbol, $model_value) {
                        $query->where('model_spare', $model_symbol, $model_value);
                    });
//                    $posts = $posts->where('model_spare', $model_symbol, $model_value);
                }
                if ($search_value != "default" && $search_value != NULL) {
                    $posts = $posts->where('title', $search_symbol, $search_value);
                }
                if ($category_value != 0 || $category_value != NULL) {
                    if (isset($category_id_arr) && $category_id_arr != NULL) {
                        $posts = $posts->whereIn('category_id', $category_id_arr);
                    } else {
                        $posts = $posts->where('category_id', $category_value);

                    }

                }

                // Sorting Filtering
                $posts = $posts->orderBy('updated_at', 'desc');
                $posts = $posts->paginate($this->pagination_items_count);

                $data['posts'] = $posts;
                // Send data to view
                return view('items.list.index-only')->with($data);
            } else {
                // Get categroy top items data
                if (isset($category_id_arr) && $category_id_arr != NULL) {
                    if (!is_null($category->spare_store)) {
                        $top_posts = SparePartsStore::where(['top' => 1, 'active' => 1, 'type' => $category->spare_store])->whereIn('category_id', $category_id_arr)->inRandomOrder()->get();
                        $posts = SparePartsStore::where(['active' => 1, 'type' => $category->spare_store])->whereIn('category_id', $category_id_arr)->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);
                    } else {
                        $top_posts = SparePartsStore::where(['primary' => 1, 'active' => 1])->whereIn('category_id', $category_id_arr)->inRandomOrder()->get();
                        $posts = SparePartsStore::where(['active' => 1])->whereIn('category_id', $category_id_arr)->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);

                    }
                } else {
                    if (!is_null($category->spare_store)) {
                        $top_posts = SparePartsStore::where(['top' => 1, 'active' => 1, 'type' => $category->spare_store])->where('category_id', $category_value)->inRandomOrder()->get();
                        $posts = SparePartsStore::where(['active' => 1, 'type' => $category->spare_store])->where('category_id', $category_value)->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);
                    } else {
                        $top_posts = SparePartsStore::where(['primary' => 1, 'active' => 1])->where('category_id', $category_value)->inRandomOrder()->get();
                        $posts = SparePartsStore::where(['active' => 1])->where('category_id', $category_value)->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);

                    }
                }


                // Make breadcrumbs data
                $breadcrumbs = array('home', translating('items'));

                // Push data
                $data['top_posts'] = $top_posts;
                $data['posts'] = $posts;
                $data['has_menu'] = true;
                $data['has_pagination'] = true;
                $data['breadcrumbs'] = $breadcrumbs;

                // Send data to view
                return view('items.list.content.load-data')->with($data);
            }
        } else {
            // Get sidebar ads data
            $sidebar_ads = Ad::where('type', 'list_sidebar')->orderBy('updated_at', 'desc')->limit(8)->get();

            // Get header ad data
            $header_ad = Ad::where('type', 'list_haedaer')->first();

            // Make breadcrumbs data
            $breadcrumbs = array('home', translating('items'));

            // Get locatioon data
            $locations = Location::orderBy('title_' . app()->getLocale(), 'desc')->get();

            // Push data
//            $data['top_posts'] = $top_posts;
            $data['sidebar_ads'] = $sidebar_ads;
            $data['header_ad'] = $header_ad;
            $data['has_menu'] = true;
            $data['has_pagination'] = true;
            $data['breadcrumbs'] = $breadcrumbs;
            $data['locations'] = $locations;

            // Send data to view
//            dd('sssss');
            return view('items.list.index')->with($data);
        }


    }


    // Filter
    public function filter(Request $request, $locale = 'hy', $category_id = NULL, $location = NULL, $min_price = NULL, $max_price = NULL, $post_type = NULL, $auth_type = NULL, $estate_type = NULL, $electro_type = NULL, $search_value = NULL, $request_type = NULL)
    {
        // Get data from middleware
        $data = $request->data;
        // Check session other filter inpyst
        $input_key_array = [];
//        if session has input_options build request->filters in exists sessions
        foreach ($request->session()->all() as $key => $session_item) {
            if (strpos($key, 'saved_input_') !== false) {
                $key_split = explode('saved_input_', $key);
                $option_input_key = 'input_' . $key_split[1];
                $key_array_item = $option_input_key . "=" . $session_item;
                array_push($input_key_array, $key_array_item);
            }
        }
        if (($request->has('filters') && $request->filters != NULl) || (count($input_key_array) > 0 && $input_key_array != NULL)) { // Already exists
            // Make filters array
            $filters_arr = $request->filters != NULl ? explode('|', $request->filters) : $input_key_array;
            // Make keys array
            $keys_arr = array();
            // Make only keys array
            $only_keys_arr = array();

            // Check data
            if (isset($filters_arr) && !empty($filters_arr)) {
                // Loop from array items
                foreach ($filters_arr as $filters_item) {
                    // Check data
                    if ($filters_item != NULL && $filters_item != '' && isset($filters_arr[1]) && $filters_arr[1] != NULL) {
                        // Make keys array
                        $keys_arr_value = explode('=', $filters_item);

                        // Chekc data
                        if (isset($keys_arr_value[0]) && $keys_arr_value[0] != '' && isset($keys_arr_value[1]) && $keys_arr_value[1] != '' && $keys_arr_value[1] != 'filterValue') {
                            // Remove defaul "input_" charecter
                            $exploded_key = explode('input_', $keys_arr_value[0]);

                            // Check data
                            if (isset($exploded_key[1]) && $exploded_key[1] != NULL) {
                                // Push only keys array
                                array_push($only_keys_arr, $exploded_key[1]);
                                // Push keys array
                                $keys_arr[$exploded_key[1]] = $keys_arr_value[1];
                            }
                        }
                    }
                }
            }

        }

        // Check category
        $default_transport_filter = FilterInput::whereIn('id', [1, 7, 24])->get();
//        dd($default_transport_filter);
        $auto_brands = FilterInputOption::where('filter_input_id', 1)->get();

        $auto_categorie = Category::where('id', 1)->first();
        $transport_sub_cat = getCategoryChildren(1)->pluck('id');
        $real_estate_sub_cat = getCategoryChildren(2)->pluck('id');
        $electronics_sub_cat = getCategoryChildren(3)->pluck('id');
        $spare_store_sub_cat = getCategoryChildren(78)->pluck('id');
        $transport_sub_cat_ids = [];
        $real_estate_sub_cat_ids = [];
        $elektronics_sub_cat_ids = [];
        $spare_store_cat_ids = [];

        foreach ($spare_store_sub_cat as $v) {

            array_push($spare_store_cat_ids, $v);
        }
        foreach ($electronics_sub_cat as $v) {

            array_push($elektronics_sub_cat_ids, $v);
        }
        foreach ($real_estate_sub_cat as $v) {

            array_push($real_estate_sub_cat_ids, $v);
        }
        foreach ($transport_sub_cat as $v) {

            array_push($transport_sub_cat_ids, $v);
        }

        if ($category_id == 0 || $category_id == NULL) {
            $category_symbol = '>=';
            $category_value = 0;
            $category = NULL;
        } else {
            // Get category data
            $category = Category::with([
                'special',
                'input',
            ])->findOrFail($category_id);

            $category_symbol = '=';
            $category_value = $category_id;
        }

        // Check location
//        dd($post_type);

        if ($location == 'default' || $location == 0 || $location == NULL || empty($location)) {
            $location_symbol = '>=';
            $location_value = 0;
        } else {
            $location_symbol = '=';
            $location_value = $location;
        }

        // Check post type
// || empty($post_type)
        if ($post_type == 'default' || $post_type == NULL) {
            $post_type_symbol = '>=';
            $post_type_value = 'default';
        } else {

            $post_type_symbol = '=';
            $post_type_value = $post_type;
        }

        // Check auth type

        if ($auth_type == 'default' || $auth_type == NULL) {

            $auth_type_symbol = '>=';
            $auth_type_value = 'default';
        } else {
            $auth_type_symbol = '=';
            $auth_type_value = $auth_type;

        }

        // Check estate type
        if ($estate_type == 'default' || $estate_type == NULL) {

            $estate_type_symbol = '>=';
            $estate_type_value = 'default';
        } else {
            $estate_type_symbol = '=';
            $estate_type_value = $estate_type;

        }

        // Check elctro type
        if ($electro_type == 'default' || $electro_type == NULL) {

            $electro_type_symbol = '>=';
            $electro_type_value = 'default';
        } else {
            $electro_type_symbol = '=';
            $electro_type_value = $electro_type;

        }
        // Check min price
        if ($min_price == NULL || $min_price == 0 || empty($min_price)) {
            $min_price_symbol = '>=';
            $min_price_value = 0;
        } else {
            $min_price_symbol = '>=';
            $min_price_value = $min_price;
        }

        // Check max price
        if ($max_price == NULL || $max_price == 0 || empty($max_price)) {
            $max_price_symbol = '>=';
            $max_price_value = $data['max_price_value'];
        } else {
            $max_price_symbol = '<=';
            $max_price_value = $max_price;
        }

        // Check search value
        if ($search_value == NULL || empty($search_value) || $search_value == 'default') {
            $search_symbol = '!=';
            $search_value = NULL;
        } else {
            $search_symbol = 'LIKE';
            $search_value = '%' . $search_value . '%';
        }

        // Get this category sub items
        $sub_items = Category::where('parent_id', $category_value)->get('id');

        // Make empty category id array
        $category_id_arr = array();

        // Loop from array
        foreach ($sub_items as $sub_item) {
            // Push data
            array_push($category_id_arr, $sub_item->id);
        }

        // Push data
        array_push($category_id_arr, $category_value);

        // Get main items
        $posts = Post::query();

        // Check data
//        In transports and estate parts other default filter not delete in sessions before no changing custom

//        dump($category_id);
        if (!in_array($category_id, $transport_sub_cat_ids)) {
            foreach ($request->session()->all() as $key => $session_item) {
                if (strpos($key, 'saved_input_') !== false) {
                    $request->session()->forget($key);
                }
            }

        }

//            dd($only_keys_arr);
        if (isset($only_keys_arr) && $only_keys_arr != NULL) {
            // Make only keys array
            $id_inputs_array = array();

            // Get options
            $options = PostOption::whereIn('option_id', $only_keys_arr)->get(['post_id', 'value', 'option_id']);

            $assoc_arr = array();

            foreach ($request->session()->all() as $key => $session_item) {
                if (strpos($key, 'saved_input_') !== false) {
                    $request->session()->forget($key);
                }
            }

            foreach ($options as $i => $option) {
                $request->session()->put('saved_input_' . $option->option_id, $keys_arr[$option->option_id]);

                if ($option->value == $keys_arr[$option->option_id]) {
                    if (array_key_exists($option->post_id, $assoc_arr)) {
                        array_push($assoc_arr[$option->post_id], $option->id);
                    } else {
                        $assoc_arr[$option->post_id] = array();
                        array_push($assoc_arr[$option->post_id], $option->id);
                    }
                }
            }

            foreach ($assoc_arr as $key => $last_loop) {
                if (count($last_loop) == count($keys_arr)) {
                    array_push($id_inputs_array, $key);
                }
            }
//            dd($id_inputs_array);
            // Push array
            $array_keys_new = array_keys($keys_arr);

            // Push array
            $array_values_new = array_values($keys_arr);
        }

        // Save session
        $request->session()->save();

        $posts = $posts->where('active', 1);
        $posts = $posts->where('price', $min_price_symbol, $min_price_value);
        $posts = $posts->where('price', $max_price_symbol, $max_price_value);
        $posts = $posts->where('location_id', $location_symbol, $location_value);
        if ($post_type_value != "default") {
            $posts = $posts->where('post_type', $post_type_symbol, $post_type_value);
        }
        if ($estate_type_value != "default") {
            $posts = $posts->where('post_estate_type', $estate_type_symbol, $estate_type_value);
        }
        if ($auth_type_value != "default") {
            $posts = $posts->where('auth_type', $auth_type_symbol, $auth_type_value);
        }
        if ($electro_type_value != "default") {
            $posts = $posts->where('electro_type', $electro_type_symbol, $electro_type_value);
        }
        if ($search_value != "default") {
            $posts = $posts->where('title', $search_symbol, $search_value);
        }
        $posts = $posts->whereIn('category_id', $category_id_arr);

        // Check data
        if (isset($id_inputs_array)) {
            if (count($id_inputs_array) > 0) {
                $posts = $posts->whereIn('id', $id_inputs_array);
            } else {
                $posts = $posts->where('id', '<', 0);
            }
        }

        // Sorting Filtering
        $posts = $posts->orderBy('updated_at', 'desc');
        $posts = $posts->paginate($this->pagination_items_count);

        $top_posts = Post::query();

        // Filtering top post in refresh
        $top_posts = $top_posts->where('active', 1);
        $top_posts = $top_posts->where('top', 1);
        $top_posts = $top_posts->where('price', $min_price_symbol, $min_price_value);
        $top_posts = $top_posts->where('price', $max_price_symbol, $max_price_value);
        $top_posts = $top_posts->where('location_id', $location_symbol, $location_value);
        if ($post_type_value != "default") {
            $top_posts = $top_posts->where('post_type', $post_type_symbol, $post_type_value);
        }

        if ($estate_type_value != "default") {
            $top_posts = $top_posts->where('post_estate_type', $estate_type_symbol, $estate_type_value);

        }
        if ($auth_type_value != "default") {
            $top_posts = $top_posts->where('auth_type', $auth_type_symbol, $auth_type_value);
        }
        if ($electro_type_value != "default") {
            $top_posts = $top_posts->where('electro_type', $electro_type_symbol, $electro_type_value);
        }
        if ($search_value != "default") {
            $top_posts = $top_posts->where('title', $search_symbol, $search_value);
        }
        $top_posts = $top_posts->whereIn('category_id', $category_id_arr);

        // Check data

        if (isset($id_inputs_array)) {
            if (count($id_inputs_array) > 0) {
                $top_posts = $top_posts->whereIn('id', $id_inputs_array);
            } else {
                $top_posts = $top_posts->where('id', '<', 0);
            }
        }

        // Sorting Filtering
        $top_posts = $top_posts->inRandomOrder();
        $top_posts = $top_posts->get();
        // Put sessions
        $request->session()->put('filter_category_id', $category_value);
        $request->session()->put('filter_min_price', $min_price_value);
        $request->session()->put('filter_max_price', $max_price_value);
        $request->session()->put('filter_location', $location_value);
        $request->session()->put('filter_post_type', $post_type_value);
        $request->session()->put('filter_auth_type', $auth_type_value);
        $request->session()->put('filter_auth_type', $auth_type_value);
        $request->session()->put('filter_post_estate_type', $estate_type_value);
        $request->session()->put('filter_post_elec_type', $electro_type_value);
        $request->session()->save();

        // Get sidebar ads data
        $sidebar_ads = Ad::where('type', 'list_sidebar')->orderBy('updated_at', 'desc')->limit(8)->get();
        // Get header ad data
        $header_ad = Ad::where('type', 'list_haedaer')->first();
        // Get locatioon data
        $locations = Location::orderBy('title_' . app()->getLocale(), 'desc')->get();
        // Push data
        $data['category'] = $category;
        $data['posts'] = $posts;
        $data['top_posts'] = $top_posts;
        $data['sidebar_ads'] = $sidebar_ads;
        $data['header_ad'] = $header_ad;
        $data['locations'] = $locations;
        $data['auto_brands'] = $auto_brands;
        $data['auto_categorie'] = $auto_categorie;
        $data['default_transport_filter'] = $default_transport_filter;
        $data['transport_sub_cat_ids'] = $transport_sub_cat_ids;
        $data['real_estate_sub_cat_ids'] = $real_estate_sub_cat_ids;
        $data['elektronics_sub_cat_ids'] = $elektronics_sub_cat_ids;
        $data['spare_store_cat_ids'] = $spare_store_cat_ids;

        // Check request type
        if ($request->ajax()) { // Axios request
            // Send data to view

            if ($request_type == NULL || $request_type == 'submit') {
                // Get top items
                $top_posts = Post::query();
//                dump($location_symbol, $post_type_symbol, $auth_type_symbol, $estate_type_symbol);
                // Filtering
                $top_posts = $top_posts->where('active', 1);
                $top_posts = $top_posts->where('top', 1);
                $top_posts = $top_posts->where('price', $min_price_symbol, $min_price_value);
                $top_posts = $top_posts->where('price', $max_price_symbol, $max_price_value);
                $top_posts = $top_posts->where('location_id', $location_symbol, $location_value);
                if ($post_type_value != "default") {
                    $top_posts = $top_posts->where('post_type', $post_type_symbol, $post_type_value);
                }
                if ($estate_type_value != "default") {
                    $top_posts = $top_posts->where('post_estate_type', $estate_type_symbol, $estate_type_value);

                }
                if ($auth_type_value != "default") {

                    $top_posts = $top_posts->where('auth_type', $auth_type_symbol, $auth_type_value);

                }
                if ($electro_type_value != "default") {

                    $top_posts = $top_posts->where('electro_type', $electro_type_symbol, $electro_type_value);
                }
                if ($search_value != "default") {

                    $top_posts = $top_posts->where('title', $search_symbol, $search_value);
                }

                $top_posts = $top_posts->whereIn('category_id', $category_id_arr);
                // Check data
                if (isset($id_inputs_array)) {

                    if (count($id_inputs_array) > 0) {
//                        dump($id_inputs_array);
                        $top_posts = $top_posts->whereIn('id', $id_inputs_array);
                    } else {
                        $top_posts = $top_posts->where('id', '<', 0);
                    }
                }
                // Sorting Filtering
                $top_posts = $top_posts->inRandomOrder();
                $top_posts = $top_posts->get();
                // Push data
                $data['top_posts'] = $top_posts;
                $posts = Post::query();
                $posts = $posts->where('active', 1);
//                $posts = $posts->where('top', 0);
                $posts = $posts->where('price', $min_price_symbol, $min_price_value);
                $posts = $posts->where('price', $max_price_symbol, $max_price_value);
                $posts = $posts->where('location_id', $location_symbol, $location_value);
                if ($post_type_value != "default") {
                    $posts = $posts->where('post_type', $post_type_symbol, $post_type_value);

                }
                if ($estate_type_value != "default") {
                    $posts = $posts->where('post_estate_type', $estate_type_symbol, $estate_type_value);

                }
                if ($auth_type_value != "default") {
                    $posts = $posts->where('auth_type', $auth_type_symbol, $auth_type_value);

                }
                if ($electro_type_value != "default") {
                    $posts = $posts->where('electro_type', $electro_type_symbol, $electro_type_value);
                }
                if ($search_value != "default") {
                    $posts = $posts->where('title', $search_symbol, $search_value);
                }
                $posts = $posts->whereIn('category_id', $category_id_arr);

                // Check data
                if (isset($id_inputs_array)) {
                    if (count($id_inputs_array) > 0) {
                        $posts = $posts->whereIn('id', $id_inputs_array);
                    } else {
                        $posts = $posts->where('id', '<', 0);
                    }
                }

                // Sorting Filtering
                $posts = $posts->orderBy('updated_at', 'desc');
                $posts = $posts->paginate($this->pagination_items_count);

                $data['posts'] = $posts;
                // Send data to view
                return view('items.list.index-only')->with($data);
            } else {
                // Get categroy top items data
                $top_posts = Post::with('wishlist')->where(['top' => 1, 'active' => 1])->whereIn('category_id', $category_id_arr)->inRandomOrder()->get();
                $posts = Post::with('wishlist')->where(['category_id' => $category_id, 'top' => 0, 'active' => 1])->orWhereIn('category_id', $category_id_arr)->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);

                // Make breadcrumbs data
                $breadcrumbs = array('home', translating('items'));

                // Push data
                $data['top_posts'] = $top_posts;
                $data['posts'] = $posts;
                $data['has_menu'] = true;
                $data['has_pagination'] = true;
                $data['breadcrumbs'] = $breadcrumbs;

                // Send data to view
                return view('items.list.content.load-data')->with($data);
            }
        } else {
            // Get this category sub items
            $sub_items = Category::where('parent_id', $category_id)->get('id');

            // Make empty array
            $sub_array = array();

            // Loop from array
            foreach ($sub_items as $sub_item) {
                // Push data
                array_push($sub_array, $sub_item->id);
            }

            // Get sidebar ads data
            $sidebar_ads = Ad::where('type', 'list_sidebar')->orderBy('updated_at', 'desc')->limit(8)->get();

            // Get header ad data
            $header_ad = Ad::where('type', 'list_haedaer')->first();

            // Make breadcrumbs data
            $breadcrumbs = array('home', translating('items'));

            // Get locatioon data
            $locations = Location::orderBy('title_' . app()->getLocale(), 'desc')->get();

            // Push data
//            $data['top_posts'] = $top_posts;
            $data['sidebar_ads'] = $sidebar_ads;
            $data['header_ad'] = $header_ad;
            $data['has_menu'] = true;
            $data['has_pagination'] = true;
            $data['breadcrumbs'] = $breadcrumbs;
            $data['locations'] = $locations;

            // Send data to view
//            dd('sssss');
            return view('items.list.index')->with($data);
        }
    }
}
