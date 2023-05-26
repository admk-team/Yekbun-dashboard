<?php

namespace App\Http\Controllers\Api;

use session;
use App\Models\User;
use App\Models\UserCode;
use App\Models\ResetUserPassword;
use App\Mail\SendCodeMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
      $user = Auth::user();

            if ($user->status == 0)
                return response()->json(['success' => false, 'message' => 'Your email is not verified.']);

            $token = explode('|', $user->createToken('Yekhbun')->plainTextToken)[1];

      return response()->json(['success' => true, 'data' => ['user' => $user, 'token' => $token]], 200);
    } else {
      return response()->json(['success' => false, 'message' => 'Email or password is incorrect.']);
    }
  }
  
  public function signup(Request $request)
  {
    $validatedData = $request->validate([
      'username' => 'required|max:100',
      'firstName' => 'required|max:100',
      'lastName' => 'required|max:100',
      'gender' => 'required',
      'dob' => 'required',
      'location' => 'required|max:255',
      'province' => 'required|max:255',
      'city' => 'required|max:255',
      'email' => 'required',
      'password' => 'required|min:6',
    ]);

    $userExist = User::where('email', $request->email)->first();

    if ($userExist) {
      return response()->json([
        'success' => false,
        'message' => 'Email is already taken.',
      ]);
    }

        $user = User::create([
            'username' => $validatedData['username'],
            'firstName' => $validatedData['firstName'],
            'lastName' => $validatedData['lastName'],
            'image' => $validatedData['image'] ?? '',
            'name' => $validatedData['firstName'] . ' ' . $validatedData['lastName'],
            'gender' => $validatedData['gender'],
            'dob' => $validatedData['dob'],
            'location' => $validatedData['location'],
            'province' => $validatedData['province'],
            'city' => $validatedData['city'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'status' => 0
        ]);

        if ($user->id) {
            $code = rand(1000, 9999);
            UserCode::updateOrCreate(
                ['user_id' => $user->id],
                ['code' => $code]
            );
            try {
                $details = [
                    'title' => 'Mail from Yekbun.com',
                    'code' => $code
                ];

                Mail::to($validatedData['email'])->send(new SendCodeMail($details));

                return response()->json(['success' => true, "message" => "Verfication Code sent to your email", 'data' => $user->id], 201);
            } catch (Exception $e) {
                info("Error: " . $e->getMessage());
            }
        }
    }

    public function forgot_password(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
    
        $user = User::where('email', '=', $request->email)->first();
        if(!$user){
            return response()->json(['success' => false, 'message' => 'No user found with the email.']);
        }
    
        // Generate Random Code
    
        $code = rand(1000, 9999);
        $token  = Str::random(20);
        ResetUserPassword::updateorCreate(['user_id' => $user->id, 'email' => $user->email ] , ['code' => $code,'user_id' => $user->id,'token' => $token,'email' => $user->email ]);
        try {
            $details = [
              'title' => 'Mail from Yekbun.com',
              'code' => $code,
            ];
            Mail::to($user->email)->send(new SendCodeMail($details));
            return response()->json(['success' => true,'message' => 'A verification email has been sent to '.$user->email.'!', 'data' => ['user_id'=>$user->id ,'email' => $user->email , 'token' => $token ]],201);
          } catch (Exception $e) {
            info('Error: ' . $e->getMessage());
          }
    
    }

  
    public function resetpassword(Request $request){
        $user  = ResetUserPassword::where('user_id', $request->user_id)->first();
        if($user->password_token != $request->token)
             return response()->json(['success' =>false , 'message' => 'Something went wrong']);
    
        $user = User::find($request->user_id);
        if($user == '')
        return response()->json(['success' =>false , 'message' => 'User Not found.']);
    
        if(!password_verify($request->password, $user->password))
        return response()->json(['success'=>false , 'message' =>'Current password is incorrect.']);
    
        $user->password = bcrypt($request->new_password);
        $user->save();
        return response()->json(['success'=>true , 'message' =>'Your password has been reset successfully.']);
    
      }
  
  public function reset(Request $request)
  {
    $request->validate([
        'code' => 'required',
    ]);

    $user = ResetUserPassword::where('user_id', $request->user_id)->first();
   if($user !== ""){
    if($request->token != $user->token)
        return response()->json(['success' => false , 'message' => 'Something went wrong.' ]);

            if($user->code == $request->code){
                $password_token = Str::random(50);
                $user->password_token = $password_token;
                $user->save();
                return response()->json(['success' => true , 'data' => ['token' => $password_token , 'user_id' => $user->user_id ]]);
            }else{
                return response()->json(['success' => false , 'message' => 'OTP code is incorrect.' ]);
            }
        }
    else{
        return response()->json(['success' => false , 'message' => 'User not found.']); 
    }

  }

  public function reset_resend(Request $request)
  {
      $user = ResetUserPassword::where('user_id', $request->user_id)->first();
      
      $code = rand(1000, 9999);

      try {

          $details = [
              'title' => 'Mail from Yekbun.com',
              'code' => $code
          ];

          Mail::to($user->email)->send(new SendCodeMail($details));

          $user->code = $code;
          $user->save();

          return response()->json(['success' => true, "message" => "A verification email has been resent to your email."]);
      } catch (Exception $e) {
          info("Error: " . $e->getMessage());
      }
  }


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











//   $validator = Validator::make($request->all(), [
    //       'email' => 'required|email',
    //   ]);

    //   if ($validator->fails()) {
    //       return response()->json(['errors' => $validator->errors()], 422);
    //   }

    //   $response = Password::sendResetLink($request->only('email'));

    //   if ($response == Password::RESET_LINK_SENT) {
    //       return response()->json(['message' => 'Password reset link sent on your email id',"email" => $request->email]);
    //   } else {
    //       return response()->json(['message' => 'Unable to send password reset link'], 500);
    //   }