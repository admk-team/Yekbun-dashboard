<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function signup(Request $request)
    {
        
        $validatedData = $request->validate([
            'username' => 'required|max:100',
            'fname' => 'required|max:100',
            'lname' => 'required|max:100',
            'gender' => 'required',
            'dob'=> 'required',
            'address' => 'required|max:255',
            'province' => 'required|max:255',
            'city' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'username' => $validatedData['username'],
            'fname' => $validatedData['fname'],
            'lname' => $validatedData['lname'],
            'name' => $validatedData['fname'].''.$validatedData['lname'],
            'gender' => $validatedData['gender'],
            'dob' => $validatedData['dob'],
            'address' => $validatedData['address'],
            'province'=> $validatedData['province'],
            'city' => $validatedData['city'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        $token = $user->createToken('MyApp')->accessToken;
        return response()->json(['token' => $token], 201);
    }

    public function forgot_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $response = Password::sendResetLink($request->only('email'));

        if ($response == Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Password reset link sent on your email id.']);
        } else {
            return response()->json(['message' => 'Unable to send password reset link'], 500);
        }
    }
    // public function reset($token){
    //     return response()->json(['token' => $token], 200);
    // }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:8',
            'token' => 'required|string',
        ]);

        $response = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $user->forceFill([
                'password' => bcrypt($password),
                'remember_token' => Str::random(60),
            ])->save();

            event(new PasswordReset($user));
        });

        if ($response === Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Password reset successful'], 200);
        } else {
            return response()->json(['message' => 'Unable to reset password'], 400);
        }
    }

}
 