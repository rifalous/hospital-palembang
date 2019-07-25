<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\UserData;
use App\LoginHistory;
use DB;
use Carbon\Carbon;
use Helper;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client;
        try {

            $user = User::where('email', $request->username)->first();
            $user->tokens->each(function($token, $key){
                $token->delete();
            });

            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password,
                ]
            ]);

            return $response;

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {

            if ($e->getCode() === 400) {
                
                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
            } else if ($e->getCode() === 401) {
                
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }

            return response()->json('Something went wrong on the server.', $e->getCode());
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'default_group_location_id' => 'exists:group_locations,id',
            'date_of_birth' => 'date'
        ]);

        $user = '';

        DB::transaction(function() use ($request, &$user) {

            $user = new User;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $user_data = new UserData;
            $user_data->name = $request->name;
            $user_data->identity_number = $request->identity_number;
            $user_data->gender = $request->gender;
            $user_data->place_of_birth = $request->place_of_birth;
            $user_data->date_of_birth = $request->date_of_birth;
            $user_data->address = $request->address;
            $user_data->account_bank_number = $request->account_bank_number;
            $user_data->account_bank_name = $request->account_bank_name;
            $user_data->upload_saving_book = $request->upload_saving_book;
            $user_data->upload_identity_card = $request->upload_identity_card;
            $user_data->default_group_location_id = $request->default_group_location_id;

            $user->user_data()->save($user_data);
            $user->roles()->attach($request->roles);

        });

        return response()->json($user->load(['user_data', 'user_data.groupLocation', 'roles', 'roles.perms']), 200);
    }

    public function logout()
    {

        $login_history = new LoginHistory;
        $login_history->user_id = auth()->user()->id;
        $login_history->datetime = Carbon::now();
        $login_history->type = 1;
        $login_history->save();

        auth()->user()->tokens->each(function($token, $key){
            $token->delete();
        });

        return response()->json('Logged out successfully', 200);
    }

    public function user(Request $request)
    {
        return response()->json($request->user()->load(['user_data', 'user_data.groupLocation', 'roles', 'roles.perms']), 200);
    }

    public function userLevel(Request $request)
    {
        $user = $request->user()->load(['parks']);
        $level = $user->parks->sum();

        return response()->json(Helper::countLevel($level), 200);
    }

}
