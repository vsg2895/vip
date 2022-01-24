<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Post;
use App\PostImage;
use App\PostOption;
use App\PostReport;

class PostController extends Controller
{
    // Admin Validation
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function index_posts(Request $request)
    {
        
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'All Posts';

        // Get items
        $items = Post::with(['user', 'location', 'currency'])->orderBy('id', 'desc')->get();
        
        // Push data
        $data['items'] = $items;
        $data['page_name'] = $page_name;
        $data['route'] = $request->segment(3);

        // Send data to blade
        return view('admin.'.$data['route'].'.index_posts')->with($data);
    }

    public function index_post_images(Request $request)
    {
        
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Post Images';

        // Get items
        $items = PostImage::with(['post'])->orderBy('id', 'desc')->get();
        
        // Push data
        $data['items'] = $items;
        $data['page_name'] = $page_name;
        $data['route'] = $request->segment(3);

        // Send data to blade
        return view('admin.'.$data['route'].'.index_post_images')->with($data);
    }

    public function index_post_options(Request $request)
    {
        
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Post Options';

        // Get items
        $items = PostOption::with(['post'])->orderBy('id', 'desc')->get();
        
        // Push data
        $data['items'] = $items;
        $data['page_name'] = $page_name;
        $data['route'] = $request->segment(3);

        // Send data to blade
        return view('admin.'.$data['route'].'.index_post_options')->with($data);
    }

    public function index_post_reports(Request $request)
    {
        
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Post Reports';

        // Get items
        $items = PostReport::with(['post'])->orderBy('id', 'desc')->get();
        
        // Push data
        $data['items'] = $items;
        $data['page_name'] = $page_name;
        $data['route'] = $request->segment(3);

        // Send data to blade
        return view('admin.'.$data['route'].'.index_post_reports')->with($data);
    }




    public function admin_destroy_posts(Request $request, $locale = 'hy', $id)
    {
        // Delete from itmes
        Post::findOrFail($id)->delete();

        // Success Redirect
        return redirect()->back()->with('deleted','deleted');
    }

    public function admin_destroy_post_images(Request $request, $locale = 'hy', $id)
    {
        // Delete from itmes
        PostImage::findOrFail($id)->delete();

        // Success Redirect
        return redirect()->back()->with('deleted','deleted');
    }

    public function admin_destroy_post_options(Request $request, $locale = 'hy', $id)
    {
        // Delete from itmes
        PostOption::findOrFail($id)->delete();

        // Success Redirect
        return redirect()->back()->with('deleted','deleted');
    }

    public function admin_destroy_post_reports(Request $request, $locale = 'hy', $id)
    {
        // Delete from itmes
        PostReport::findOrFail($id)->delete();

        // Success Redirect
        return redirect()->back()->with('deleted','deleted');
    }





    public function admin_hurry_posts(Request $request, $locale, $id)
    {
        // Delete from itmes
        $p = Post::findOrFail($id);
        $p->hurry = !$p->hurry;
        $p->save();

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    public function admin_top_post(Request $request, $locale, $id)
    {
        // Delete from itmes
        $p = Post::findOrFail($id);
        $p->top = !$p->top;
        $p->save();

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    public function admin_active_post(Request $request, $locale, $id)
    {
        // Delete from itmes
        $p = Post::findOrFail($id);
        if ($p->active == 1)
        {
            $p->active = 0;
        } else if ($p->active == 0)
        {
            $p->active = 1;
        }
        
        $p->save();

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

}
