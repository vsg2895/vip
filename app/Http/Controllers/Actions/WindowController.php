<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use URL;

class WindowController extends Controller
{
    // Get header function
    public function index(Request $request, $locale = 'hy', $size){
        // Get data
        $data = $request->data;

        // Get route
        $route_name = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();

        // Check route 
        if($route_name == 'home'){
            // Push data
            $data['has_menu'] = true;
        }else{
            // Url explodeing
            $url_arr = explode('/'.app()->getLocale(), URL::previous());

            // Check data
            if(isset($url_arr[1]) && $url_arr[1] != NULL){
                // Segments exploding
                $segments_arr = explode('/', $url_arr[1]);
            }

            // Post detail page
            if($segments_arr[1] == 'items' && $segments_arr[2] != NULL){
                // Get post data
                $post = Post::findOrFail($segments_arr[2]);
                
                // Push data
                $data['breadcrumbs'] = array('home', 'items', $post->title);
            }

            // Contcats page
            if($route_name == 'contacts'){
                // Make breadcrumbs data
                $data['breadcrumbs'] = array('home','reference','contacts');
            }

            // User detail page
            if($segments_arr[1] == 'user' && $segments_arr[2] != NULL){
                // Get post data
                $user = User::findOrFail($segments_arr[2]);
                
                // Push data
                $data['breadcrumbs'] = array('home', $user->first_name.' '.$user->last_name);
            }
            
            // // Create post level 1 page
            // if($segments_arr[1] == 'create-post' && !isset($segments_arr[2])){
            //     // Make breadcrumbs data
            //     $data['breadcrumbs'] = array('home','create-post');
            // }

            // // Create post level 2 page
            // if($segments_arr[1] == 'create-post' && isset($segments_arr[2]) && $segments_arr[2] == 'level2' && !isset($segments_arr[4])){
            //     // Make breadcrumbs data
            //     $data['breadcrumbs'] = array('home','create-post','level2');
            // }

            // // Create post level 3 page
            // if($segments_arr[1] == 'create-post' && isset($segments_arr[2]) && $segments_arr[2] == 'level2' && isset($segments_arr[4]) && $segments_arr[4] == 'level3'){
            //     // Make breadcrumbs data
            //     $data['breadcrumbs'] = array('home','create-post','level2','live-preview');
            // }


        }

        // Chcek requsest size
        if(isset($size) && intval($size) <= 992){
            // send data to view with mobile header
            return view('layouts.header-mobile')->with($data);
        }else{
            // send data to view with pc header
            return view('layouts.header-pc')->with($data);
        }
    }
}
