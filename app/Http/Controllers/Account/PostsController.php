<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\SparePartsStore;
use App\UserNotification;
use App\Wallet;
use App\PostPriority;
use App\Location;
use App\Category;
use App\PostImage;
use App\PostOption;
use App\ImageHandler;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PostsController extends Controller
{
    // Pagination items count
    protected $pagination_items_count = 4;

    // Auth Validation
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }

    // Make this page function
    public function index(Request $request, $locale = 'hy', $type = NULL)
    {
        // Get middleware data
        $data = $request->data;

        // Get user notifications data
        $user_notifications_data = UserNotification::where('user_id', Auth::user()->id)->first();

        // Check count
        if ($user_notifications_data == NULL) { // Not exists user notification data
            // Make data
            $notification_data = new UserNotification;
            $notification_data->user_id = Auth::user()->id;

            // Save data
            $notification_data->save();
        }

        // Check page $posts_spares
        if ($type == NULL) { // All posts
            // Get all posts data
            $posts = Post::where(['user_id' => Auth::user()->id])->orderBy('updated_at', 'desc')->get();
            $spare_stores = SparePartsStore::where(['user_id' => Auth::user()->id])->orderBy('updated_at', 'desc')->get();


        } elseif ($type == 'active') { // Active posts
            // Get active posts data
            $posts = Post::where(['user_id' => Auth::user()->id, 'active' => 1])->orderBy('updated_at', 'desc')->get();
            $spare_stores = SparePartsStore::where(['user_id' => Auth::user()->id, 'active' => 1])->orderBy('updated_at', 'desc')->get();


        } elseif ($type == 'passive') { // Active posts
            // Get passive posts data
            $posts = Post::where(['user_id' => Auth::user()->id, 'active' => 0])->orderBy('updated_at', 'desc')->get();
            $spare_stores = SparePartsStore::where(['user_id' => Auth::user()->id, 'active' => 0])->orderBy('updated_at', 'desc')->get();

        } elseif ($type == 'moderation') { // Active posts
            // Get moderation posts data
            $posts = Post::where(['user_id' => Auth::user()->id, 'active' => 2])->orderBy('updated_at', 'desc')->get();
            $spare_stores = SparePartsStore::where(['user_id' => Auth::user()->id, 'active' => 2])->orderBy('updated_at', 'desc')->get();

        } else { // Somthing went wrong
            // Get all posts data
            $posts = Post::where(['user_id' => Auth::user()->id])->orderBy('updated_at', 'desc')->get();
            $spare_stores = SparePartsStore::where(['user_id' => Auth::user()->id])->orderBy('updated_at', 'desc')->get();

        }

        // Get priorites
        $post_priorities = PostPriority::get();

        $posts_spares = array_merge($spare_stores->toArray(), $posts->toArray());
        //Create a new Laravel collection from the array data
        $collection = new Collection($posts_spares);
        $collection = $collection->paginate($this->pagination_items_count);
        // Push data
        $data['posts'] = $posts;
        $data['post_priorities'] = $post_priorities;
        $data['has_pagination'] = true;
        $data['collection'] = $collection;
        $data['page_name_account_aside'] = 'posts';


        // Chek request type
        if ($request->ajax()) { // Axios request
            // Send data to view
            return view('account.post.content')->with($data);
        } else {
            // Send data to view
            return view('account.post.index')->with($data);
        }
    }

    // Update function
    public function update(Request $request, $locale = 'hy', $id)
    {
        // Check access
        if (getPostLastUpdate($id) == true) { // Access Allowed
            // Get post data
            try {
                $post = Post::find($id);
                if (is_null($post))
                {
                    $post = SparePartsStore::findOrFail($id);
                }
//                dd($post);
                // Get data
                $update_count = $post->updates;

                // Make data
//            $post = Post::findOrFail($id);
                $post->updates = intval($update_count) + intval(1);

                // Update
                $post->save();
            }
            catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
            {
                throw $e;
            }
            // Success response
            echo 1;
            exit;
        } else { // Access disabled
            // Error response
            echo 0;
            exit;
        }
    }

    // Delete function
    public function delete(Request $request, $locale = 'hy', $id)
    {
        // Get post
        $post = Post::where('id', $id)->first();

        // Validation
        if (isset($post) && $post != NULL && Auth::check() && isset($post->user_id) && Auth::user()->id == $post->user_id) {

            // Check image existing
            if (file_exists(pathBackMakeForwardSlash(public_path('\assets\img\items\\' . $post->img))) && $post->img != NULL) {
                // Unlink File
                unlink(pathBackMakeForwardSlash(public_path('\assets\img\items\\' . $post->img)));
            }

            // Get gallery images
            $delete_gallery_items = PostImage::where('post_id', $id)->get();

            // Loop from gallery images
            foreach ($delete_gallery_items as $delete_gallery_item) {
                // Check image existing
                if (file_exists(pathBackMakeForwardSlash(public_path('\assets\img\items\\' . $delete_gallery_item->img))) && $delete_gallery_item->img != NULL) {
                    // Unlink File
                    unlink(pathBackMakeForwardSlash(public_path('\assets\img\items\\' . $delete_gallery_item->img)));
                }
            }

            // Delte post and his relations
            Post::findOrFail($id)->delete();

            // Success response
            echo 1;
            exit;
        } else { // Access disabled
            // Error response
            echo 0;
            exit;
        }
    }

    // Make passive function
    public function make_passive(Request $request, $locale = 'hy', $id)
    {
        // Validation
        $post = Post::where('id', $id)->first();


        // Check data
        if (isset($post) && $post != NULL && Auth::check() && Auth::user()->id == $post->user_id && $post->active == 1) {
            // Get post data
            $post = Post::findOrFail($id);

            // Make data
            $post->active = 0;

            // Update
            $post->save();

            // Success response
            echo 1;
            exit;
        } else {

            $post = SparePartsStore::where('id', $id)->first();
            if (isset($post) && $post != NULL && Auth::check() && Auth::user()->id == $post->user_id && $post->active == 1)
            {
                $post = SparePartsStore::findOrFail($id);

                // Make data
                $post->active = 0;

                // Update
                $post->save();
            }
            else
            {
                // Error response
                echo 0;
                exit;

            }

        }
    }

    // Make activation function
    public function make_active(Request $request, $locale = 'hy', $id)
    {
        // Validation
        $post = Post::where('id', $id)->first();

        // Check data
        if (isset($post) && $post != NULL && Auth::check() && Auth::user()->id == $post->user_id && $post->active == 0) {
            // Get post data
            $post = Post::findOrFail($id);

            // Make data
            $post->active = 1;

            // Update
            $post->save();

            // Success response
            echo 1;
            exit;
        } else {

            $post = SparePartsStore::where('id', $id)->first();
            if (isset($post) && $post != NULL && Auth::check() && Auth::user()->id == $post->user_id && $post->active == 0)
            {
                $post = SparePartsStore::findOrFail($id);

                // Make data
                $post->active = 1;

                // Update
                $post->save();
            }
            else
            {
                // Error response
                echo 0;
                exit;

            }
        }
    }

    // Make post to top function
    public function make_top(Request $request, $locale = 'hy', $id)
    {
        // Get dat from middleware
        $data = $request->data;

        // Validation post
        $post = Post::where('id', $id)->first();

        // Validation user wallet
        $wallet = Wallet::where('user_id', Auth::user()->id)->first();

        // Get action price
        $action = PostPriority::where('type', 'top')->first();
        // Check data
        if (isset($post) && $post != NULL && Auth::check() && Auth::user()->id == $post->user_id && isset($wallet) && $wallet->user_id == Auth::user()->id && intval($wallet->balance) != NULL && isset($action->price) && $action->price != NULL) {
            // Get post data
            $post = Post::findOrFail($id);

            // Check datas
            if ($action->price > $wallet->balance || $post->active != 1) { // Not valid
                // Error response
                echo 0;
                exit;
            } else { // Valid data
                // Make data
                $post->top = 1;

                // Update
                $post->save();

                // Get data
                $new_wallet_data = Wallet::where('user_id', Auth::user()->id)->first();

                // Make data
                $new_wallet_data->balance = intval($wallet->balance) - intval($action->price);

                // Save data
                $new_wallet_data->save();

                // Success response
                echo 1;
                exit;
            }
        } else {
            $post = SparePartsStore::where('id', $id)->first();

            if (isset($post) && $post != NULL && Auth::check() && Auth::user()->id == $post->user_id && isset($wallet) && $wallet->user_id == Auth::user()->id && intval($wallet->balance) != NULL && isset($action->price) && $action->price != NULL)
            {
                $post = SparePartsStore::findOrFail($id);
                // Check datas
                if ($action->price > $wallet->balance || $post->active != 1) { // Not valid
                    // Error response
                    echo 0;
                    exit;
                } else { // Valid data
                    // Make data
                    $post->top = 1;

                    // Update
                    $post->save();

                    // Get data
                    $new_wallet_data = Wallet::where('user_id', Auth::user()->id)->first();

                    // Make data
                    $new_wallet_data->balance = intval($wallet->balance) - intval($action->price);

                    // Save data
                    $new_wallet_data->save();

                    // Success response
                    echo 1;
                    exit;
                }

            }
            else
            {
                // Error response
                echo 0;
                exit;

            }

        }
    }

    // Make post to primary function
    public function make_primary(Request $request, $locale = 'hy', $id)
    {
        // Get dat from middleware
        $data = $request->data;
//        dd($request->all());
        // Validation post
        $post = Post::where('id', $id)->first();

        // Validation user wallet
        $wallet = Wallet::where('user_id', Auth::user()->id)->first();

        // Get action price
        $action = PostPriority::where('type', 'primary')->first();

        // Check data
        if (isset($post) && $post != NULL && Auth::check() && Auth::user()->id == $post->user_id && isset($wallet) && $wallet->user_id == Auth::user()->id && intval($wallet->balance) != NULL && isset($action->price) && $action->price != NULL) {
            // Get post data
            $post = Post::findOrFail($id);

            // Check datas
            if (($action->price > $wallet->balance) || $post->active != 1) { // Not valid
                // Error response
                echo 0;
                exit;
            } else { // Valid data
                // Make data
                $post->primary = 1;

                // Update
                $post->save();

                // Get data
                $new_wallet_data = Wallet::where('user_id', Auth::user()->id)->first();

                // Make data
                $new_wallet_data->balance = intval($wallet->balance) - intval($action->price);

                // Save data
                $new_wallet_data->save();

                // Success response
                echo 1;
                exit;
            }
        }  else {
            $post = SparePartsStore::where('id', $id)->first();
            if (isset($post) && $post != NULL && Auth::check() && Auth::user()->id == $post->user_id && isset($wallet) && $wallet->user_id == Auth::user()->id && intval($wallet->balance) != NULL && isset($action->price) && $action->price != NULL)
            {
                $post = SparePartsStore::findOrFail($id);
                // Check datas
                if ($action->price > $wallet->balance || $post->active != 1) { // Not valid
                    // Error response
                    echo 0;
                    exit;
                } else { // Valid data
                    // Make data
                    $post->primary = 1;

                    // Update
                    $post->save();

                    // Get data
                    $new_wallet_data = Wallet::where('user_id', Auth::user()->id)->first();

                    // Make data
                    $new_wallet_data->balance = intval($wallet->balance) - intval($action->price);

                    // Save data
                    $new_wallet_data->save();

                    // Success response
                    echo 1;
                    exit;
                }

            }
            else
            {
                // Error response
                echo 0;
                exit;

            }

        }
    }

    // Make post to hurry function
    public function make_hurry(Request $request, $locale = 'hy', $id)
    {
        // Get dat from middleware
        $data = $request->data;

        // Validation post
        $post = Post::where('id', $id)->first();

        // Validation user wallet
        $wallet = Wallet::where('user_id', Auth::user()->id)->first();

        // Get action price
        $action = PostPriority::where('type', 'hurry')->first();

        // Check data
        if (isset($post) && $post != NULL && Auth::check() && Auth::user()->id == $post->user_id && isset($wallet) && $wallet->user_id == Auth::user()->id && intval($wallet->balance) != NULL && isset($action->price) && $action->price != NULL) {
            // Get post data
            $post = Post::findOrFail($id);

            // Check datas
            if ($action->price > $wallet->balance || $post->active != 1) { // Not valid
                // Error response
                echo 0;
                exit;
            } else { // Valid data
                // Make data
                $post->hurry = 1;

                // Update
                $post->save();

                // Get data
                $new_wallet_data = Wallet::where('user_id', Auth::user()->id)->first();

                // Make data
                $new_wallet_data->balance = intval($wallet->balance) - intval($action->price);

                // Save data
                $new_wallet_data->save();

                // Success response
                echo 1;
                exit;
            }
        } else {
            // Error response
            echo 0;
            exit;
        }
    }

    // Edit post
    public function edit(Request $request, $locale = 'hy', $id)
    {
        // Get middleware data
        $data = $request->data;

        // Get post
        $post = Post::with([
            'image',
            'option' => function ($query) {
                $query->with('option');
            },
        ])->findOrFail($id);

        // Auth check
        if (!Auth::check() || Auth::check() && Auth::user()->id != $post->user_id) {
            // Redirect home
            return redirect()->route('home', app()->getLocale());
        }

        // Get field name
        $field = 'title_' . app()->getLocale();

        // Get locations data
        $locations = Location::orderBy($field, 'desc')->get();

        // Get category data
        $category = Category::with([
            'input' => function ($query) {
                $query->with('unit');
            },
        ])->where('id', $post->category_id)->first();

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
        $data['category'] = $category;
        $data['post'] = $post;
        $data['real_estate_sub_cat_ids'] = $real_estate_sub_cat_ids;
        $data['transport_sub_cat_ids'] = $transport_sub_cat_ids;

        // Check request type
        if ($request->ajax()) { // Axios request
            // Send data to view
            return view('account.post.edit')->with($data);
        } else {
            // Send data to view
            return view('account.post.edit')->with($data);
        }
    }

    public function update_content(Request $request, $locale = 'hy', $id)
    {
        // Validation
        $request->validate([
            'title' => 'required|max:255',
            'location_id' => 'required',
            'price' => 'required',
            'currency_id' => 'required',
            'auth_type' => 'required',
            'post_type' => 'required',
            'description' => 'required',
            'imagesCount' => 'required'
        ]);

        // Get location data
        $location = Location::where('id', $request->location_id)->first();

        // Push datas
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->location_id = $request->location_id;
        $post->price = $request->price;
        $post->currency_id = $request->currency_id;
        $post->auth_type = $request->auth_type;
        $post->post_type = $request->post_type;
        $post->description = $request->description;

        // Get category data
        $category = Category::with([
            'input' => function ($query) {
                $query->with('unit');
            },
        ])->where('id', $post->category_id)->first();

        // Validation
        if ($post->user_id != Auth::user()->id) {
            // Error redirect
            return redirect()->back();
        }

        // Validate address data
        if ($request->has('address') && $request->address != NULL && strlen($request->address) < 256) {
            // Push data
            $post->address = $request->address;
        }

        // Save post
        $post->save();

        // Check data
        if (isset($post->option) && count($post->option) > 0) {
            // Get data and delete
            $option = PostOption::where('post_id', $id)->delete();
        }

        // Loop from category inputs
        foreach ($category->input as $input) {
            // Get field name
            $field_name = 'input_' . $input->id;

            // Check data
            if ($request->has('input_' . $input->id) && $request->$field_name != NULL && $request->$field_name != '*') {
                // Check input type
                if ($input->type == 'checkbox') {
                    // Get field name
                    $field_name = 1;
                } else {
                    // Get field name
                    $field_name = $request->$field_name;
                }
                // Make data
                $option = new PostOption;

                // Push data
                $option->post_id = $post->id;
                $option->key_en = $input->title_en;
                $option->key_ru = $input->title_ru;
                $option->key_hy = $input->title_hy;
                $option->value = $field_name;
                $option->option_id = $input->id;

                // Save data
                $option->save();
            }
        }

        // Check images data
        if ($request->has('imagesCount') && $request->imagesCount > 0) {
            for ($image_item = 1; $image_item <= $request->imagesCount; $image_item++) {
                // Get field name
                $field_name = 'uploadImage' . $image_item;

                $getImage = PostImage::where('img', $request->$field_name)->first();

                if (!isset($getImage) || $getImage == NULL) {
                    // Get image data
                    if ($request->has($field_name)) {
                        // Get just ext
                        $extenstion = $request->file($field_name)->getClientOriginalExtension();

                        // Filename to store
                        $fileNameToStore = translating('yerevan-vip-img-title') . time() . $image_item . '.' . $extenstion;

                        // Make data
                        $image = new ImageHandler();

                        // File upload to tmp
                        $image->loadImg($request->$field_name);

                        // Upload image
                        $image->saveImg(pathBackMakeForwardSlash(public_path('\assets\img\items\\' . $fileNameToStore)));

                        // Check image cover or gallery item
                        if ($image_item == 1) {
                            // Push data
                            $post->img = $fileNameToStore;

                            // Save data
                            $post->save();
                        } else {
                            // Make data
                            $image = new PostImage;
                            $image->post_id = $post->id;
                            $image->position_id = 1;
                            $image->img = $fileNameToStore;

                            // Save data
                            $image->save();
                        }
                    }
                }
            }
        }

        // Return redirect with success response
        return redirect()->route('account-posts-edit', ['locale' => app()->getLocale(), 'id' => $id])->with('update_success', 'update_success');
    }

}
