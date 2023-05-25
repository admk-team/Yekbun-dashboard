<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\City;

class CountryController extends Controller
{
    public function province(){
        $province = Region::orderBy('id' , 'desc')->get();
        if(isset($province)){
            return response()->json(['success' => true, "Message" => $province]);
        }else{
            return response()->json(['error' => false , "Message" => "No Province Available"]);
        }
    }

    public function city($provinceId){

        $city = City::where('region_id'  , $provinceId)->get();
        if(isset($city)){
            return response()->json(['success' => true, "Message" =>$city]);
        }else{
            return response()->json(['error'=>false , "Message" => "No City Available for that Province"]);
        }
    }
}
