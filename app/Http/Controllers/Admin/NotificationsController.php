<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\UserNotification;

class NotificationsController extends Controller
{
    // Admin Validation
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Notifications';

        // Get items
        $items = UserNotification::with('user')->where('id', '>', '0')->orderBy('id', 'desc')->get();
        
        // Push data
        $data['items'] = $items;
        $data['page_name'] = $page_name;
        $data['route'] = $request->segment(3);

        // Send data to blade
        return view('admin.'.$data['route'].'.index')->with($data);
    }

    public function show(Request $request, $locale = 'hy', $id)
    {
        // Get fata from middleware
        $data = $request->data;

        // Get page name
        $page_name = 'Notification / Update';

        // Get item
        $item = UserNotification::findOrFail($id);

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

    public function update(Request $request, $locale = 'hy', $id)
    {
        // Make data
        $item['new_messages'] = $request->new_messages;
        $item['wished_posts'] = $request->wished_posts;
        $item['wished_users'] = $request->wished_users;
        $item['wished_searchs'] = $request->wished_searchs;
        $item['new_reviews'] = $request->new_reviews;
        $item['remembers'] = $request->remembers;
        $item['website_updates'] = $request->website_updates;

        // Save data
        UserNotification::findOrFail($id)->update($item);

        // Success Redirect
        return redirect()->back()->with('updated','updated');
    }

    public function store(Request $request)
    {

    }

    public function destroy(Request $request, $locale = 'hy', $id)
    {
        // Delete from itmes
        UserNotification::findOrFail($id)->delete();

        // Success Redirect
        return redirect()->back()->with('deleted','deleted');
    }

}
