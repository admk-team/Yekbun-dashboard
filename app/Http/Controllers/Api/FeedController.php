<?php

namespace App\Http\Controllers\Api;

use Share;
use App\Models\Feed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedController extends Controller
{
    public function shareWidget()
    {
        $shareComponent = Share::page('https://www.codesolutionstuff.com/generate-rss-feed-in-laravel/', 'dummy text')
            ->facebook()
            ->whatsapp()
            ->twitter()
            ->linkedin()
            ->reddit()
            ->telegram();

        return view('content.dummy', compact('shareComponent'));
    }

    public function add_feed(Request $request)
    {
        
        $feed = new Feed();
        $feed->title = $request->title ?? '';
        $feed->description = $request->description;
        $feed->type = $request->type;
        $feed->status = $request->status;

        if ($request->has('backgroundId'))
            $feed->background_id = $request->backgroundId;

        if ($request->has('userId'))
            $feed->user_id = $request->userId;

        if ($request->has('fanpageId'))
            $feed->fanpage_id = $request->fanpageId;

        $feed->media = $request->has('media') ? json_encode($request->media) : '{}';

        if ($feed->save()) {   
            return response()->json(['success' => true, 'message' => 'Feed successfully added.']);
        } else {
            return response()->json(['success' => false, 'data' => 'Failed to add feed.']);
        }
    }

    public function get_first_feed($user_id)
    {
        $feed = Feed::where('user_id', $user_id)->with(['background', 'user'])->first();
        if (isset($feed)) {
            $feed->media = json_decode($feed->media);
            return response()->json(['success' => true, 'data' => $feed]);
        }
    }

    public function get_feed($user_id)
    {
        $feeds = Feed::with(['background', 'user'])->where('user_id', $user_id)->get();

        if ($feeds != '[]')
            foreach ($feeds as $feed) {
                $feed->media = json_decode($feed->media);
            }

        return response()->json(['success' => true, 'data' => $feeds]);
    }

    public function fetch_feed()
    {
        $feeds = Feed::inRandomOrder()->take(8)->with(['background', 'user'])->get();

        if ($feeds != '[]')
            foreach ($feeds as $feed) {
                $feed->media = json_decode($feed->media);
            }

        $data = $feeds->filter(function ($item) {
            return $item->user !== null;
        });


        return response()->json(['success' => true, 'data' => $data]);
    }

    public function get_feed_bg($id){
        $feed_bg = Feed::select('media')->where('user_id' , $id)->get();
        if(isset($feed_bg)){
            if( (json_decode($feed_bg[0]->media) !== null )){
                $json = json_decode($feed_bg[0]->media);
                $images = array_slice($json , 0 , 4);
                return response()->json(['success' => true , 'data' => $images]);
            }
            return response()->json(['success' => false , 'message' => 'No image found..']);
        }
        return response()->json(['success' => false , 'message' => 'No image about to that user.']);
        
    }

    public function get_all($id){
        $feed_bg = Feed::select('media')->where('user_id' , $id)->get();
        if(isset($feed_bg)){
            if(json_decode($feed_bg[0]->media) !== null){
                $images = json_decode($feed_bg[0]->media);
                return response()->json(['success' => true  , 'data' => $images]);
            }
            return response()->json(['success' => false , 'message' => 'No image found..']);

        }
        return response()->json(['success' => false , 'message' => 'No image about to that user.']);

    }


}
