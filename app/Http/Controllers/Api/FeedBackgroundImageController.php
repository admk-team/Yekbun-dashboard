<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackgroundFeed;


class FeedBackgroundImageController extends Controller
{
    public function upload(Request $request){
        
        $feed = new BackgroundFeed();
        $feed->title = $request->title;
        $feed->image = $request->image;
        if($feed->save()){
            return response()->json(['success' => true , 'data' =>$feed]);
        }else{
            return response()->json(['success' => false , 'data' =>$feed]);
        }
    }

    public function get(){

        $feed = BackgroundFeed::get();
        return response()->json(['success' => true , 'data' =>$feed]);
    }
}
