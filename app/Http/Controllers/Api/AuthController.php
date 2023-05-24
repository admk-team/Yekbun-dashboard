<?php

namespace App\Http\Controllers\Api;

use session;
use App\Models\User;
use App\Models\UserCode;
use App\Mail\SendCodeMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('Yekhbun')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function signup(Request $request)
    {
        return 'wokring';
        $validatedData = $request->validate([
            'username' => 'required|max:100',
            'firstName' => 'required|max:100',
            'lastName' => 'required|max:100',
            'image' => 'required',
            'gender' => 'required',
            'dob'=> 'required',
            'location' => 'required|max:255',
            'province' => 'required|max:255',
            'city' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6',
        ]);

        $images = $request->image;
        if($request->file('image')){
            $path = $request->file('image')->store('/images/user/','public');
            $images = $path;
        }

        $user = User::create([
            'username' => $validatedData['username'],
            'fname' => $validatedData['fname'],
            'lname' => $validatedData['lname'],
            'image' => $images,
            'name' => $validatedData['fname'].''.$validatedData['lname'],
            'gender' => $validatedData['gender'],
            'dob' => $validatedData['dob'],
            'address' => $validatedData['address'],
            'province'=> $validatedData['province'],
            'city' => $validatedData['city'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
      
        if($user->id){
            $code = rand(1000, 9999);
            UserCode::updateOrCreate(
                [ 'user_id' =>$user->id],
                [ 'code' => $code]
            );
        
            try {
                $details = [
                    'title' => 'Mail from Yekbun.com',
                    'code' => $code
                ];
                
                Mail::to($validatedData['email'])->send(new SendCodeMail($details));

                return response()->json(["message"=>"Verfication Code sent to your email",'user_id' => $user->id , $user->email], 201);
            } catch (Exception $e) {
                info("Error: ". $e->getMessage());
            }
        }

        // $token = $user->createToken('Yekhbun')->accessToken;
        return response()->json(['errors' => 'something missing'], 422);
    }



    // public function forgot_password(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }

    //     $response = Password::sendResetLink($request->only('email'));

    //     if ($response == Password::RESET_LINK_SENT) {
    //         return response()->json(['message' => 'Password reset link sent on your email id.']);
    //     } else {
    //         return response()->json(['message' => 'Unable to send password reset link'], 500);
    //     }
    // }
    // public function reset($token){
    //     return response()->json(['token' => $token], 200);
    // }

    // public function reset(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|string|confirmed|min:8',
    //         'token' => 'required|string',
    //     ]);

    //     $response = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
    //         $user->forceFill([
    //             'password' => bcrypt($password),
    //             'remember_token' => Str::random(60),
    //         ])->save();

    //         event(new PasswordReset($user));
    //     });

    //     if ($response === Password::PASSWORD_RESET) {
    //         return response()->json(['message' => 'Password reset successful'], 200);
    //     } else {
    //         return response()->json(['message' => 'Unable to reset password'], 400);
    //     }
    // }

}
 