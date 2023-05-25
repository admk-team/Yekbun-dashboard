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

        for($i=0; $i<sizeof($province); $i++){
            $province[$i]->cities = $province[$i]->cities;
        }

        if(isset($province)){
            return response()->json(['success' => true, "data" => $province]);
        }else{
            return response()->json(['error' => false , "data" => "No Province Available"]);
        }
    }

    // public function city($provinceId){

    //     $city = City::where('region_id'  , $provinceId)->get();
    //     if(isset($city)){
    //         return response()->json(['success' => true, "data" =>$city]);
    //     }else{
    //         return response()->json(['error'=>false , "data" => "No City Available for that Province"]);
    //     }
    // }
}
