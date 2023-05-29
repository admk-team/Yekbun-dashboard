<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class PrivacyAndPolicyController extends Controller
{
    public function privacy(){

        $policy  = Setting::where('name' , 'privacy_policy')->first();
        $description = json_decode($policy->description);
        return response()->json([ 'success' => true ,  'data' => $description]);
    }

}



