<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\ConfirmTermsAndConditions;
use App\TermsAndConditions;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    // Admin Validation
    public function __construct() 
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Users';

        // Get items
        $items = User::where('id', '>', '0')->orderBy('id', 'desc')->get();
        
        // Push data
        $data['items'] = $items;
        $data['page_name'] = $page_name;
        $data['route'] = $request->segment(3);

        // Send data to blade
        return view('admin.'.$data['route'].'.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $locale = 'hy', $id)
    {
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'User / Update';

        // Get item
        $item = User::findOrFail($id);

        // $terms_and_conditions_items = TermsAndConditions::orderBy('id', 'desc')->get();

        // Get confirms
        // $confirms = ConfirmTermsAndConditions::where('user_id', Auth::user()->id)->get();

        // Make array
        $arr = array();

        // Loop from confirms
        // foreach($confirms as $confirm){
        //     array_push($arr, $confirm->terms_id);
        // };

        // Push data
        $data['item'] = $item;
        // $data['terms_and_conditions_items'] = $terms_and_conditions_items;
        // $data['arr'] = $arr;
        $data['page_name'] = $page_name;
        $data['route'] = $request->segment(3);

        // Send data to blade
        return view('admin.'.$data['route'].'.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale = 'hy', $id)
    {
        // Validation
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255',
            'confirm' => 'required',
            'phone' => 'required',
            'role' => 'required',
        ]);

        // Make data
        $item['first_name'] = $request->first_name;
        $item['last_name'] = $request->last_name;
        $item['email'] = $request->email;
        $item['confirm'] = $request->confirm;
        $item['phone'] = $request->phone;
        $item['role'] = $request->role;

        // Save data
        User::findOrFail($id)->update($item);

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update_password(Request $request, $locale = 'hy', $id)
    {
        // Get data from middleware
        $data = $request->data;

        // Validation
        $request->validate([
            'password' => 'required',
            'password_confirm' => 'required'
        ]);

        // Get user
        $user = User::findOrFail($id);

        // Get user data before update
        $user_data = array(
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'confirm' => $user->confirm,
            'phone' => $user->phone,
            'role' => $user->role,
            'img' => $user->img,
        );

        // User validation
        if($request->password === $request->password_confirm){
            // Delete User
            User::findOrFail($id)->delete();

            // Make user update
            $user = new User;
            $user->id = $user_data['id'];
            $user->name = $user_data['name'];
            $user->email = $user_data['email'];
            $user->confirm = $user_data['confirm'];
            $user->phone = $user_data['phone'];
            $user->img = $user_data['img'];
            $user->role = $user_data['role'];
            $user->password = Hash::make($request->password);
            $user->llc = md5($request->password);

            // Save user
            $user->save();

            // Redirect o login page with alert
            return redirect()->back()->with('updated', 'updated');
        }else{
            // Make Session
            $request->session()->put('error_password', 'error_password');

            // Redirect Error
            return redirect()->back()->with('error','error');    
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $locale = 'hy', $id)
    {
        // Delete from itmes
        User::findOrFail($id)->delete();

        // Success Redirect
        return redirect()->back()->with('deleted','deleted');
    }
}
