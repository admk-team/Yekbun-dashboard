<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\UserCode;
use App\Mail\SendCodeMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AccountSettingController extends Controller
{
  public function change_password(Request $request)
  // this is the code when user try to change your password.
  {
    $request->validate([
      'oldPassword' => 'required',

    ]);
    if (!Hash::check($request->oldPassword, $request->user()->password)) {
      return response()->json(['success' => false, 'message' => 'Old password is incorrect']);
    } else {
      User::whereId($request->user()->id)->update([
        'password' => Hash::make($request->password)
      ]);
      return response()->json(['success' => true, 'message' => 'Password successfully changed']);
    }
  }


  public function change_email(Request $request){

    // This is the code when user try to change your email..
    $request->validate([
      'OldEmail' => 'required|email',
      'NewEmail' => 'required|email',
      'RepeatedNewEmail' => 'required|email|same:NewEmail',
    ]);

    $code = UserCode::where('code' , $request->code)->first();
    if(isset($code)){

      $user = User::where('email' , $request->OldEmail)->first();
      if(isset($user)){

        $user->email = $request->NewEmail;
        $user->update();
        $code->delete($code->id);
        return response()->json(['success' => true, 'message' => 'Email successfully changed.']);

      }else{
        return response()->json(['success' => false, 'message' => 'Email is not valid.']);
      }

    }else{
      return response()->json(['success' => false , 'message' => 'Code is not valid.']);
    }

  }
  public function send_email_code(Request $request)
  {
    // First Run this Api to send the email that provided email.
    $request->validate([
      'OldEmail' => 'required|email',
    ]);

    $user = User::where('email', $request->OldEmail)->first();
    if (!$user) {
      return response()->json(['success' => false, 'message' => 'Email is not valid.']);
    } else {
      if ($request->NewEmail == $request->RepeatedNewEmail) {
        $code = rand(1000, 9999);
        UserCode::updateorCreate(
          ['user_id' => $user->id],
          ['code' => $code]
        );
        try {
          $details = [
            'title' => 'Mail from Yekhbun.org',
            'code' => $code,
            'username' => $user->username ?? '',
          ];
          Mail::to($request->NewEmail)->send(new SendCodeMail($details));
          return response()->json(['success' => true, 'message' => "Email Verfication code sent to your email", 'data' => ['user_id' =>$user->id , 'code' => $code]], 201);
        } catch (\Exception $e) {
          info("Error: " . $e->getMessage());
        }
      }
    }
  }

  public function resend_email_code(Request $request ){

    // This is the code when user click on resend button..
    $user = UserCode::with('user')->where('user_id', $request->user_id)->first();
    $code=  rand(1000, 9999);
    try{
      $details =[
        'title' => 'Mail from Yekhbun.org',
        'code' => $code,
        'username' => $user->user->username ?? '',
      ];
      Mail::to($request->NewEmail)->send(new SendCodeMail($details));
      $user->code = $code;
      $user->save();
      return response()->json(['success' => true, 'message' => "Email successfully resent. "]);
    }catch (\Exception $e){
      info("Error: " . $e->getMessage());
    }
  }
    
}