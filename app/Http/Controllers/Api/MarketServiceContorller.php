<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\MarketCategory;
use App\Models\MarketService;
use App\Models\MarketSubCategory;

class MarketServiceContorller extends Controller
{
    // About Service Market
    public function service_ad(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $ads = new Ad();
        $ads->title = $request->title;
        $ads->user_id = $request->user_id;
        $ads->description  = $request->description;
        $ads->country = $request->country;
        $ads->city = $request->city;
        $ads->address = $request->address;
        $ads->code = $request->code;
        $ads->phone_no = $request->phone_no;

        if($ads->save()){
            return response()->json(['success' => true , 'message' => 'Serivce saved successfully.']);
        }else{
            return response()->json(['success' => false , 'message' => 'Failed to saved serice.']);
        }
    }

    // Categories Market 
    public function market_categories(Request $request){

      
       $categoryData = $request->input('category');
       $subcategoryData =  $request->input('sub_category');
       $servicesData = $request->input('services');

       MarketCategory::create([
            'mail_contact' => $categoryData['mail_contact'] ?? null,
            'message' => $categoryData['message'] ?? null
            ]);
        MarketSubCategory::create([
            'mail_contact' => $subcategoryData['mail_contact'] ?? null,
            'message' => $subcategoryData['message'] ?? null
        ]);
        MarketService::create([
            'mail_contact' => $servicesData['mail_contact'] ?? null,
            'message' => $servicesData['message'] ?? null
        ]);
       return response()->json(['success' => true , 'message' => 'Categories saved successfully']);
        
    }
}
