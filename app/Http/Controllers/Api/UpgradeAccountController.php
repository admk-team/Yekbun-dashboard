<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpgradeAccountController extends Controller
{
    
    public function price_upgrade(){
        $settings = Setting::whereIn('name', ['premium_price', 'vip_price'])
    ->pluck('value', 'name')
    ->toArray();
    return response()->json(['success' => true , 'data' => $settings]);
    }

    public function account_upgrade(Request $request){
        $user = User::where('id' ,auth()->user()->id)->first();
        $user->level = $request->level;
        $user->save();
        return response()->json(['success' => 'true' , 'message' => 'Account upgrade successfully']);
    }
}
