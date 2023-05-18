<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function index(){
     
        return view('content.admin_profile.index');
    }

    public function store(Request $request){
         
        $profile = User::find(auth()->user()->id);
        $profile->fname  = $request->FirstName;
        $profile->lname = $request->LastName;
        $profile->username = $request->Name;
        $profile->name = $request->FirstName.' '.$request->LastName;
        $profile->number = $request->Phone;

        if($profile->update()){
            return back()->with('success', 'Your profile has been updated');
        }else{
            return back()->with('error', 'Failed to Update your profile');
        }

    }

    public function security(){
        return view('content.pages.pages-account-settings-security');
    }
    public function account(){
        return view('content.pages.pages-account-settings-account');
    }
    public function billing(){
        return view('content.pages.pages-account-settings-billing');
    }
    public function notification(){
        return view('content.pages.pages-account-settings-notifications');
    }
    public function connection(){
        return view('content.pages.pagesss-account-settings-connections');
    }

    public function change_password(Request $request)
    {
            
        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required'
        ]);

        if(!Hash::check($request->currentPassword, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }else{
            if($request->newPassword == $request->confirmPassword){
             
                 User::whereId(auth()->user()->id)->update([
                        'password' => Hash::make($request->newPassword)
                    ]);
                    return back()->with("success", "Password changed successfully!");
                
             }else{
                return back()->with('error', 'Your New Password  and Confirm Password  is not matched');
             }
        }
    }       
}
