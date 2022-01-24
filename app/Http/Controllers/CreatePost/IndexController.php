<?php

namespace App\Http\Controllers\CreatePost;

use App\Http\Controllers\Controller;
use App\PaymentRates;
use App\Repositories\VideoRepository;
use App\SpareOptions;
use App\SparePartModel;
use App\PostsExternalLinks;
use App\SparePartsStore;
use App\Video;
use Aws\Rekognition\RekognitionClient;
use Carbon\Carbon;
use Cloudinary\Api\Upload\UploadApi;
use CloudinaryLabs\CloudinaryLaravel\CloudinaryEngine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Location;
use App\Category;
use App\Post;
use App\User;
use App\Currency;
use App\PostOption;
use App\PostPriority;
use App\PostImage;
use App\ImageHandler;
use App\ImageOriginal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;


//use Cloudinary\Cloudinary;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class IndexController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Get post code default string length
    private $post_code_strlen = 5;

//    Make this posts type post or service page

    public function type_start(Request $request)
    {
        Session::pull('processing_post_id');

        // Unsent all sessions
        if (Session::has('created_post_id')) {
            Session::pull('created_post_id');
        }

        if (Session::has('create-post-category-id')) {
            Session::pull('create-post-category-id');
        }

        if (Session::has('add_post_cover_image')) {
            Session::pull('add_post_cover_image');
        }

        if (Session::has('add_post_gallery_images')) {
            Session::pull('add_post_gallery_images');
        }
        if (Session::has('add_post_custom_video')) {
            Session::pull('add_post_custom_video');
        }
        if (Session::has('post_has_service')) {
            Session::pull('post_has_service');
        }
        if (Session::has('add_post_elec_type')) {
            Session::pull('add_post_elec_type');
        }
        if (Session::has('add_post_estate_type')) {
            Session::pull('add_post_estate_type');
        }
        if (Session::has('add_post_spare_store_type')) {
            Session::pull('add_post_spare_store_type');
        }
        if (Session::has('add_post_spare_brand')) {
            Session::pull('add_post_spare_brand');
        }
        if (Session::has('add_post_spare_model')) {
            Session::pull('add_post_spare_model');
        }
        if (Session::has('add_post_video')) {
            Session::pull('add_post_video');
        }
        if (Session::has('external_urls')) {
            Session::pull('external_urls');
        }
        if (Session::has('add_post_video')) {
            Session::pull('add_post_video');
        }
        if (Session::has('add_post_video_name')) {
            Session::pull('add_post_video_name');
        }
        if (Session::has('error_recognation_image')) {
            Session::pull('error_recognation_image');
        }


        // Loop from input sessions
        foreach (array_keys(Session::all()) as $key) {
            // Check input key
            if (strpos($key, 'add_post_') !== false || strpos($key, 'error_') !== false || strpos($key, 'my_') !== false) {
                // Unset this session
                Session::pull($key);
            }
        }

        // Get middleware data
        $data = $request->data;
        // Send data to view
        return view('create-post.select-type')->with($data);

    }

    // Make this page function
    public function index(Request $request)
    {
        if (Session::has('processing_post_id') && Session::get('processing_post_id') != NULL && (Session::has('create-post-category-id') && Session::get('create-post-category-id') != NULL)) {
            // Redirect to next pages
            return redirect()->route('create-post-level-2', ['locale' => app()->getLocale(), 'category_id' => Session::get('create-post-category-id')]);
        }

        // Check image session
        if (Session::has('add_post_cover_image') && Session::get('add_post_cover_image')) {
            // Forget session
            Session::pull('add_post_cover_image');
        }

        // Get middleware data
        $data = $request->data;

        // Make breadcrumbs data
        $breadcrumbs = array('home', 'create-post');

        // Push data
        $data['breadcrumbs'] = $breadcrumbs;

        // Make session
        Session::put('post_creating_start', true);

        if ($request->type == 1 || Session::get('post_has_service') === 1) {
//            dump( Session::get('post_has_service'));
            Session::put('post_has_service', 1);
            $category_id = Category::where('root', 2)->first()->id;
//            dd($category_id);
            Session::put('create-post-category-id', $category_id);
            // Get category data
            $category = Category::with([
                'input' => function ($query) {
                    $query->with('unit');
                },
            ])->where('id', $category_id)->first();
            // Check cover image
            if (Session::has('add_post_cover_image') && Session::get('add_post_cover_image') == true) {
                // Get data from post
                $cover_image = Post::findOrFail(Session::get('add_post_cover_image'));

                // Push data
                $data['cover_image'] = $cover_image;
            }

            // Check gallery image
            if (Session::has('add_post_gallery_images') && Session::get('add_post_gallery_images') == true) {
                // Get data from post
                $gallery_images = PostImage::where('post_id', Session::get('add_post_gallery_images'))->get();

                // Push data
                $data['gallery_images'] = $gallery_images;
            }

            // Get field name
            $field = 'title_' . app()->getLocale();
            // Get locations data
            $locations = Location::orderBy($field, 'desc')->get();
            // Make breadcrumbs data
            $breadcrumbs = array('home', 'create-post', 'level2');
            $transport_sub_cat = getCategoryChildren(1)->pluck('id');
            $real_estate_sub_cat = getCategoryChildren(2)->pluck('id');
            $transport_sub_cat_ids = [];
            $real_estate_sub_cat_ids = [];
            foreach ($real_estate_sub_cat as $v) {

                array_push($real_estate_sub_cat_ids, $v);
            }
            foreach ($transport_sub_cat as $v) {

                array_push($transport_sub_cat_ids, $v);
            }
            // Push data
            $video_variants = PaymentRates::where('type', 'video')->get();
            $user_has_post = !is_null(Auth::user()->posts) && count(Auth::user()->posts) > 0 ? true : false;
            $data['video_variants'] = $video_variants;
            $data['user_has_post'] = $user_has_post;
            $data['locations'] = $locations;
            $data['breadcrumbs'] = $breadcrumbs;
            $data['category'] = $category;
            $data['real_estate_sub_cat_ids'] = $real_estate_sub_cat_ids;
            $data['transport_sub_cat_ids'] = $transport_sub_cat_ids;
            // Save session
        } elseif ($request->type == 2 || Session::get('post_has_service') === 2) {
            Session::put('post_has_service', 2);
            $category_id = Category::where('root', 3)->first()->id;
            Session::put('create-post-category-id', $category_id);
            // Get category data
            $category = Category::with([
                'input' => function ($query) {
                    $query->with('unit');
                },
            ])->where('id', $category_id)->first();
            // Get field name
            $field = 'title_' . app()->getLocale();
            // Get locations data
            $locations = Location::orderBy($field, 'desc')->get();
            $breadcrumbs = array('home', 'create-post', 'level2');
            $transport_sub_cat = getCategoryChildren(1)->pluck('id');
            $real_estate_sub_cat = getCategoryChildren(2)->pluck('id');
            $transport_sub_cat_ids = [];
            $real_estate_sub_cat_ids = [];
            foreach ($real_estate_sub_cat as $v) {

                array_push($real_estate_sub_cat_ids, $v);
            }
            foreach ($transport_sub_cat as $v) {

                array_push($transport_sub_cat_ids, $v);
            }
            // Push data
            $data['locations'] = $locations;
            $data['breadcrumbs'] = $breadcrumbs;
            $data['category'] = $category;
            $data['real_estate_sub_cat_ids'] = $real_estate_sub_cat_ids;
            $data['transport_sub_cat_ids'] = $transport_sub_cat_ids;
        } else {
            Session::put('post_has_service', 0);
        }
        // Save session
        Session::save();
        $categories = $data['categories'];
        $add_post_categories = $data['add_post_categories'];
        $currencies = $data['currencies'];
        $currency = $data['currency'];
        $locale = $data['locale'];
        // Send data to view
        if ($request->ajax()) {
            if (Session::has('post_has_service') && Session::get('post_has_service') === 0) {
                return response()
                    ->json([
                        'view' => view('create-post.create-index-content', compact('categories', 'add_post_categories', 'locale'))->render(),
                        'data' => $data,
                    ]);
            } elseif (Session::has('post_has_service') && Session::get('post_has_service') === 2) {
                return response()
                    ->json([
                        'view' => view('create-post.select-spare-store-content', compact('locations', 'breadcrumbs', 'category', 'real_estate_sub_cat_ids', 'transport_sub_cat_ids', 'currencies', 'currency'))->render(),
                        'data' => $data,
                    ]);

            } else {
                return response()
                    ->json([
                        'view' => view('create-post.level2', compact('locations', 'video_variants', 'user_has_post', 'breadcrumbs', 'category', 'real_estate_sub_cat_ids', 'transport_sub_cat_ids', 'currencies', 'currency'))->render(),
                        'data' => $data,
                    ]);
            }
        } else {
            if (Session::has('post_has_service') && Session::get('post_has_service') === 0) {
                return view('create-post.index')->with($data);
            } elseif (Session::has('post_has_service') && Session::get('post_has_service') === 2) {
                return view('create-post.select-spare-store')->with($data);
            } else {
                return view('create-post.level2-with-styles')->with($data);
            }

        }
    }

//    After Selecting Spare Or Store
    public function sel_spare_store(Request $request)
    {
        // Get middleware data
        $data = $request->data;
        // Make breadcrumbs data
        $breadcrumbs = array('home', 'sel-spare-store');
        if (!Session::has('add_post_spare_store_type')) {
            $request->type == 0 ? Session::put('add_post_spare_store_type', 0) : Session::put('add_post_spare_store_type', 1);

        }
        $category_id = Category::where('spare_store', Session::get('add_post_spare_store_type'))->first()->id;
        if ($category_id != null) {
            Session::put('create-post-category-id', $category_id);
            // Get category data
            $category = Category::with([
                'input' => function ($query) {
                    $query->with('unit');
                },
            ])->where('id', $category_id)->first();
        }
        Session::save();
        // Check cover image
        if (Session::has('add_post_cover_image') && Session::get('add_post_cover_image') == true) {
            // Get data from post
            if (Session::has('post_has_service')) {
                if (Session::get('post_has_service') == 2) {

                    $cover_image = SparePartsStore::findOrFail(Session::get('add_post_cover_image'));
                } else {
                    $cover_image = Post::findOrFail(Session::get('add_post_cover_image'));

                }
            } else {
                // Redirect to start
                return redirect()->route('create-type', ['locale' => app()->getLocale()]);

            }
            // Push data
            $data['cover_image'] = $cover_image;
        }
        if (Session::has('add_post_video_name') && Session::get('add_post_video_name') != NULL
            && Session::has('add_post_video') && Session::get('add_post_video') != NULL) {
            // Get data from post
            $video_name = Session::get('add_post_video');
            $custom_video = SparePartsStore::where('video_url', $video_name)->first();
            // Push data
            $data['custom_video'] = $custom_video;
        }
        $spare_models = SparePartModel::all();
        $field = 'title_' . app()->getLocale();
        // Get locations data
        $locations = Location::orderBy($field, 'desc')->get();
        $breadcrumbs = array('home', 'spare-store', 'level2');
        $transport_sub_cat = getCategoryChildren(1)->pluck('id');
        $real_estate_sub_cat = getCategoryChildren(2)->pluck('id');
        $transport_sub_cat_ids = [];
        $real_estate_sub_cat_ids = [];
        foreach ($real_estate_sub_cat as $v) {

            array_push($real_estate_sub_cat_ids, $v);
        }
        foreach ($transport_sub_cat as $v) {

            array_push($transport_sub_cat_ids, $v);
        }
        $cur_spare_types = [];
        if (Session::has('add_post_spare_brand') && Session::get('add_post_spare_brand') != null) {
            $sel_models = SparePartModel::whereIn('id', Session::get('add_post_spare_brand')[0])->get();
            if (count($sel_models) > 0) {
                foreach ($sel_models as $model) {

                    $current_model_types = $model->model_types;
                    $cur_spare_types[$model['title_' . app()->getLocale()]] = $current_model_types;

                }
            }

        }
        if (Session::has('processing_post_id') && Session::get('processing_post_id') != "" && Session::get('processing_post_id') != NULL) {
            $all_spare_options = SpareOptions::where('post_id', Session::get('processing_post_id'))->where('model_spare', '!=', NULL)->get();

        } else {
            $all_spare_options = NULL;
        }
        $video_variants = PaymentRates::where('type', 'video')->get();
        $user_has_post = !is_null(Auth::user()->spare_stores) && count(Auth::user()->spare_stores) > 0 ? true : false;
        $data['locations'] = $locations;
        $data['breadcrumbs'] = $breadcrumbs;
        $data['category'] = $category;
        $data['real_estate_sub_cat_ids'] = $real_estate_sub_cat_ids;
        $data['transport_sub_cat_ids'] = $transport_sub_cat_ids;
        $data['spare_models'] = $spare_models;
        $data['cur_spare_types'] = $cur_spare_types;
        $data['all_spare_options'] = $all_spare_options;
        $data['video_variants'] = $video_variants;
        $data['user_has_post'] = $user_has_post;
        $categories = $data['categories'];
        $add_post_categories = $data['add_post_categories'];
        $currencies = $data['currencies'];
        $currency = $data['currency'];
        $locale = $data['locale'];

        // Check request type
        if ($request->ajax()) { // Axios request
            // Make session
            Session::put('create-post-category-id', $category_id);

            // Save session
            Session::save();
            // Send data to view
            return response()
                ->json([
                    'view' => view('create-post.level2-spare-store', compact('locations', 'video_variants', 'user_has_post', 'all_spare_options', 'cur_spare_types', 'breadcrumbs', 'category', 'real_estate_sub_cat_ids', 'transport_sub_cat_ids', 'spare_models', 'currencies', 'currency'))->render(),
                    'data' => $data,
                    'all_spare_options' => $all_spare_options,
                ]);
        } else {
            // Send data to view
//            dd('dddd');
            return view('create-post.level2-with-spare-store')->with($data);
        }

    }

    // Level 2 page function
    public function level2(Request $request, $locale = 'hy', $category_id)
    {
        // Get middleware data
        $data = $request->data;
        // Check data
        // Get field name
        $field = 'title_' . app()->getLocale();

        // Get locations data
        $locations = Location::orderBy($field, 'desc')->get();

        // Validate sessions
        if (isset($category_id) && $category_id != NULL) {
            $category_id = $category_id;
        } else {
            if (Session::has('create-post-category-id')) {
                $category_id = Session::get('category_id');
            } else {
                $category_id = 0;
            }
        }

        // Get category data
        $category = Category::with([
            'input' => function ($query) {
                $query->with('unit');
            },
        ])->where('id', $category_id)->first();

        // Check cover image
        if (Session::has('add_post_cover_image') && Session::get('add_post_cover_image') == true) {
            // Get data from post
//            dd(Session::get('post_has_service'));
            if (Session::has('post_has_service')) {
                if (Session::get('post_has_service') == 2) {
                    $cover_image = SparePartsStore::findOrFail(Session::get('add_post_cover_image'));

                } else {
                    $cover_image = Post::findOrFail(Session::get('add_post_cover_image'));

                }

            } else {
                // Redirect to start
                return redirect()->route('create-type', ['locale' => app()->getLocale()]);

            }
            // Push data
            $data['cover_image'] = $cover_image;
        }

        // Check gallery image
        if (Session::has('add_post_gallery_images') && Session::get('add_post_gallery_images') == true) {
            // Get data from post
            $gallery_images = PostImage::where('post_id', Session::get('add_post_gallery_images'))->get();

            // Push data
            $data['gallery_images'] = $gallery_images;
        }
        if (Session::has('add_post_video_name') && Session::get('add_post_video_name') != NULL
            && Session::has('add_post_video') && Session::get('add_post_video') != NULL) {
            // Get data from post
            $video_name = Session::get('add_post_video');
            $custom_video = Post::where('video_url', $video_name)->first();
            // Push data
            $data['custom_video'] = $custom_video;
        }

        // Make breadcrumbs data
        $breadcrumbs = array('home', 'create-post', 'level2');
        $transport_sub_cat = getCategoryChildren(1)->pluck('id');
        $real_estate_sub_cat = getCategoryChildren(2)->pluck('id');
        $transport_sub_cat_ids = [];
        $real_estate_sub_cat_ids = [];
        foreach ($real_estate_sub_cat as $v) {

            array_push($real_estate_sub_cat_ids, $v);
        }
        foreach ($transport_sub_cat as $v) {

            array_push($transport_sub_cat_ids, $v);
        }
        // Push data
//        dump($category_id);
        if (isset($category_id) && !is_null($category_id) && $category_id != 0) {
            $parent_cat = getParents($category_id, $array = []);
            $data['parent_cat'] = $parent_cat;
        }
        $video_variants = PaymentRates::where('type', 'video')->get();
        $user_has_post = !is_null(Auth::user()->posts) && count(Auth::user()->posts) > 0 ? true : false;
        $data['locations'] = $locations;
        $data['breadcrumbs'] = $breadcrumbs;
        $data['category'] = $category;
        $data['real_estate_sub_cat_ids'] = $real_estate_sub_cat_ids;
        $data['transport_sub_cat_ids'] = $transport_sub_cat_ids;
        $data['video_variants'] = $video_variants;
        $data['user_has_post'] = $user_has_post;
        $currencies = $data['currencies'];
        $currency = $data['currency'];
        // Save session


        Session::save();

        // Check request type
        if ($request->ajax()) { // Axios request
            // Make session
            Session::put('create-post-category-id', $category_id);
            // Save session
            Session::save();
            // Send data to view
            return response()
                ->json([
                    'view' => view('create-post.level2', compact('locations', 'video_variants', 'user_has_post', 'parent_cat', 'breadcrumbs', 'category', 'real_estate_sub_cat_ids', 'transport_sub_cat_ids', 'currencies', 'currency'))->render(),
                    'data' => $data,
                ]);
//            return view('create-post.level2')->with($data);
        } else {
            // Send data to view
            return view('create-post.level2-with-styles')->with($data);
        }
    }

    // Make live preview function

    public function level3_spare(Request $request, $locale = 'hy', $id)
    {

        $data = $request->data;

        // Check session

//        its neeed checked
//        dump(Session::all());

        if (!Session::has('post_creating_start')) {
            // Forget category id session
            Session::pull('create-post-category-id');
            Session::pull('post_creating_start');

            // Redirect to start
            return redirect()->route('create-type', ['locale' => app()->getLocale()]);
        }
//        dd(Session::all());
//        dd(Session::has('post_has_service'));

        if (!Session::has('post_has_service')) {

            Session::pull('post_has_service');
            Session::pull('create-post-category-id');
            Session::pull('post_creating_start');
            // Redirect to start
            return redirect()->route('create-type', ['locale' => app()->getLocale()]);
        }
        // Check data
//        dd($id);

        if (!Session::has('create-post-category-id') && $id == NULL) {
            // Redirect to back
            Session::pull('create-post-category-id');
            Session::pull('post_creating_start');
            Session::pull('post_has_service');
            return redirect()->route('create-type', ['locale' => app()->getLocale()]);
        }

        // Make breadcrumbs data
        $breadcrumbs = array('home', 'create-post', 'live-preview');
        // Get post
        $post = SparePartsStore::with('currency')->findOrFail($id);
        // Push data
        $data['breadcrumbs'] = $breadcrumbs;
        $data['post'] = $post;
        // Save session
//        $route_name = app('router')->getRoutes()->match(app('request')->create(URL::current()))->getName();
//        Session::put('my_previous', $route_name);
        Session::save();
        // Send data to view
        return view('create-post.live-preview')->with($data);

    }

    // Make live preview function
    public function level3(Request $request, $locale = 'hy', $id)
    {

        // Get middleware data
        $data = $request->data;

        // Check session
        if (!Session::has('post_creating_start')) {
            // Forget category id session
            Session::pull('create-post-category-id');
            Session::pull('post_creating_start');

            // Redirect to start
            return redirect()->route('create-type', ['locale' => app()->getLocale()]);
        }
        if (!Session::has('post_has_service')) {

            Session::pull('post_has_service');
            Session::pull('create-post-category-id');
            Session::pull('post_creating_start');
            // Redirect to start
            return redirect()->route('create-type', ['locale' => app()->getLocale()]);
        }
        // Check data
        if (!Session::has('create-post-category-id') && $id == NULL) {
            // Redirect to back
            Session::pull('create-post-category-id');
            Session::pull('post_creating_start');
            Session::pull('post_has_service');
            return redirect()->route('create-type', ['locale' => app()->getLocale()]);
        }

        // Make breadcrumbs data
        $breadcrumbs = array('home', 'create-post', 'live-preview');
        // Get post
        $post = Post::with('currency')->findOrFail($id);
        // Push data
        $data['breadcrumbs'] = $breadcrumbs;
        $data['post'] = $post;
        // Save session
//        $route_name = app('router')->getRoutes()->match(app('request')->create(URL::current()))->getName();
//        Session::put('my_previous', $route_name);
        Session::save();
        // Send data to view
        return view('create-post.live-preview')->with($data);
    }

    // Make post created function
    public function level4(Request $request, $locale = 'hy', $id)
    {

        // Check session
        if (!Session::has('post_creating_start')) {
            // Forget category id session
            Session::pull('create-post-category-id');

            // Redirect to start
            return redirect()->route('create-type', ['locale' => app()->getLocale()]);
        } else {
            // Forget tis session
            Session::pull('post_creating_start');
        }

        // Get middleware data
        $data = $request->data;

        // Make breadcrumbs data
        $breadcrumbs = array('home', 'create-type', 'post-created');

        // Check session
        if (Session::has('processing_post_id')) {
//            dd(Session::get('processing_post_id'));
            // Unsent this sessions
            Session::pull('processing_post_id');

            // Unsent all sessions
            if (Session::has('created_post_id')) {
                Session::pull('created_post_id');
            }

            if (Session::has('create-post-category-id')) {
                Session::pull('create-post-category-id');
            }

            if (Session::has('error_description')) {
                Session::pull('error_description');
            }

            if (Session::has('add_post_cover_image')) {
                Session::pull('add_post_cover_image');
            }

            if (Session::has('add_post_gallery_images')) {
                Session::pull('add_post_gallery_images');
            }
            if (Session::has('add_post_custom_video')) {
                Session::pull('add_post_custom_video');
            }
            if (Session::has('add_post_elec_type')) {
                Session::pull('add_post_elec_type');
            }
            if (Session::has('add_post_estate_type')) {
                Session::pull('add_post_estate_type');
            }
            if (Session::has('add_post_elec_type')) {
                Session::pull('add_post_elec_type');
            }
            if (Session::has('add_post_estate_type')) {
                Session::pull('add_post_estate_type');
            }
            if (Session::has('add_post_spare_store_type')) {
                Session::pull('add_post_spare_store_type');
            }
            if (Session::has('add_post_video')) {
                Session::pull('add_post_video');
            }
            if (Session::has('external_urls')) {
                Session::pull('external_urls');
            }
            if (Session::has('add_post_video')) {
                Session::pull('add_post_video');
            }
            if (Session::has('add_post_video_name')) {
                Session::pull('add_post_video_name');
            }
            if (Session::has('error_recognation_image')) {
                Session::pull('error_recognation_image');
            }

            // Loop from input sessions
            foreach (array_keys(Session::all()) as $key) {
                // Check input key
                if (strpos($key, 'add_post_') !== false) {
                    // Unset this session
                    Session::pull($key);
                }
            }

            // Get post
            if (Session::has('post_has_service')) {
                if (Session::get('post_has_service') == 2) {
                    $post = SparePartsStore::findOrFail($id);
//                dd($post);
                } else {
                    $post = Post::findOrFail($id);

                }

            } else {
                return redirect()->route('create-type', ['locale' => app()->getLocale()]);

            }

            if (Session::has('post_has_service')) {
                Session::pull('post_has_service');
            }

            // Get post priorities
            $post_priorities = PostPriority::get();

            // Push data
            $data['breadcrumbs'] = $breadcrumbs;
            $data['post'] = $post;
            $data['post_priorities'] = $post_priorities;

            // Save session
            Session::save();

            // Check request type
            if ($request->ajax()) { // Axios request
                // Send data to view
                return view('create-post.post-created')->with($data);
            } else {
                // Send data to view
                return view('create-post.post-created-with-styles')->with($data);
            }
        } else {
            // Save session
            Session::save();

            // Redierect  back
            return redirect()->route('create-type', ['locale' => app()->getLocale()]);
        }

    }

//    Get spare-types in model

    public function get_model_type(Request $request)
    {
        $cur_spare_types = [];

        $sel_models = SparePartModel::whereIn('id', $request->model)->get();
        if (count($sel_models) > 0) {

            foreach ($sel_models as $model) {
                $current_model_types = $model->model_types;
                $cur_spare_types[$model['title_' . app()->getLocale()]] = $current_model_types;

            }
            return response()
                ->json([
                    'view' => view('create-post.input.model-types-list', compact('cur_spare_types'))->render(),
                    'cur_spare_types' => $cur_spare_types,
                ]);

        } else {
            return response()->json(['error' => 'Something is wrong']);
        }

    }

//    Store_Spare
    public function store_spare(Request $request, VideoRepository $videoRepository)
    {
//        dump(Session::all());
//        dump($request->all());
//        dump(isset($request->spare_store_type) != null );
//        dump(Session::has('add_post_spare_store_type') );
        if (isset($request->spare_store_type) != null || Session::has('add_post_spare_store_type')) {
            if ($request->spare_store_type == 0) {
                $validator = Validator::make($request->all(), [
                    'spare_store_location_id' => 'required',
                    'spare_store_phone' => 'required',
                    'spare_store_address' => 'required|sometimes',
                    'spare_store_title' => 'required|min:3',
                    'spare_store_description' => 'min:10',
                    'spare_store_type' => 'required|numeric|digits_between:0,1',
                    'imagesCount' => 'required|numeric|min:1',
//                    "custom_video" => "mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv|max:9000000"
                ], [
                    'spare_store_location_id.required' => 'Please Enter Valid Location',
                    'spare_store_phone.required' => 'Please Enter Valid Phone',
                    'spare_store_address.required' => 'Please Enter Valid Address',
                    'spare_store_title.required' => 'Please Enter Valid Title',
                    'spare_store_title.min' => 'Please Enter Valid length min:3 Title',
                    'spare_store_description:min' => 'Please Enter Valid length min:10 Description',
                    'spare_store_type.required' => 'Please Enter Valid Spare-Store type',
                    'imagesCount.required' => 'Please Enter Valid Image',
                    'imagesCount.numeric' => 'Please Enter Valid Image',
                    'imagesCount.min' => 'Please Enter Valid Image',
                ]);

            } else {
                $validator = Validator::make($request->all(), [
                    'spare_store_location_id' => 'required',
                    'spare_store_phone' => 'required',
                    'spare_store_address' => 'required',
                    'spare_store_title' => 'required|min:3',
                    'spare_store_type' => 'required|numeric|digits_between:0,1',
                    'imagesCount' => 'required',
                ], [
                    'spare_store_location_id.required' => 'Please Enter Valid Location',
                    'spare_store_phone.required' => 'Please Enter Valid Phone',
                    'spare_store_address.required' => 'Please Enter Valid Address',
                    'spare_store_title.required' => 'Please Enter Valid Title',
                    'spare_store_title.min' => 'Please Enter Valid length min:3 Title',
                    'spare_store_type.required' => 'Please Enter Valid Spare-Store type',
                    'imagesCount.required' => 'Please Enter Valid Image',
                    'imagesCount.numeric' => 'Please Enter Valid Image',
                    'imagesCount.min' => 'Please Enter Valid Image',
                ]);

            }
            if ($validator->fails()) {
                if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                    $public_id = $request->custom_video_name;
                    $cloudinary = new CloudinaryEngine();
                    $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                }
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }
//            Validate Model Type Years
            if (isset($request->spare_store_type) && $request->spare_store_type == 0) {
                if (isset($request->spare_store_model) && count($request->spare_store_model) > 0 && isset($request->spare_store_brand) && count($request->spare_store_brand) > 0) {
                    foreach ($request->spare_store_model as $model) {
                        if (!is_numeric($model)) {
                            Session::put('error_spare_details', "Լրացրեք Մակնիշ,Մոդել և համապատասխան Տարի դաշտերը");
                            return redirect()->back();
                        }
                    }
                } else {
                    if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                        $public_id = $request->custom_video_name;
                        $cloudinary = new CloudinaryEngine();
                        $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                    }
                    Session::put('error_spare_details', "Լրացրեք Մակնիշ,Մոդել և համապատասխան Տարի դաշտերը");
                    return redirect()->back();
                }

                if (isset($request->spare_store_brand)) {
                    $array_brand = [];
                    foreach ($request->spare_store_brand as $brand) {
                        array_push($array_brand, $brand);
                    }
                    $brands = collect($array_brand);
                    Session::pull('add_post_spare_brand');
                    Session::push('add_post_spare_brand', $brands);
                }
                if (isset($request->spare_store_model)) {

                    $array_model = [];
                    foreach ($request->spare_store_model as $model) {
                        array_push($array_model, $model);
                    }
                    $models = collect($array_model);
                    Session::pull('add_post_spare_model');
                    Session::push('add_post_spare_model', $models);
                }
                if (!SparePartsStore::check_spare_years($request->keys(), $request, $array_model)) {
                    if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                        $public_id = $request->custom_video_name;
                        $cloudinary = new CloudinaryEngine();
                        $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                    }
                    Session::put('error_spare_years', 'Լրացրեք Մակնիշ,Մոդել և համապատասխան Տարի դաշտերը');
                    return redirect()->back();
                }

            }
            if (!is_null($request->external_url)) {
                foreach ($request->external_url as $url) {
                    if ($url != null) {
                        $url_parsed_arr = parse_url($url);
                        if (array_key_exists('host', $url_parsed_arr) && array_key_exists('path', $url_parsed_arr) && array_key_exists('query', $url_parsed_arr)) {
                            if (!($url_parsed_arr['host'] == "www.youtube.com" && $url_parsed_arr['path'] == "/watch" && substr($url_parsed_arr['query'], 0, 2) == "v=" && substr($url_parsed_arr['query'], 2) != "")) {

                                if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                                    $public_id = $request->custom_video_name;
                                    $cloudinary = new CloudinaryEngine();
                                    $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                                }
                                Session::put('error_url', "Please Enter Valid Video Url");
                                return redirect()->back();
                            }
                        } else {
                            if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                                $public_id = $request->custom_video_name;
                                $cloudinary = new CloudinaryEngine();
                                $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                            }
                            Session::put('error_url', "Please Enter Valid Video Url");
                            return redirect()->back();

                        }
                    }
                }
            }
            Session::put('add_post_title', $request->spare_store_title);
            $category = Category::with([
                'input' => function ($query) {
                    $query->with('unit');
                },
            ])->where('spare_store', Session::get('add_post_spare_store_type'))->first();
            if (!isset($category) || $category == NULL) {
                Session::put('error_category_id', 'Not Valid Category');
                if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                    $public_id = $request->custom_video_name;
                    $cloudinary = new CloudinaryEngine();
                    $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                }
                return redirect()->back();
            } else {
                Session::put('add_post_category_id', $category->id);
            }
            if ($request->spare_store_location_id != "0") {
                $location = Location::where('id', $request->spare_store_location_id)->first();
                if (!isset($location) || $location == NULL) {
                    Session::put('error_location_id', 'Not Valid Location');
                    if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                        $public_id = $request->custom_video_name;
                        $cloudinary = new CloudinaryEngine();
                        $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                    }
                    return redirect()->back();
                } else {
                    Session::put('add_post_location_id', $request->spare_store_location_id);
                }
                Session::put('add_post_location_id', $request->spare_store_location_id);
            }
            if (!Session::has('post_has_service') || Session::get('post_has_service') != 1 && Session::get('post_has_service') != 0 && Session::get('post_has_service') != 2) {
                if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                    $public_id = $request->custom_video_name;
                    $cloudinary = new CloudinaryEngine();
                    $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                }
                return redirect()->route('create-type', ['locale' => app()->getLocale()]);

            } else {
                $has_services = Session::get('post_has_service');
            }
            if (isset($request->spare_store_currency_id)) {
                if ($request->spare_store_currency_id == "0") {
                    $request->spare_store_currency_id = 1;
                }
                $currency = Currency::where('id', $request->spare_store_currency_id)->first();
                if (!isset($currency) || $currency == NULL) {
                    Session::put('error_currency_id', 'Not Valid Currency');
                    if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                        $public_id = $request->custom_video_name;
                        $cloudinary = new CloudinaryEngine();
                        $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                    }
                    return redirect()->back();
                } else {
                    Session::put('add_post_currency_id', $request->spare_store_currency_id);
                }
            }
            $user = User::where('id', Auth::user()->id)->first();
            if (!isset($user) || $user == NULL) {
                Session::put('error_user_id', 'User Not Found');
                if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                    $public_id = $request->custom_video_name;
                    $cloudinary = new CloudinaryEngine();
                    $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                }
                return redirect()->route('login', app()->getLocale());
            } else {
                $user_id = Auth::user()->id;
                Session::put('add_post_user_id', $user_id);
            }
            if (isset($request->spare_store_description)) {
                if ($request->spare_store_description == NULL) {
                    Session::put('error_description', 'Not Valid Description');
                    if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                        $public_id = $request->custom_video_name;
                        $cloudinary = new CloudinaryEngine();
                        $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                    }
                    return redirect()->back();
                } else {
                    Session::put('add_post_description', $request->spare_store_description);
                }

            }
            if (isset($request->spare_store_phone)) {
                if ($request->spare_store_phone == NULL || $request->spare_store_phone == "") {
                    Session::put('error_spare_phone', 'Not Valid Phone');
                    if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                        $public_id = $request->custom_video_name;
                        $cloudinary = new CloudinaryEngine();
                        $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                    }
                    return redirect()->back();
                } else {
                    Session::put('add_post_spare_phone', $request->spare_store_phone);
                }
            }
            if (isset($request->spare_store_address)) {

                if ($request->has('spare_store_address') && $request->spare_store_address != NULL && strlen($request->spare_store_address) < 256) {
                    Session::put('add_post_address', $request->spare_store_address);
                } else {
                    Session::put('error_address', 'Not Valid Address');
                    if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                        $public_id = $request->custom_video_name;
                        $cloudinary = new CloudinaryEngine();
                        $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                    }
                    return redirect()->back();
                }
            }
            if (Session::has('processing_post_id') && Session::get('processing_post_id') != NULL) {
                $post = SparePartsStore::find(Session::get('processing_post_id'));
                if (!$post) {
                    $post = new SparePartsStore;
                }
            } else {
                $post = new SparePartsStore;
            }
            $post->category_id = $category->id;
            $post->user_id = $user_id;
            $post->title = $request->spare_store_title;
            $post->desc_spare = $request->spare_store_description;
            $post->location_id = $request->spare_store_location_id;
            $post->address = $request->spare_store_address;
            $post->phone = $request->spare_store_phone;
//            $post->min_year_spare = $request->spare_store_year_start;
//            $post->max_year_spare = $request->spare_store_year_end;
            $post->currency_id = $request->spare_store_currency_id;
//            dd($request->all());
            if (!is_null($request->custom_video) && !is_null($request->custom_video_name) && !is_null($request->custom_video_price) && !is_null($request->custom_video_duration)) {
                $post->video_url = $request->custom_video;
                $post->video_process = $request->custom_video_name;
                $post->video_price = $request->custom_video_price;
                $post->video_duration = $request->custom_video_duration;
                Session::put('add_post_video', $request->custom_video);
                Session::put('add_post_video_name', $request->custom_video_name);
                Session::put('add_post_video_price', $request->custom_video_price);
                Session::put('add_post_video_duration', $request->custom_video_duration);
            }
            $post->code = 0;
            $post->active = 2;
            $post->type = Session::get('add_post_spare_store_type');
            $post->save();
//      Add SpareOptions brands and models
            if ($request->spare_store_brand != NULL) {
                // Delete in change etap existst option and put new changed option
                $your_del_Raws = SpareOptions::where('post_id', $post->id)->get();
                if (count($your_del_Raws) > 0) {
                    SpareOptions::destroy($your_del_Raws->pluck('id')->toArray());
                }
                foreach ($request->spare_store_brand as $brand) {
                    $cur_brand = SparePartModel::findOrFail($brand);
                    $brand_all_models_ids = $cur_brand->model_types->pluck('id')->toArray();
//                Get duplicate in all_selected and current brand models
                    $selected_brand_models = array_intersect($request->spare_store_model, $brand_all_models_ids);
                    if (count($selected_brand_models) > 0) {
                        foreach ($selected_brand_models as $cur_b_m) {
                            $req_start_year_name = "spare_store_year_start-" . $cur_b_m;
                            $req_end_year_name = "spare_store_year_end-" . $cur_b_m;
                            $start_year = $request->$req_start_year_name;
                            $end_year = $request->$req_end_year_name;
                            if ($start_year > $end_year) {
                                $spare_options_data = array(
                                    'post_id' => $post->id,
                                    'brand_spare' => $brand,
                                    'model_spare' => $cur_b_m,
                                    'min_year_spare' => $end_year,
                                    'max_year_spare' => $start_year,
                                );
                            } else {
                                $spare_options_data = array(
                                    'post_id' => $post->id,
                                    'brand_spare' => $brand,
                                    'model_spare' => $cur_b_m,
                                    'min_year_spare' => $start_year,
                                    'max_year_spare' => $end_year,
                                );
                            }
                            SpareOptions::insert($spare_options_data);
                        }
                    }
                }
            }
            Session::put('processing_post_id', $post->id);
            if (!Session::has('processing_post_id') || Session::get('processing_post_id') == NULL) {
                Session::put('processing_post_id', $post->id);
            }
            $code_length = intval($this->post_code_strlen) - intval(strlen($post->id));
            $code = '';
            for ($i = 0; $i < $code_length; $i++) {
                $code .= 0;
            }
            $code .= $post->id;
            $update_post_data = array(
                'code' => $code,
            );
            $update = SparePartsStore::findOrFail($post->id)->update($update_post_data);
            if ($request->has('uploadImage1')) {
                $field_name = 'uploadImage1';
                $delete_name = 'deleteImage1';
                $recognation_client = new RekognitionClient([
                    'region' => 'us-east-1',
                    'version' => 'latest',
                ]);
                if ($request->has($field_name)) {
                    $cur_upload_image = $request->file($field_name);
                    $width = Image::make($cur_upload_image)->width();
                    $height = Image::make($cur_upload_image)->height();
                    $cur_size = Image::make($cur_upload_image)->filesize();
                    $isset_capital_img = SparePartsStore::where(['width' => $width, 'height' => $height, 'size' => $cur_size, 'user_id' => Auth::user()->id,])->first();
                    $isset_id = !is_null($isset_capital_img) ? $isset_capital_img->id : 0;
//                    dump($isset_capital_img);
//                    dd($post);
                    if ((!isset($isset_capital_img) || $isset_capital_img == NULL) && $isset_id != $post->id) {
                        $extenstion = $request->file($field_name)->getClientOriginalExtension();
                        $image = fopen($request->$field_name, 'r');
                        $size = filesize($request->$field_name);
                        $image_bytes = fread($image, $size);
                        $result_recognation = $recognation_client->detectModerationLabels([
                            'Image' => ['Bytes' => $image_bytes],
                            'MinConfidence' => 80,
                        ]);
                        $resultLabels = $result_recognation->get('ModerationLabels');
                        $inadmissible_models = ['Explicit Nudity', 'Nudity', 'Graphic Female Nudity', 'Suggestive',
                            'Revealing Clothes', 'Female Swimwear Or Underwear', 'Emaciated Bodies', 'Visually Disturbing'];
                        $finding_models = create_assoc_models_probably($resultLabels);
                        $cur_model_probably = array_fill_keys($inadmissible_models, 80);
                        $matches = array_intersect_key($finding_models, $cur_model_probably);
                        if (count($matches) > 0) {
                            $is_no_permissible = check_permissibility_probablies($matches, 80);
                            if ($is_no_permissible) {
                                Session::put('error_recognation_image', 'Տեղադրեք կայքի անվտանգության կանոններին համապատասխանող լուսանկար(ներ)');
                                Session::save();
                                return redirect()->back();
                            }
                        }
                        $del_s3 = Storage::disk('s3')->delete($request->$delete_name);
                        $cur_res = Storage::disk('s3')->put('images', $request->$field_name, 'public-read');
                        $post->img = $cur_res;
                        $post->width = $width;
                        $post->height = $height;
                        $post->size = $size;
                        $post->save();
                        Session::put('add_post_cover_image', $post->id);
                    } else {
                        Session::put('error_exists_image', "Դուք արդեն ունեք նշված նկար(ներ)ով ավելացված հայտարարություն");
                        Session::save();
                        return redirect()->back();
                    }
                }
            }
            $array_links = [];
            if (!is_null($request->external_url)) {
                PostsExternalLinks::where('post_id', $post->id)->delete();
                foreach ($request->external_url as $url) {
                    if ($url != null) {
                        $post_external_data = ['link' => $url, 'post_id' => $post->id];
                        PostsExternalLinks::create($post_external_data);
                        array_push($array_links, $url);

                    }
                }
                $links = collect($array_links);
                Session::push('external_urls', $links);
            }

            Session::put('post_creating_start', true);
            Session::save();
            return redirect()->route('create-post-level-3-spare', ['locale' => app()->getLocale(), 'id' => $post->id]);
        } else {
            dd('ssssss');
            Session::put('error_something', 'Something is wrong');
            Session::save();
            if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                $public_id = $request->custom_video_name;
                $cloudinary = new CloudinaryEngine();
                $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
            }
            return redirect()->back();
        }
    }

// Delete Video In Cloudinary
    public function del_Video(Request $request)
    {
//        dd($request->public_id);

        $public_id = $request->public_id;
        $cloudinary = new CloudinaryEngine();
        $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
        $post = !is_null(Post::where('video_process', $public_id)->first()) ? Post::where('video_process', $public_id)->first() : SparePartsStore::where('video_process', $public_id)->first();
        if (!is_null($post)) {

            $post->video_url = NULL;
            $post->video_process = NULL;
            $post->video_price = NULL;
            $post->video_duration = NULL;
            $post->save();
        }

        return response()->json(['rs' => $del]);
    }

//    Create signature by authenticate upload in Cloudinary
//    public function generate_signature(Request $request)
//    {
//        $cloud_name = 'yerevan-vip';
//        $timestamp = $request->time;
//        $eager = 'q_auto,w_400,h_300,f_auto';
//        $api_secret = 'PfUlaTgx3SRKxQN3SrSesSbvhzs';
//        $payload_to_sign = [
//            'cloud_name' => $cloud_name,
//            'timestamp' => $timestamp,
//            'eager' => $eager,
//        ];
////        $signature = sha1($payload_to_sign . $api_secret);
////        $signature = hash('sha256', $payload_to_sign . $api_secret);
//        $signature = \Cloudinary\Api\ApiUtils::signParameters($payload_to_sign, $api_secret);
//        return response()->json(['signature' => $signature]);
//    }

    // Store function
    public function store(Request $request, VideoRepository $videoRepository)
    {
//        dump($request->all());
//        dd(Session::all());
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'address' => 'required',
            'category_id' => 'required',
            'location_id' => 'required',
            'price' => 'required',
            'currency_id' => 'required',
            'description' => 'required|min:10',
            'imagesCount' => 'required|numeric|min:1',
//            "custom_video" => "mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv|max:9000000",
        ], [
            'location_id.required' => 'Please Enter Valid Location',
            'address.required' => 'Please Enter Valid Address',
            'title.required' => 'Please Enter Valid Title',
            'title.min' => 'Please Enter Valid length min:3 Title',
            'category_id.required' => 'Please Enter Valid Category',
            'currency_id.required' => 'Please Enter Valid Currency',
            'description.required' => 'Please Enter Valid Currency',
            'description.min' => 'Please Enter Valid length min:10 Description',
            'price.required' => 'Please Enter Valid Price',
            'imagesCount.required' => 'Please Enter Valid Image',
            'imagesCount.numeric' => 'Please Enter Valid Image',
            'imagesCount.min' => 'Please Enter Valid Image',
        ]);
        if ($validator->fails()) {
            if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                $public_id = $request->custom_video_name;
                $cloudinary = new CloudinaryEngine();
                $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
            }
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
//        $resizedVideo = cloudinary()->uploadVideo($request->file('custom_video')->getRealPath(), [
//            'folder' => 'videos',
//            'transformation' => [
//                'width' => 450,
//                'height' => 350,
//                'quality' => "auto",
//                'fetch_format' => "auto",
//            ]
//        ])->getSecurePath();
        if (!is_null($request->external_url)) {
            foreach ($request->external_url as $url) {
                if ($url != null) {
                    $url_parsed_arr = parse_url($url);
                    if (array_key_exists('host', $url_parsed_arr) && array_key_exists('path', $url_parsed_arr) && array_key_exists('query', $url_parsed_arr)) {
                        if (!($url_parsed_arr['host'] == "www.youtube.com" && $url_parsed_arr['path'] == "/watch" && substr($url_parsed_arr['query'], 0, 2) == "v=" && substr($url_parsed_arr['query'], 2) != "")) {
                            Session::put('error_url', "Please Enter Valid Video Url");
                            Session::save();
                            if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                                $public_id = $request->custom_video_name;
                                $cloudinary = new CloudinaryEngine();
                                $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                            }
                            return redirect()->back();
                        }
                    } else {
                        Session::put('error_url', "Please Enter Valid Video Url");
                        Session::save();
                        if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                            $public_id = $request->custom_video_name;
                            $cloudinary = new CloudinaryEngine();
                            $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                        }
                        return redirect()->back();

                    }
                }

            }
        }
        Session::put('add_post_title', $request->title);
        $category = Category::with([
            'input' => function ($query) {
                $query->with('unit');
            },
        ])->where('id', $request->category_id)->first();
        if (!isset($category) || $category == NULL) {
            Session::put('error_category_id');
            if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                $public_id = $request->custom_video_name;
                $cloudinary = new CloudinaryEngine();
                $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
            }
            return redirect()->route('create-type', ['locale' => app()->getLocale()]);
        } else {
            Session::put('add_post_category_id', $request->category_id);
        }

        if ($request->location_id != "0") {
            $location = Location::where('id', $request->location_id)->first();
            if (!isset($location) || $location == NULL) {
                // Put session to errors
                Session::put('error_location_id');
                if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                    $public_id = $request->custom_video_name;
                    $cloudinary = new CloudinaryEngine();
                    $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                }
                return redirect()->back();
            } else {
                // Make location_id sessions
                Session::put('add_post_location_id', $request->location_id);
            }
            Session::put('add_post_location_id', $request->location_id);
        }
        if (!Session::has('post_has_service') || Session::get('post_has_service') != 1 && Session::get('post_has_service') != 0 && Session::get('post_has_service') != 0) {
            if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                $public_id = $request->custom_video_name;
                $cloudinary = new CloudinaryEngine();
                $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
            }
            return redirect()->route('create-type', ['locale' => app()->getLocale()]);

        } else {
            // This request value
            $has_services = Session::get('post_has_service');
        }
        if ($request->price < 0) {
            Session::put('error_price');
            if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                $public_id = $request->custom_video_name;
                $cloudinary = new CloudinaryEngine();
                $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
            }
            return redirect()->back();
        } else {
            Session::put('add_post_price', $request->price);
        }
        if ($request->currency_id == "0") {
            $request->currency_id = 1;
        }
        $currency = Currency::where('id', $request->currency_id)->first();
        if (!isset($currency) || $currency == NULL) {
            Session::put('error_currency_id');
            if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                $public_id = $request->custom_video_name;
                $cloudinary = new CloudinaryEngine();
                $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
            }
            return redirect()->back();
        } else {
            // Make currency_id sessions
            Session::put('add_post_currency_id', $request->currency_id);
        }
        if ($request->auth_type != '0' && $request->auth_type != '1') {
            Session::put('error_auth_type');
            if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                $public_id = $request->custom_video_name;
                $cloudinary = new CloudinaryEngine();
                $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
            }
            return redirect()->back();
        } else {
            Session::put('add_post_auth_type', $request->auth_type);
        }
        if (isset($request->post_type)) {
            if ($request->post_type != '0' && $request->post_type != '1' && $request->post_type != '2') {
                Session::put('error_post_type');
                if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                    $public_id = $request->custom_video_name;
                    $cloudinary = new CloudinaryEngine();
                    $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                }
                return redirect()->back();
            } else {
                Session::put('add_post_post_type', $request->post_type);
            }

        }
        $user = User::where('id', Auth::user()->id)->first();
        if (!isset($user) || $user == NULL) {
            Session::put('error_user_id');
            if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                $public_id = $request->custom_video_name;
                $cloudinary = new CloudinaryEngine();
                $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
            }
            return redirect()->back();
        } else {
            $user_id = Auth::user()->id;
            Session::put('add_post_user_id', $user_id);
        }
        if (Session::has('processing_post_id') && Session::get('processing_post_id') != NULL) {
            $post = Post::find(Session::get('processing_post_id'));
            if (!$post) {
                $post = new Post;
            }
        } else {
            $post = new Post;
        }
        if ($request->description == '' || $request->description == NULL) {
            Session::put('error_description');
            if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                $public_id = $request->custom_video_name;
                $cloudinary = new CloudinaryEngine();
                $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
            }
            return redirect()->back();
        } else {
            Session::put('add_post_description', $request->description);
        }
        if (isset($request->address)) {

            if ($request->has('address') && $request->address != NULL && strlen($request->address) < 256) {
                $post->address = $request->address;
                Session::put('add_post_address', $request->address);
            } else {
                Session::put('error_address');
                // Redirect back with error response
                if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                    $public_id = $request->custom_video_name;
                    $cloudinary = new CloudinaryEngine();
                    $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                }
                return redirect()->back();
            }
        }

        if (!is_null($request->estate_type)) {

            if ($request->estate_type == '' || $request->estate_type == NULL || $request->estate_type == 'default') {
                Session::put('error_estate_type', "Please Select Quality Type ");
                if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                    $public_id = $request->custom_video_name;
                    $cloudinary = new CloudinaryEngine();
                    $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                }
                return redirect()->back();
            } else {
                Session::put('add_post_estate_type', $request->estate_type);
                $post->post_estate_type = $request->estate_type;
            }


        }
        if (!is_null($request->electro_type)) {
            if ($request->electro_type == '' || $request->electro_type == NULL || $request->electro_type == 'default') {
                Session::put('error_electro_type', 'Please Select Condition Type');
                if (!is_null($request->custom_video) && !is_null($request->custom_video_name)) {
                    $public_id = $request->custom_video_name;
                    $cloudinary = new CloudinaryEngine();
                    $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                }
                return redirect()->back();
            } else {
                Session::put('add_post_elec_type', $request->electro_type);
                $post->electro_type = $request->electro_type;
            }

        }
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->location_id = $request->location_id;
        $post->has_services = $has_services;
        $post->price = $request->price;
        $post->currency_id = $request->currency_id;
        $post->auth_type = $request->auth_type;
        $post->post_type = $request->post_type;
        if (!is_null($request->custom_video) && !is_null($request->custom_video_name) && !is_null($request->custom_video_price) && !is_null($request->custom_video_duration)) {
            $post->video_url = $request->custom_video;
            $post->video_process = $request->custom_video_name;
            $post->video_price = $request->custom_video_price;
            $post->video_duration = $request->custom_video_duration;
            Session::put('add_post_video', $request->custom_video);
            Session::put('add_post_video_name', $request->custom_video_name);
            Session::put('add_post_video_price', $request->custom_video_price);
            Session::put('add_post_video_duration', $request->custom_video_duration);
        }
        $post->user_id = $user_id;
        $post->description = $request->description;
        $post->code = 0;
        $post->active = 2;

        $post->save();
        Session::put('processing_post_id', $post->id);
        if (!Session::has('processing_post_id') || Session::get('processing_post_id') == NULL) {
            Session::put('processing_post_id', $post->id);
        }
        $code_length = intval($this->post_code_strlen) - intval(strlen($post->id));
        $code = '';
        for ($i = 0; $i < $code_length; $i++) {
            $code .= 0;
        }
        $code .= $post->id;
        $update_post_data = array(
            'code' => $code,
        );
        $update = Post::findOrFail($post->id)->update($update_post_data);
        if (Session::has('processing_post_id') && Session::get('processing_post_id') != NULL) {
            $option = PostOption::where('post_id', Session::get('processing_post_id'))->delete();
        }
//        Validation Identity fields
        $requestKeys = collect($request->all())->keys();
        $identity_failed = [];
        $identity_error = [];
        foreach ($requestKeys as $key => $r_key) {
            $keys_isset = Str::contains($r_key, 'input_');

            if ($keys_isset) {
                if ($request->$r_key == '*' || is_null($request->$r_key) || $request->$r_key == '') {
                    $key_num = explode('_', $r_key);
                    array_push($identity_failed, $key_num[1]);
                }
            }
        }
        $identity_names = get_identity_names($identity_failed);
        foreach ($identity_names as $val_n) {
            $val_n = preg_replace('/\s+/', '', $val_n);
            array_push($identity_error, $val_n . " դաշտում լրացրեք համապատասխան արժեք");
        }
        if (count($identity_error) > 0) {
            $identity_error = collect($identity_error);
            Session::push('error_identity', $identity_error);
            return redirect()->back();
        }
//        dd($request->all());
        if (count($category->input) > 0) {
            foreach ($category->input as $input) {
                $field_name = 'input_' . $input->id;
                if ($request->has('input_' . $input->id) && $request->$field_name != NULL && $request->$field_name != '*') {
                    if ($input->type == 'checkbox') {
                        $field_name = 1;
                    } else {
                        $field_name = $request->$field_name;
                    }
                    $option = new PostOption;
                    $option->post_id = $post->id;
                    $option->key_en = $input->title_en;
                    $option->key_ru = $input->title_ru;
                    $option->key_hy = $input->title_hy;
                    $option->value = $field_name;
                    $option->option_id = $input->id;
                    // Save data
                    $option->save();
                    // Make address sessions
                    Session::put('add_post_input_' . $input->id, $field_name);
                }
            }
        }

        // Image part start
        if ($request->has('imagesCount') && $request->imagesCount > 0) {

            $recognation_client = new RekognitionClient([
                'region' => 'us-east-1',
                'version' => 'latest',
            ]);
            $capital_img_update = [];
            $img_update = [];
            for ($image_item = 1; $image_item <= $request->imagesCount; $image_item++) {
                $field_name = 'uploadImage' . $image_item;
                $del_name = 'deleteImage' . $image_item;
                if ($request->has($field_name)) {

                    $cur_upload_image = $request->file($field_name);
                    $width = Image::make($cur_upload_image)->width();
                    $height = Image::make($cur_upload_image)->height();
                    $cur_size = Image::make($cur_upload_image)->filesize();
                    $isset_capital_img = Post::where(['width' => $width, 'height' => $height, 'size' => $cur_size, 'user_id' => Auth::user()->id,])->first();
                    $isset_img = PostImage::where(['width' => $width, 'height' => $height, 'size' => $cur_size, 'user_id' => Auth::user()->id])->first();
                    $isset_id = !is_null($isset_capital_img) ? $isset_capital_img->id : 0;
                    if ((!isset($isset_img) || $isset_img == NULL) && (!isset($isset_capital_img) || $isset_capital_img == NULL) && $isset_id != $post->id) {
                        $extenstion = $request->file($field_name)->getClientOriginalExtension();
                        $image = fopen($request->$field_name, 'r');
                        $size = filesize($request->$field_name);
                        $image_bytes = fread($image, $size);
                        $checked_recognation_parent_ids = [1, 2, 3];
                        $result_recognation_inadmissible = $recognation_client->detectModerationLabels([
                            'Image' => ['Bytes' => $image_bytes],
                            'MinConfidence' => 80,
                        ]);
                        $resultLabels_inadmissible = $result_recognation_inadmissible->get('ModerationLabels');
                        $inadmissible_models = ['Explicit Nudity', 'Nudity', 'Graphic Female Nudity', 'Suggestive',
                            'Revealing Clothes', 'Female Swimwear Or Underwear', 'Emaciated Bodies', 'Visually Disturbing'];
                        $finding_models = create_assoc_models_probably($resultLabels_inadmissible);
                        $cur_model_probably = array_fill_keys($inadmissible_models, 80);
                        $matches = array_intersect_key($finding_models, $cur_model_probably);
                        if (count($matches) > 0) {
                            $is_no_permissible = check_permissibility_probablies($matches, 80);
                            if ($is_no_permissible) {
                                Session::put('error_recognation_image', 'Տեղադրեք կայքի անվտանգության կանոններին համապատասխանող լուսանկար(ներ)');
                                Session::save();
                                return redirect()->back();
                            }
                        }
                        $cur_cat = getCat(Session::get('add_post_category_id'));
                        $current_cats = getParents(Session::get('add_post_category_id'));
                        if ($cur_cat->header_position != 7 && in_array($current_cats[0], $checked_recognation_parent_ids)) {
                            $result_recognation = $recognation_client->detectLabels([
                                'Image' => ['Bytes' => $image_bytes],
                                'MinConfidence' => 80,
                            ]);
                            $resultLabels = $result_recognation->get('Labels');

                            $parent_childs = getCategoryChildren($current_cats[0])->pluck('id')->toArray();
                            $res_reconation = recognize_image($resultLabels, $parent_childs);
                            if (array_key_exists("failed", $res_reconation[0])) {
                                Session::put('error_recognation_image', $res_reconation[0]['failed']);
                                Session::save();
                                return redirect()->back();
                            }
                        }
                        $del_s3 = Storage::disk('s3')->delete($request->$del_name);
                        $del_db = PostImage::where('img', $request->$del_name)->delete();
                        $cur_res = Storage::disk('s3')->put('images', $request->$field_name, 'public-read');
                        if ($image_item == 1) {
                            array_push($capital_img_update, ['img' => $cur_res, 'width' => $width, 'height' => $height, 'size' => $size]);
                            Session::put('add_post_cover_image', true);
                        } else {
                            array_push($img_update, ['post_id' => $post->id, 'position_id' => 1, 'img' => $cur_res, 'width' => $width, 'height' => $height, 'size' => $size, 'user_id' => Auth::user()->id]);
                        }
                    } else {
                        Session::put('error_exists_image', "Դուք արդեն ունեք նշված նկար(ներ)ով ավելացված հայտարարություն");
                        Session::save();
                        return redirect()->back();

                    }
                }
            }
            if (count($capital_img_update)) {
                DB::table('posts')
                    ->where('id', $post->id)
                    ->update($capital_img_update[0]);
            }
            PostImage::insert($img_update);
            Session::put('add_post_cover_image', $post->id);
            Session::put('add_post_gallery_images', $post->id);
        }
//        End image upload part
        $array_links = [];
        if (!is_null($request->external_url)) {
            PostsExternalLinks::where('post_id', $post->id)->delete();
            foreach ($request->external_url as $url) {
                if ($url != null) {
                    $post_external_data = ['link' => $url, 'post_id' => $post->id];
                    PostsExternalLinks::create($post_external_data);
                    array_push($array_links, $url);

                }
            }
            $links = collect($array_links);
            Session::push('external_urls', $links);
        }
        Session::put('post_creating_start', true);
        Session::save();
        return redirect()->route('create-post-level-3', ['locale' => app()->getLocale(), 'id' => $post->id]);
    }

////     Del failed posts
    public function destroy_failed(Request $request)
    {
        if (Session::has('processing_post_id') && !is_null(Session::get('processing_post_id')) && Session::get('processing_post_id') != "") {
            if (Session::has('add_post_spare_store_type')) {
                $delete_cover_item = SparePartsStore::findOrFail(Session::get('processing_post_id'));
            } else {
                $delete_cover_item = Post::findOrFail(Session::get('processing_post_id'));
            }
            // Check image existing
            $del_s3 = Storage::disk('s3')->delete($delete_cover_item->img);
            if (!Session::has('add_post_spare_store_type')) {
                $delete_gallery_items = PostImage::where('post_id', Session::get('processing_post_id'))->get();
                foreach ($delete_gallery_items as $delete_gallery_item) {
                    $del_s3 = Storage::disk('s3')->delete($delete_gallery_item->img);
                }
            }
            if (Session::has('add_post_cover_image')) {
                Session::pull('add_post_cover_image');
            }
            if (Session::has('add_post_gallery_images')) {
                // Unset gallery image session
                Session::pull('add_post_gallery_images');
            }

            if (Session::has('add_post_spare_store_type')) {
                $del_post = SparePartsStore::findOrFail(Session::get('processing_post_id'));
                $public_id = $del_post->video_process;
                if (!is_null($public_id)) {
                    $cloudinary = new CloudinaryEngine();
                    $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                }
                SparePartsStore::findOrFail(Session::get('processing_post_id'))->delete();
                SpareOptions::where('post_id', Session::get('processing_post_id'))->delete();
            } else {
                $del_post = Post::findOrFail(Session::get('processing_post_id'));
                $public_id = $del_post->video_process;
                if (!is_null($public_id)) {
                    $cloudinary = new CloudinaryEngine();
                    $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                }
                Post::findOrFail(Session::get('processing_post_id'))->delete();
                PostOption::where('post_id', Session::get('processing_post_id'))->delete();
                PostImage::where('post_id', Session::get('processing_post_id'))->delete();
            }
            Session::pull('processing_post_id');
            Session::pull('create-post-category-id');

            // Unsent all sessions
            if (Session::has('created_post_id')) {
                Session::pull('created_post_id');
            }
            if (Session::has('create-post-category-id')) {
                Session::pull('create-post-category-id');
            }
            if (Session::has('post_has_service')) {
                Session::pull('post_has_service');
            }

            // Loop from input sessions
            foreach (array_keys(Session::all()) as $key) {
                // Check input key
                if (strpos($key, 'add_post_') !== false) {
                    // Unset this session
                    Session::pull($key);
                }
            }
            ImageOriginal::where(['user_id' => Auth::user()->id, 'post_id' => Session::get('processing_post_id')])->delete();

            // Make post creating canceling response
//            Session::put('post_canceled', 'post_canceled');
            Session::save();

            return response()->json('ok');
        }
        return response()->json('ok');


    }


    // Cancel post creating process
    public function destroy(Request $request, $locale = 'hy', $id)
    {
        // Check session
        if (!Session::has('post_creating_start')) {
            // Redirect to start
            return redirect()->route('create-type', ['locale' => app()->getLocale()]);
        }

        if (Session::has('processing_post_id') && Session::get('processing_post_id') == $id) { // Success
            if (Session::has('add_post_spare_store_type')) {
                $delete_cover_item = SparePartsStore::findOrFail($id);
            } else {
                $delete_cover_item = Post::findOrFail($id);

            }
            // Check image existing
            $del_s3 = Storage::disk('s3')->delete($delete_cover_item->img);
            if (!Session::has('add_post_spare_store_type')) {
                $delete_gallery_items = PostImage::where('post_id', $id)->get();
                foreach ($delete_gallery_items as $delete_gallery_item) {
                    $del_s3 = Storage::disk('s3')->delete($delete_gallery_item->img);
                }

            }
            if (Session::has('add_post_cover_image')) {
                Session::pull('add_post_cover_image');
            }
            if (Session::has('add_post_gallery_images')) {
                // Unset gallery image session
                Session::pull('add_post_gallery_images');
            }

            if (Session::has('add_post_spare_store_type')) {
                $del_post = SparePartsStore::findOrFail($id);
                $public_id = $del_post->video_process;
                if (!is_null($public_id)) {
                    $cloudinary = new CloudinaryEngine();
                    $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                }
                SparePartsStore::findOrFail($id)->delete();
                SpareOptions::where('post_id', $id)->delete();
            } else {
                $del_post = Post::findOrFail($id);
                $public_id = $del_post->video_process;
                if (!is_null($public_id)) {
                    $cloudinary = new CloudinaryEngine();
                    $del = $cloudinary->destroy($public_id, ['resource_type' => 'video']);
                }
                Post::findOrFail($id)->delete();
                PostOption::where('post_id', $id)->delete();
                PostImage::where('post_id', $id)->delete();
            }
            Session::pull('processing_post_id');
            Session::pull('create-post-category-id');

            // Unsent all sessions
            if (Session::has('created_post_id')) {
                Session::pull('created_post_id');
            }
            if (Session::has('create-post-category-id')) {
                Session::pull('create-post-category-id');
            }
            if (Session::has('add_post_cover_image')) {
                Session::pull('add_post_cover_image');
            }
            if (Session::has('add_post_gallery_images')) {
                Session::pull('add_post_gallery_images');
            }
            if (Session::has('post_has_service')) {
                Session::pull('post_has_service');
            }
            if (Session::has('add_post_elec_type')) {
                Session::pull('add_post_elec_type');
            }
            if (Session::has('add_post_estate_type')) {
                Session::pull('add_post_estate_type');
            }
            if (Session::has('add_post_spare_store_type')) {
                Session::pull('add_post_spare_store_type');
            }
            // Loop from input sessions
            foreach (array_keys(Session::all()) as $key) {
                // Check input key
                if (strpos($key, 'add_post_') !== false) {
                    // Unset this session
                    Session::pull($key);
                }
            }
            ImageOriginal::where(['user_id' => Auth::user()->id, 'post_id' => $id])->delete();

            // Make post creating canceling response
            Session::put('post_canceled', 'post_canceled');
        }
        Session::save();

        // Return with success response
        return redirect()->route('create-type', ['locale' => app()->getLocale()]);

    }

    // Delete gallery image
    public function destroy_image(Request $request, $locale = 'hy', $id)
    {
        $delete_gallery_item = PostImage::findOrFail($id);
        $post = Post::findOrFail($delete_gallery_item->post_id);
        if (!Auth::check() || Auth::user()->id != $post->user_id) {
            echo 'error';
            exit;
        }
        $del_s3 = Storage::disk('s3')->delete($request->del_url);
        $delete_gallery_item->delete();
        Session::save();
        echo 1;
        exit;
    }
}

