<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Country;

define('LIST_USER', 'list_user');
define('AUTO_USER', 'auto_user');

class UsersController extends Controller
{

    public function index(Request $request)
    {
        $users = User::all();

        return response()->json($users);
    }

    public function create(Request $request)
    {
        $country_name = $request->country;
        unset($request->country);

        $new_user = new User($request->all());

        if ($request->role == constant('LIST_USER'))
        {
            $new_user->email = 'lst_' . $request->email;
        } elseif ($request->role == constant('AUTO_USER'))
        {
            $new_user->email = 'avt_' . $request->email;
        }

        $new_user->confirm = 1;
        $new_user->password = Hash::make('123dd456#@!');

        $selected_country = Country::where('name_en', '=', $country_name)
            ->orWhere('name_ru', '=', $country_name)
            ->orWhere('name_hy', '=', $country_name)
            ->first();

        if ($selected_country)
        {
            $new_user->country_id = $selected_country->id;
        }

        $saved = $new_user->save();

        if (!$saved)
        {
            return response()->json([
                'msg' => 'unable to save new user'
            ]);
        }

        $created_user = User::where('email', '=', $new_user->email)->first();

        return response()->json($created_user);

    }

    public function destroy(Request $request, $id)
    {
        $destroyed = User::destroy($id);

        if (!$destroyed)
        {
            return response()->json([
                'msg' => 'unable to remove user'
            ]);
        }

        return response()->json([
            'destroyed' => $destroyed
        ]);
    }

}
