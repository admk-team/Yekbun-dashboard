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
        
            // Create an empty array to store the converted data
            $convertedDataArray = [];

            // Loop through the array and convert the "media" values
            foreach ($feed_bg as $data) {
                $mediaArray = json_decode($data->media , true );
                        foreach ($mediaArray as $media) {
                            if($media['type'] == 0){
                            $convertedDataArray[] = $media['path'];
                            }
                        }
            }

            $images = array_slice($convertedDataArray , 0 , 4);
            return ['success' => true, 'data' => $convertedDataArray];
        }

        return ['success' => false , 'message' => 'No image found..'];
    }

    public function get_all($id){
      
        $feed_bg = Feed::select('media')->where('user_id' , $id)->get();
    
        if(isset($feed_bg)){
        
            // Create an empty array to store the converted data
            $convertedDataArray = [];

            // Loop through the array and convert the "media" values
            foreach ($feed_bg as $data) {
                $mediaArray = json_decode($data->media , true );
            
                foreach ($mediaArray as $media) {
                    if($media['type'] == 0){
                         $convertedDataArray[] = $media['path'];
                    }
                }
            }

            return ['success' , true , 'data' => $convertedDataArray];
        }

        return ['success' => false , 'message' => 'No image found..'];

    }

    public function get_feed_background_video($id){
        $feed_video = Feed::select('media')->where('user_id' , $id)->get();

        if(isset($feed_video)){
            // create empty array
            $converteedDataArray = [];
            
            foreach($feed_video as $data){
                $mediaArray = json_decode($data->media , true);

                foreach($mediaArray as $media){
                    if($media['type'] == 1){
                        $convertedDataArray[] = $media['path'];
                    }
                }
            }

            $videos = array_slice($convertedDataArray , 0 , 4);
            return response()->json(['success' => true , 'data' => $videos]);
        }
        return ['error' => false , 'message' => 'No video found .'];
    }

    public function get_all_feed_videos($id){
        $feed_videos = Feed::select('media')->where('user_id' , $id)->get();

        if(isset($feed_videos)){
            $convertedDataArray = [];
            foreach($feed_videos as $data){
                $mediaArray = json_decode($data->media , true);
                foreach($mediaArray as $media){
                    if($media['type'] == 1){
                        $convertedDataArray[] = $media['path'];
                    }
                }
            }
            return ['success' => true, 'data' => $convertedDataArray];
        }
        return ['success'  => false , 'message' => 'No videos found..'];
    }
}
