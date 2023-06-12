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
    public function change_password(Request $request){
        $request->validate([
          'OldPassword' => 'required',
        ]);
            if(!Hash::check($request->OldPassword , $request->user()->password)){
              return response()->json(['success'=>false , 'message'=>'Old password is incorrect']);
            }else{
              User::whereId($request->user()->id)->update([
                'password' => Hash::make($request->NewPassword)
              ]);
              return response()->json(['success'=>true, 'message'=>'Password successfully changed']);
            }
      }

      public function change_email(Request $request){
        $request->validate([
            'OldEmail' => 'required',
        ]);

        $user = User::where('email', $request->OldEmail)->first();
        if(!$user){
            return response()->json(['success'=>false , 'message'=>'Email is not valid.']);
        }else{
            if($request->NewEmail == $request->RepeatedNewEmail){
                $code = rand(1000 , 9999);
                UserCode::updateorCreate(
                    ['user_id' => $user->id],
                    ['code' => $code]
                );
                try{
                    $newEmail = $request->NewEmail;
                    $details = [
                        'title' => 'Mail from Yekhbun.org',
                        'code' => $code,
                        'username'=> $user->username ?? '',
                    ];
                    Mail::to($newEmail)->send(new SendCodeMail($details));
                    return response()->json(['success'=>true, 'message' => "Email Verfication code sent to your email" , 'data' => $user->id] , 201);
                }catch(\Exception $e){
                    info("Error: ".$e->getMessage());
                }
            }
        }
      }
}
