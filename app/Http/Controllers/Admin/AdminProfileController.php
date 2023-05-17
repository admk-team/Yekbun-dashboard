<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

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
}
