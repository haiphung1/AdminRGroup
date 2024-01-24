<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Auth;
use Laravel\Passport\Client; 

class LoginController extends Controller
{   
    public function login(LoginRequest $request)
    {   
        $credentials = $request->validated();
        
        $client = Client::where('password_client', 1)->first();

        if (Auth::attempt($credentials) && $client) {
            $user = Auth::user();
            
            $requestToken = [
                'grant_type' => 'password',
                'client_id' => $client->id,
                'client_secret' => $client->secret,
                'username' => $credentials['email'],
                'password' => $credentials['password'],
                'scope' => '*'
            ];

            $request = Request::create('/oauth/token', 'POST', $requestToken);

            $result = app()->handle($request);

            $dataToken = json_decode($result->content(), true);

            return response()->json([
                'success' => true,
                'message' => __('Login success'),
                'token_type' => $dataToken['token_type'],
                'expires_in' => $dataToken['expires_in'],
                'access_token' => $dataToken['access_token'],
                'refresh_token' => $dataToken['refresh_token'],
                'user_info' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email
                ],
            ], 200);
        }

        return $this->responseFailed(__('Login failed'), 401);
    }

    public function logout()
    {
        $user = Auth::guard('api')->user()->token();
        $user->revoke();

        return $this->responseSuccess(__('Logout'), [], 200);
    }
}
