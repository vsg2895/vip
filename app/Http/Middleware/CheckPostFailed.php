<?php

namespace App\Http\Middleware;

use App\Post;
use App\PostImage;
use App\PostOption;
use App\SpareOptions;
use App\SparePartsStore;
use Closure;
use CloudinaryLabs\CloudinaryLaravel\CloudinaryEngine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class CheckPostFailed
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $url_permissible_urls = [
            'spare_store' => ['sel-spare-store', 'add-post-store-spare', 'create-post-level-3-spare', 'create-post-level-4','del.video'],
            'post' => ['create-post-level-2', 'add-post-store', 'create-post-level-3', 'create-post-level-4','del.video']
        ];
        $previous_name = Route::getRoutes()->match(
            Request::create(URL::previous())
        )->getName();
        $current_name = Route::currentRouteName();
//        dump($previous_name);
//        dump($current_name);
        if ((in_array($previous_name, $url_permissible_urls['spare_store']) && !in_array($current_name, $url_permissible_urls['spare_store'])) || (in_array($previous_name, $url_permissible_urls['post']) && !in_array($current_name, $url_permissible_urls['post']))) {
//            dump('sssssssssssssssssssssssssssss');
            if (Session::has('processing_post_id') && !is_null(Session::get('processing_post_id')) && Session::get('processing_post_id') != "") {
                if (Session::has('add_post_spare_store_type') && !is_null(Session::get('add_post_spare_store_type')) && Session::get('add_post_spare_store_type') != "") {
                    $post = SparePartsStore::findOrFail(Session::get('processing_post_id'));
                } else {
                    $post = Post::findOrFail(Session::get('processing_post_id'));
                }
            }
            if (isset($post) && !is_null($post)) {
                // Check image existing
                $del_s3 = Storage::disk('s3')->delete($post->img);
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
                if (Session::has('post_canceled')) {
                    Session::pull('post_canceled');
                }
                // Loop from input sessions
                foreach (array_keys(Session::all()) as $key) {
                    // Check input key
                    if (strpos($key, 'add_post_') !== false || strpos($key, 'error_') !== false) {
                        // Unset this session
                        Session::pull($key);
                    }
                }
                Session::save();
            }
        }
        return $next($request);

    }
}
