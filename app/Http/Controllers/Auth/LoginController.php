<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Currency;
use App\SocialAccount;
use App\CurrencyApi;
use App\SiteData;
use App\Seo;
use App\ChatUserMessage;
use App\Category;
use App\Post;
use App\User;
use App\Location;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    // Allowed localizations
    public static $localizations = [ 'hy', 'en', 'ru' ];

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToFacebookProvider()
    {
        // Redirecting
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderFacebookCallback()
    {
        // Make socialite data
        $user = Socialite::driver('facebook')->user();

        // Get user data
        $check = User::where('email', $user->email)->first();

        // Check data
        if(isset($check) && $check != NULL){
            // Log In
            Auth::login($check, true);

            // Redirect to home with auth
            return redirect()->route('home', ['locale' => app()->getLocale()]);
        }else{
            // Explode name and surname
            $name_arr = explode(' ', $user->name);

            // Make data
            $data = new User;
            $data->first_name = $name_arr[0];
            $data->last_name = $name_arr[1];
            $data->email = $user->email;
            $data->phone = 123456789;
            $data->img = $user->avatar;
            $data->confirm = '1';
            $data->role = 'facebook_user';
            $data->password = bcrypt('facebookpassword');
            $data->llc = md5('facebookpassword');
            // Save
            $data->save();

            // Log in
            Auth::login($data, true);

            // Redirect to home with auth
            return redirect()->route('home', ['locale' => app()->getLocale()]);
        }
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogleProvider()
    {
        // Redirecting
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderGoogleCallback(Request $request)
    {
        // Make socialite data
        $user = Socialite::driver('google')->user();

        // Get user data
        $check = User::where('email', $user->email)->first();

        // Check data
        if(isset($check) && $check != NULL){
            // Log In
            Auth::login($check, true);

            // Redirect to home with auth
            return redirect()->route('home', ['locale' => app()->getLocale()]);
        }else{
            //  Explode name and surname
            $name_arr = explode(' ', $user->name);

            // Validation
            $validation = User::where('email',$user['email'])->where('confirm', 1)->first();

            // Check validation
            if($validation != NULL){
                // Make email error
                $request->session()->put('email_already_exists', 'email_already_exists');

                // Redirect to login
                return redirect()->route('login', ['locale' => app()->getLocale()]);
            }else{
                // Make data
                $data = new User;
                $data->first_name = $name_arr[0];
                $data->last_name = $name_arr[1];
                $data->email = $user->email;
                $data->phone = 123456789;
                $data->img = $user->avatar;
                $data->confirm = '1';
                $data->role = 'google_user';
                $data->password = bcrypt('googlepassword');
                $data->llc = md5('googlepassword');

                // Save
                $data->save();

                // Log in
                Auth::login($data, true);

                // Redirect to home with auth
                return redirect()->route('home', ['locale' => app()->getLocale()]);
            }
        }
    }

    // Foreget password
    public function showForgetPasswordForm(Request $request)
    {
        // Get middleware data
        $data = $request->data;

        // Get localizationed title
        $title = 'name_'.app()->getLocale();

        // Get countries data
        $countries = Country::orderBy($title, 'desc')->get();

        // Push data
        $data['countries'] = $countries;

        // Send data to view
        return view('auth.forget-password')->with($data);
    }

    // Get middleaware data
    public function showAdminForm(Request $request)
    {
        // Get middleware data
        $data = $request->data;

        // Send data to view
        return view('auth.login-admin')->with($data);
    }

    // Get middleaware data
    public function showLoginForm(Request $request)
    {
        // Get middleware data
        $data = $request->data;

        // Send data to view
        return view('auth.login')->with($data);
    }

    // Send forget password confirmation
    public function forget_password_send(Request $request){
        // Get data from middleware
        $data = $request->data;

        // Validation
        $request->validate([
            'email' => 'email:rfc,dns',
            'phone' => 'required',
            'country_id' => 'required'
        ]);

        // Get user data
        $user = User::where(['email' => $request->email, 'country_id' => $request->country_id, 'phone' => intval($request->phone) ])->first();

        // Validate user
        if(!isset($user) || $user == NULL){ // User not exists
            // Redirect back with error response
            return redirect()->back()->with('error', 'error');
        }

        // Content
        $body = '<html>
                    <body>
                        <h1>'.translating('reset-your-password').'</h1>
                        <a href="'.route('reset-password-login', ['locale' => app()->getLocale(), 'email' => md5($request->email), 'phone' => md5(intval($request->phone))]).'"></a>
                    </body>
                </html>';

        // Headers settings
        $headers = '';
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
        $headers .= 'From: '.getAdminReceiverEmail() . "\r\n";
        $headers .= 'Cc: '.getAdminReceiverEmail()."\r\n";

        // Send email to user
        // mail($request->email, translating('reset-your-password'), $body, $headers);

        // Make session user email
        $request->session()->put('email', md5($request->email));
        $request->session()->put('phone', md5(intval($request->phone)));

        // dd(route('reset-password-login', ['locale' => app()->getLocale(), 'email' => md5($request->email), 'phone' => md5(intval($request->phone))]));
        // http://localhost:8000/hy/login/reset-password/084d8a70d45fbdc8803a98544b67f0d2/b828b69d115fbfd4a3c3b99242200b33

        // Redirect back
        return redirect()->route('forget-password', ['locale' => app()->getLocale()]);
    }

    public function reset_password(Request $request, $locale = 'hy', $email, $phone){
        // Get data from middleware
        $data = $request->data;

        // Check sessions
        if($request->session()->has('email') && $request->session()->get('email') != NULL && $request->session()->has('phone') && $request->session()->get('phone') != NULL){ // Sessions exists
            // Get user data
            $user = User::where(DB::raw('md5(email)'), $email)->
                            where(DB::raw('md5(phone)'), $phone)->
                          first();

            // Validate user
            if(isset($user) && $user != NULL){ // User exists
                // Send data to reset password page
                return view('auth.reset-password', ['locale' => app()->getLocale()])->with($data);
            }else{ // User doesnt exists
                // Clear sessions
                $request->session()->forget('email');
                $request->session()->forget('phone');

                // Redirect to forget password page
                return redirect()->route('forget-password', ['locale' => app()->getLocale()]);
            }
        }else{ // Sessions doesnt exists
            // Clear sessions
            $request->session()->forget('email');
            $request->session()->forget('phone');

            // Redirect to forget password page
            return redirect()->route('forget-password', ['locale' => app()->getLocale()]);
        }
    }

    // Update password operation
    public function reset_password_send(Request $request){
        // Get data frokm middleware
        $data = $request->data;

        // Validation request
        $request->validate([
            'password' => 'required|min:6|max:255',
            'password_confirmation' => 'required|min:6|max:255',
        ]);

        // Check sessions
        if($request->session()->has('email') && $request->session()->get('email') != NULL && $request->session()->has('phone') && $request->session()->get('phone') != NULL){ // Sessions exists
            // Get user data
            $user = User::where(DB::raw('md5(email)'), $request->session()->get('email'))->
                        where(DB::raw('md5(phone)'), $request->session()->get('phone'))->
                        first();

            // Validate user
            if(isset($user) && $user != NULL){
                // Validate psswords
                if($request->password === $request->password_confirmation){ // Correct
                    // Make data
                    $update_data = array(
                        'password' => Hash::make($request->password),
                        'llc' => md5($request->password)
                    );

                    // Update user data
                    $user->update($update_data);

                    // Make password changed session
                    $request->session()->put('password-changed', 'password-changed');

                    // Redirect to login page
                    return redirect()->route('login', ['locale' => app()->getLocale()]);
                }else{ // Not correct passwords
                    // Redirect to back with error
                    return redirect()->back()->with('error', 'error');
                }
            }else{
                // Clear sessions
                $request->session()->forget('email');
                $request->session()->forget('phone');

                // Redirect to login page
                return redirect()->route('login', ['locale' => app()->getLocale()]);
            }
        }else{
            // Redirect to login page
            return redirect()->route('login', ['locale' => app()->getLocale()]);
        }
    }
}
