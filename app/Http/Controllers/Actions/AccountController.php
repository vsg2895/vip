<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserPhoneNumber;
use App\User;
use App\ImageHandler;
use App\UserNotification;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    // Auth Validation
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Phone numbers change function
    public function phone_number_update(Request $request)
    {
        // Validation
        $request->validate([
            'phone' => 'required',
            'country_id' => 'required',
            'phone_country_id' => 'required',
            'viber_country_id' => 'required',
            'whatsapp_country_id' => 'required',
            'telegram_country_id' => 'required',
        ]);

        // Get data
        $phone_numbers = UserPhoneNumber::where('user_id', Auth::user()->id)->get();

        // Check primary phone
        if ($request->has('phone') && $request->phone != NULL) {
            // Make data
            $priamry_phone = User::findOrFail(Auth::user()->id);
            $priamry_phone->phone = $request->phone;
            $priamry_phone->country_id = $request->country_id;

            // Save data
            $priamry_phone->save();

            // Success response
            echo 2;
        }

        // Validation
        if (count($phone_numbers) == 0) { // Not exists
            // Make data
            $phone_number = new UserPhoneNumber;
            $phone_number->user_id = Auth::user()->id;
            $phone_number->phone_country_id = $request->phone_country_id;
            $phone_number->viber_country_id = $request->viber_country_id;
            $phone_number->whatsapp_country_id = $request->whatsapp_country_id;
            $phone_number->telegram_country_id = $request->telegram_country_id;

            // Check phone data
            if ($request->has('phone_number') && $request->phone_number != NULL) {
                $phone_number->phone_number = $request->phone_number;
            }

            // Check viber data
            if ($request->has('viber') && $request->viber != NULL) {
                $phone_number->viber = $request->viber;
            }

            // Check whatsapp data
            if ($request->has('whatsapp') && $request->whatsapp != NULL) {
                $phone_number->whatsapp = $request->whatsapp;
            }

            // Check telegram data
            if ($request->has('telegram') && $request->telegram != NULL) {
                $phone_number->telegram = $request->telegram;
            }

            // Save data
            $phone_number->save();

            // Success response
            echo 1;
            exit;

        } elseif (count($phone_numbers) > 2) { // To many datas
            // Delete all data
            UserPhoneNumber::where('user_id', Auth::user()->id)->delete();

            // Make data
            $phone_number = new UserPhoneNumber;
            $phone_number->user_id = Auth::user()->id;
            $phone_number->phone_country_id = $request->phone_country_id;
            $phone_number->viber_country_id = $request->viber_country_id;
            $phone_number->whatsapp_country_id = $request->whatsapp_country_id;
            $phone_number->telegram_country_id = $request->telegram_country_id;

            // Check phone data
            if ($request->has('phone_number') && $request->phone_number != NULL) {
                $phone_number->phone_number = $request->phone_number;
            }

            // Check viber data
            if ($request->has('viber') && $request->viber != NULL) {
                $phone_number->viber = $request->viber;
            }

            // Check whatsapp data
            if ($request->has('whatsapp') && $request->whatsapp != NULL) {
                $phone_number->whatsapp = $request->whatsapp;
            }

            // Check telegram data
            if ($request->has('telegram') && $request->telegram != NULL) {
                $phone_number->telegram = $request->telegram;
            }

            // Save data
            $phone_number->save();

            // Success response
            echo 1;
            exit;

        } else { // Exists one data
            // Make data
            $phone_number = UserPhoneNumber::where('user_id', Auth::user()->id)->first();
            $phone_number->user_id = Auth::user()->id;
            $phone_number->phone_country_id = $request->phone_country_id;
            $phone_number->viber_country_id = $request->viber_country_id;
            $phone_number->whatsapp_country_id = $request->whatsapp_country_id;
            $phone_number->telegram_country_id = $request->telegram_country_id;

            // Check phone data
            if ($request->has('phone_number') && $request->phone_number != NULL) {
                $phone_number->phone_number = $request->phone_number;
            }

            // Check viber data
            if ($request->has('viber') && $request->viber != NULL) {
                $phone_number->viber = $request->viber;
            }

            // Check whatsapp data
            if ($request->has('whatsapp') && $request->whatsapp != NULL) {
                $phone_number->whatsapp = $request->whatsapp;
            }

            // Check telegram data
            if ($request->has('telegram') && $request->telegram != NULL) {
                $phone_number->telegram = $request->telegram;
            }

            // Save data
            $phone_number->save();

            // Success response
            echo 1;
            exit;
        }
    }

    // Profile datas change function
    public function profile_datas_update(Request $request)
    {
        // Validation
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'location_id' => 'required'
        ]);

        // Check location data
        if ($request->has('location_id') && $request->location_id != NULL && $request->location_id != 0) {
            // Get location id
            $location_id = $request->location_id;
        } else {
            // Get location id
            $location_id = NULL;
        }

        // Make data
        $user = User::findOrFail(Auth::user()->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->location_id = $location_id;

        // Save data
        $user->save();

        // Success response
        echo 1;
        exit;
    }

    // Profile image change function
    public function profile_img_update(Request $request)
    {
        // Get data
        $data = $request->data;
//        dd($request->all());
        if (trim($request->name_changed) != Auth::user()->first_name)
        {
//            $request->session()->flush('auth_name', $request->name_changed);
            Session::put('auth_name', $request->name_changed);
        }
        if (trim($request->last_name_changed) != Auth::user()->last_name)
        {
//            $request->session()->flush('auth_last', $request->last_name_changed);
            Session::put('auth_last', $request->last_name_changed);
        }
        if ($request->location_changed != Auth::user()->location_id && $request->location_changed != "0")
        {
//            $request->session()->flush('auth_location', $request->location_changed);
            Session::put('auth_location', $request->location_changed);
        }
        $request->session()->save();
        // Validation
        $request->validate([
            'img' => 'required'
        ]);

        // Get image data
        if ($request->has('img')) {
            // Get just ext
            $extenstion = $request->file('img')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = translating('yerevan-vip-img-title') . time() . '.' . $extenstion;

            // Make data
            $image = new ImageHandler();

            // File upload to tmp
            $image->loadImg($request->img);

            // Resize image
            $image->cropImg(300, 300);

            // Add watermark to image
            $image->watermarkImg(20, 250, pathBackMakeForwardSlash(public_path('\assets\img\watermarks\user\logo.png')));

            // Upload image
            $image->saveImg(pathBackMakeForwardSlash(public_path('\assets\img\users\\' . $fileNameToStore)));

            // Make update data
            $item = User::findOrFail(Auth::user()->id);

            // Get old image data
            $old_image = $item->img;

            // Remove old image
            $image->removeOldImg(pathBackMakeForwardSlash(public_path('\assets\img\users\\' . $old_image)));

            // Push data
            $item->img = $fileNameToStore;

            // Save data
            $item->save();

            // Make success data
            $success = array(
                'success' => translating('success-account-image-update'),
            );

            // Success redirect
            return redirect()->back()->with($success);
        } else {
            // Make error data
            $error_data = array(
                'error' => translating('error-account-image-update'),
            );

            // Error redirect
            return redirect()->back()->with($error_data);
        }
    }

    // Profile datas change function
    public function notifications_data_update(Request $request)
    {
        // Validation
        $request->validate([
            'new_messages' => 'required',
            'wished_posts' => 'required',
            'wished_users' => 'required',
            'wished_searchs' => 'required',
            'new_reviews' => 'required',
            'remembers' => 'required',
            'website_updates' => 'required',
        ]);

        // Get user notifications data
        $user_notifications_data = UserNotification::where('user_id', Auth::user()->id)->first();

        // Check count
        if ($user_notifications_data == NULL) { // Not exists user data
            // Make data
            $notification_data = new UserNotification;
            $notification_data->user_id = Auth::user()->id;
            $notification_data->new_messages = $request->new_messages;
            $notification_data->wished_posts = $request->wished_posts;
            $notification_data->wished_users = $request->wished_users;
            $notification_data->wished_searchs = $request->wished_searchs;
            $notification_data->new_reviews = $request->new_reviews;
            $notification_data->remembers = $request->remembers;
            $notification_data->website_updates = $request->website_updates;

            // Save data
            $notification_data->save();

            // Success response
            echo 1;
            exit;
        } else { // Alredy exists
            // Make data
            $notification_data = UserNotification::findOrFail($user_notifications_data->id);
            $notification_data->user_id = Auth::user()->id;
            $notification_data->new_messages = $request->new_messages;
            $notification_data->wished_posts = $request->wished_posts;
            $notification_data->wished_users = $request->wished_users;
            $notification_data->wished_searchs = $request->wished_searchs;
            $notification_data->new_reviews = $request->new_reviews;
            $notification_data->remembers = $request->remembers;
            $notification_data->website_updates = $request->website_updates;

            // Save data
            $notification_data->save();

            // Success response
            echo 1;
            exit;
        }
    }
}
