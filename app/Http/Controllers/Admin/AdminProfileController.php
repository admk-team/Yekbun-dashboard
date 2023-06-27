<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;

class AdminProfileController extends Controller
{
    public function index(){
        
        
        $activity = Auth::user()->actions()->orderBy('created_at', 'DESC')->paginate(20);
        return view('content.admin_profile.index', compact("activity"));
    }

    public function store(Request $request){
         
        $profile = User::find(auth()->user()->id);
        $profile->username = $request->Name;
        $profile->email  = $request->Email;
        if($request->has('image')){
            if(isset($profile->image)){
                $path = public_path('storage/'.$profile->image);
                if(file_exists($path)){
                    unlink($path);
                }
            }
            $image_paht = $request->file('image')->store('/images/user','public');
            $profile->image = $image_paht;
       
        }
        if($profile->update()){
            return back()->with('success', 'Your profile has been updated');
        }else{
            return back()->with('error', 'Failed to Update your profile');
        }

    }

    public function security(){
        return view('content.pages.pages-account-settings-security');
    }

    public function enable(Request $request){
        
        if($request->has('enable')){
             auth()->user()->enable_2fa  = true;
             auth()->user()->save();
             return back()->with('success', 'Two Factor Authentication Enabled');
        }else{
            auth()->user()->enable_2fa  = false;
            auth()->user()->save();
            return back()->with('error', 'Two Factor Authentication Disabled');
        }
        
    }

    public function account(){
        $activity = Auth::user()->actions()->orderBy('created_at', 'DESC')->paginate(20);
        
        return view('content.pages.pages-account-settings-account' , compact('activity'));
    }
    public function billing(){
        return view('content.pages.pages-account-settings-billing');
    }
    public function notification(){
        return view('content.pages.pages-account-settings-notifications');
    }
    public function connection(){
        return view('content.pages.pages-account-settings-connections');
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
