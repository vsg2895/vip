<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Currency;
use App\SocialAccount;
use App\SiteData;
use App\Seo;
use App\Country;
use App\CurrencyApi;
use App\ChatUserMessage;
use App\Category;
use App\Post;
use App\Location;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/account';

    // Allowed localizations
    public static $localizations = ['hy', 'en', 'ru'];

    // Get middleaware data
    public function showRegistrationForm(Request $request)
    {
        // Get middleware data
        $data = $request->data;

        // Get localizationed title
        $title = 'name_' . app()->getLocale();

        // Get countries data
        $countries = Country::orderBy($title, 'desc')->get();

        // Push data
        $data['countries'] = $countries;


        // Send data to view
        return view('auth.register')->with($data);
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
//        confirm_phone_code add this field
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required','email','unique:users'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['required'],
            'confirm_phone_code' => ['required', 'integer', 'min:1'],
//            'g-recaptcha-response' => ['required','captcha'] ,
        ], [
            'first_name.required' => 'Please Enter Valid Name',
            'first_name.string' => 'Please Enter Valid LastName',
            'first_name.max' => 'Valid LastName Length Is Max:256',
            'last_name.required' => 'Please Enter Valid LastName',
            'last_name.string' => 'Please Enter Valid LastName',
            'last_name.max' => 'Valid LastName Length Is Max:256',
            'email.required' => 'Please Enter Valid Email',
            'email.email' => 'Please Enter Valid Email',
            'email.unique' => 'The Email Is Already Exists',
            'phone.required' => 'Please Enter Valid Phone Number',
            'phone.unique' => 'The Phone Number Is Already Exists',
            'terms.required' => 'The Terms Is Required',
            'password.required' => 'Please Enter Valid Password',
            'password.min' => 'The Password min:8 symbol',
            'password.confirmed' => 'The Passwords Is Not Match',
            'confirm_phone_code.required' => 'Please Enter The Valid Verified Code',
            'confirm_phone_code.min' => 'Please Enter The Valid Verified Code',
            'confirm_phone_code.integer' => 'Please Enter The Valid Verified Code',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $validator = $this->validator($data);
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput($data);

        }
//        dd($data);


        // Send email verafication
//        $body_user = '<html>
//                    <body>
//                        <h1>' . translating('email-confirmation-message-title') . '</h1>
//                        <a href="' . route('verify', ['locale' => app()->getLocale(), 'email' => md5($data['email'])]) . '"> ' . translating('verification-click') . ' </a>
//                    </body>
//                </html>';
//
//        $body_admin = '<html>
//                <body>
//                    <h1>' . translating('new-registred-user-title') . '</h1>
//                    <a href="' . route('home', ['locale' => app()->getLocale()]) . '"></a>
//                </body>
//            </html>';
//
//        // Headers settings
//        $headers = '';
//        $headers .= "MIME-Version: 1.0" . "\r\n";
//        $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
//        $headers .= 'From: ' . getAdminReceiverEmail() . "\r\n";
//        $headers .= 'Cc: ' . getAdminReceiverEmail() . "\r\n";
//
//
//        // dd(route('verify', ['locale' => app()->getLocale(), 'email' => md5($data['email'])]));
//
////         Send email to user
//        mail($data['email'], translating('email-confirm'), $body_user, $headers);

        // Send email to admin
        // mail(getAdminReceiverEmail(), translating('new-registred-user'), $body_admin, $headers);

        // Make session
        \Request::session()->put('email', md5($data['email']));
//dd($data);
        preg_match("/[0-9]+/", $data['phone_code'], $code);
        $code_c = Country::where('flag', $code[0])->first();
//         dd($code);
        // Creating user
        return User::create([
            'first_name' => $data['first_name'],
            'country_id' => $code_c->id,
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'role' => 'user',
            'img' => 'user.png',
            'confirm' => $data['confirm_phone_code'],
            'llc' => md5($data['password']),
            'password' => Hash::make($data['password']),
        ]);
    }
}
