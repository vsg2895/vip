<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;

class UsersController extends Controller
{
    // Auth Validation
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['check_phone_num']]);
    }

    // Pagination items count
    protected $pagination_items_count = 4;


    public function check_phone_num(Request $request)
    {

        $isset_num = false;
        $user_num = User::where('phone',$request->phone_num)->first();
        if ($user_num != null)
        {
            $isset_num = true;

        }
        return response()->json($isset_num);
//        dd($user_num);

    }

    // Make this page function
    public function index(Request $request, $locale = 'hy', $id = NULL)
    {
        // Get middleware data
        $data = $request->data;

        // Check page
        if ($id == NULL) { //  List page

        } else { // Detail page
            // Get uer data
            $user = User::with('rate')->findOrFail($id);

            // Get posts data
            $posts = Post::with([
                'wishlist',
                'user'
            ])->where(['user_id' => $id])->orderBy('updated_at', 'desc')->paginate($this->pagination_items_count);
        }

        // Get breadcrumbs
        $breadcrumbs = array('home', $user->first_name . ' ' . $user->last_name);

        // Push data
        $data['user'] = $user;
        $data['posts'] = $posts;
        $data['breadcrumbs'] = $breadcrumbs;

        if ($request->ajax()) { // Axios request
            // Send data to view
            return view('components.users.post')->with($data);
        } else { // Get request
            // Send data to view
            return view('pages.users')->with($data);
        }
    }
}
