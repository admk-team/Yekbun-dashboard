<?php

namespace App\Http\Controllers\Api;

use Share;
use App\Models\Feed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedController extends Controller
{

    public function shareWidget(){
        $shareComponent =  Share::page('https://www.codesolutionstuff.com/generate-rss-feed-in-laravel/','dummy text')
        ->facebook()
        ->whatsapp()
        ->twitter()
        ->linkedin()
        ->reddit()
        ->telegram();

        return view('content.dummy' , compact('shareComponent'));
    }

    public function add_feed(Request $request){
           
        $feed = new Feed();
        $feed->title = $request->title;
        $feed->description = $request->description;
        $feed->type = $request->type;
        $feed->status = $request->status;
   
        $feed->media = json_encode($request->media);
    
        if($feed->save()){
            return response()->json(['success' => true , 'data' => $feed]);
        }else{
            return response()->json(['success' => false , 'data' => $feed]);
        }
    }

    
}
