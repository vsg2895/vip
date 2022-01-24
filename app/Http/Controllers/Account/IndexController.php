<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Currency;
use App\SocialAccount;
use App\SiteData;
use App\Seo;
use App\Country;
use App\User;
use App\Wallet;

class IndexController extends Controller
{
    // Allowed localizations
    public static $localizations = [ 'hy', 'en', 'ru' ];

    // Auth Validation
    public function __construct() 
    {
        $this->middleware('auth');
    }

    // Handle page
    public function index(Request $request, $locale = 'hy'){
        // Get wallet data
        $wallet = Wallet::where('user_id', Auth::user()->id)->first();

        // Check wallet data
        if(!isset($wallet) || $wallet == NULL){ // Not exists
            // Make data
            $wallet = new Wallet;
            $wallet->user_id = Auth::user()->id;
            $wallet->balance = 0;

            // Save data
            $wallet->save();
        }

        // Check user data
        if(Auth::user()->confirm == 0){ // Email is not confirmate
            // Get middleware data
            $data = $request->data;

            // Send data to confirmation view page 
            return view('auth.confirmation')->with($data);
        }else{ // Confirmated email
            // Check session
            if($request->session()->has('email') && $request->session('email') != NULL){ // Exists
                // Forget this session
                $request->session()->forget('email');
            }

            // Redirect to profile page
            return redirect()->route('account-settings-main', ['locale' => app()->getLocale()]);
        }
    }

    // Resend email function
    public function resend_email(Request $request){
        // Validataion
        $request->validate([
            'email' => 'required|max:255|email:rfc,dns'
        ]);    

        // Send email verafication
        $body = '<html>
                    <body>
                        <h1>'.translating('email-confirmation-message-title').'</h1>
                        <a href="'.route('verify', ['locale' => app()->getLocale(), 'email' => md5($request->email)]).'"></a>
                    </body>
                </html>';

        // Headers settings
        $headers = '';
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
        $headers .= 'From: '.getAdminReceiverEmail() . "\r\n";
        $headers .= 'Cc: '.getAdminReceiverEmail()."\r\n";

        // Send email to user
        // mail($request->email, translating('email-confirm'), $body, $headers);

        // Make session
        $request->session()->put('email', md5($request->email));

        // Return back
        return redirect()->back()->with('email-sended', 'email-sended');
    }

    // Verify email function
    public function verify(Request $request, $locale = 'hy', $email){
        // Get data from middleware
        $data = $request->data;

        // Validation
        if(!Auth::check()){ // Auth fail
            // Redirect to login page
            return redirect()->route('login', ['locale' => app()->getLocale()]);
        } else { //Auth check
            // Check Auth and geted emails
            if(md5(Auth::user()->email) === $email){
                // Make data
                $update_data = array( 'confirm' => 1 );

                // Update
                User::findOrFail(Auth::user()->id)->update($update_data);
                
                // Send data to view account page
                return redirect()->route('account', ['locale' => app()->getLocale()]);
            }else{
                // Send data to view login page
                return redirect()->route('login', ['locale' => app()->getLocale()]);
            }
        }
    }
}
