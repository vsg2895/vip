<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\UserPhoneNumber;
use App\Location;
use App\User;
use App\Country;
use App\BlockedUser;

class SettingsController extends Controller
{
    private $pagination_items_count = 4;

    // Auth Validation
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Make this page function
    public function index(Request $request, $locale = 'hy')
    {
        // Get middleware data
        $data = $request->data;

        // Get locations
        $locations = Location::orderBy('title_' . app()->getLocale(), 'asc')->get();

        // Push data
        $data['locations'] = $locations;
        $data['page_name_account_aside'] = 'settings';

        // Chek request type
        if ($request->ajax()) { // Axios request
            // Send data to view
            return view('account.settings.content')->with($data);
        } else {
            // Send data to view
            return view('account.settings.index')->with($data);
        }
    }

    // Profile page
    public function profile(Request $request, $locale = 'hy')
    {
        // Get middleware data
        $data = $request->data;

        // Push data
        $data['page_name_account_aside'] = 'settings';

        // Chek request type
        if ($request->ajax()) { // Axios request
            // Send data to view
            return view('account.settings.profile')->with($data);
        } else {
            // Send data to view
            return view('account.settings.index')->with($data);
        }
    }

    // Contcats page
    public function contacts(Request $request, $locale = 'hy')
    {
        // Get middleware data
        $data = $request->data;

        // Get data
        $user_phone_numbers = UserPhoneNumber::where('user_id', Auth::user()->id)->first();

        // Check data
        if (!isset($user_phone_numbers) || $user_phone_numbers == NULL) { // Datas are not exists
            // Make data
            $user_phone_data = new UserPhoneNumber;
            $user_phone_data->user_id = Auth::user()->id;

            // Save data
            $user_phone_data->save();
        }

        // Get user data
        $user = User::with([
            'phone_number' => function ($query) {
                $query->with([
                    'phone_country',
                    'viber_country',
                    'whatsapp_country',
                    'telegram_country',
                ]);
            },
            'country',
        ])->findOrFail(Auth::user()->id);

        // Get countries
        $countries = Country::orderBy('name_' . app()->getLocale(), 'asc')->get();

        // Push data
        $data['user'] = $user;
        $data['countries'] = $countries;
        $data['page_name_account_aside'] = 'settings';

        // Chek request type
        if ($request->ajax()) { // Axios request
            // Send data to view
            return view('account.settings.contacts')->with($data);
        } else {
            // Send data to view
            return view('account.settings.index')->with($data);
        }
    }

    // Notifications page
    public function notifications(Request $request, $locale = 'hy')
    {
        // Get middleware data
        $data = $request->data;

        // Push data
        $data['page_name_account_aside'] = 'settings';

        // Chek request type
        if ($request->ajax()) { // Axios request
            // Send data to view
            return view('account.settings.notifications')->with($data);
        } else {
            // Send data to view
            return view('account.settings.index')->with($data);
        }
    }

    // Blocked Users page
    public function blocked_users(Request $request, $locale = 'hy')
    {
        // Get middleware data
        $data = $request->data;

        // Get blocked users data
        $blocked_users = BlockedUser::with('blocked_user')->where('blocker_user_id', Auth::user()->id)->paginate($this->pagination_items_count);

        // Push data
        $data['blocked_users'] = $blocked_users;
        $data['page_name_account_aside'] = 'settings';

        // Chek request type
        if ($request->ajax()) { // Axios request
            // Send data to view
            return view('account.settings.blocked-users')->with($data);
        } else {
            // Send data to view
            return view('account.settings.index')->with($data);
        }
    }

    // Delete from blocked users function
    public function delete_blocked_users(Request $request, $locale = 'hy', $id)
    {
        // Get post
        $user = BlockedUser::where('id', $id)->first();

        // Push data
        $data['page_name_account_aside'] = 'settings';

        // Validation
        if (isset($user) && $user != NULL && Auth::check() && Auth::user()->id == $user->blocker_user_id) {
            // Delte post and his relations
            BlockedUser::findOrFail($id)->delete();

            // Success response
            echo 1;
            exit;
        } else { // Access disabled
            // Error response
            echo 0;
            exit;
        }
    }

    // Account page
    public function account(Request $request, $locale = 'hy')
    {
        // Get middleware data
        $data = $request->data;

        // Push data
        $data['page_name_account_aside'] = 'settings';

        // Chek request type
        if ($request->ajax()) { // Axios request
            // Send data to view
            return view('account.settings.account')->with($data);
        } else {
            // Send data to view
            return view('account.settings.index')->with($data);
        }
    }

    // Update password
    public function change_password(Request $request)
    {
        // Get middleware daga
        $data = $request->data;

        // Validation request
        $request->validate([
            'old_password' => 'required|max:255',
            'new_password' => 'required|min:6|max:255',
            'confirm_new_password' => 'required|min:6|max:255',
        ]);

        // Get user data
        $user = User::where('llc', md5($request->old_password))->first();

        // Validate user
        if (!isset($user) || $user == NULL) { // Not exists
            // Redirect back with error
            return redirect()->back()->with('error', 'error');
        } else { // User exists
            // Validate psswords
            if ($request->new_password === $request->confirm_new_password) { // Correct
                // Make data
                $update_data = array(
                    'password' => Hash::make($request->new_password),
                    'llc' => md5($request->new_password)
                );

                // Update user data
                $user->update($update_data);

                // Make password changed session
                $request->session()->put('password-changed', 'password-changed');

                // Redirect to login page
                return redirect()->route('login', ['locale' => app()->getLocale()]);
            } else { // Not correct passwords
                // Redirect to back with error
                return redirect()->back()->with('error', 'error');
            }
        }
    }

    // Resend email function
    public function change_email(Request $request)
    {
        // Validataion
        $request->validate([
            'email' => 'required|max:255|email:rfc,dns|unique:users'
        ]);

        // Send email verafication
        $body = '<html>
                    <body>
                        <h1>' . translating('email-confirmation-message-title') . '</h1>
                        <a href="' . route('verify', ['locale' => app()->getLocale(), 'email' => md5($request->email)]) . '"></a>
                    </body>
                </html>';

        // Headers settings
        $headers = '';
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
        $headers .= 'From: ' . getAdminReceiverEmail() . "\r\n";
        $headers .= 'Cc: ' . getAdminReceiverEmail() . "\r\n";

        // Send email to user
        // mail($request->email, translating('email-confirm'), $body, $headers);

        // Make session
        $request->session()->put('email', md5($request->email));

        // Make data
        $update_data = array(
            'confirm' => 0
        );

        // Update user email confirmation status
        User::findOrFail(Auth::user()->id)->update($update_data);

        // Return back
        return redirect()->back()->with('email-sended', 'email-sended');
    }

    // Delete account
    public function delete_account(Request $request)
    {
        // Delete user
        User::findOrFail(Auth::user()->id)->delete();

        // Check auth
        if (Auth::check()) {
            // Loging Out
            Auth::logout();

            // Died session
            $request->session()->invalidate();

            // Regenerate session
            $request->session()->regenerateToken();
        }

        // Redirect to login
        return redirect()->route('login', ['locale' => app()->getLocale()]);
    }

    // Log Out
    public function log_out(Request $request)
    {
        // Loging Out
        Auth::logout();
        // Died session
        $request->session()->invalidate();

        // Regenerate session
        $request->session()->regenerateToken();

        // Redirect to login
        return redirect()->route('login', ['locale' => app()->getLocale()]);
    }

    public function admin_log_out(Request $request)
    {
        // Loging Out
        Auth::logout();
        // Died session
        $request->session()->invalidate();

        // Regenerate session
        $request->session()->regenerateToken();

        // Redirect to login
        return redirect()->route('login', ['locale' => app()->getLocale()]);

    }
}
