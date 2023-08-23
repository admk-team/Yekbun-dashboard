<?php

namespace App\Http\Controllers\Api;

use Share;
use App\Models\Feed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reaction;

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


    public function fetch_feed(Request $request , $id = "")
    {

        $offset = $request->offset;
        $limit = $request->limit;

        $feedsQuery = Feed::with(['background', 'user']);
        $feedsQuery->offset($offset)->limit($limit);
        $feeds = $feedsQuery->get();


        if ($feeds->isNotEmpty()) {
            $feeds->each(function ($feed) use ($id) {
                $feed->media = json_decode($feed->media);

                if ($id !== "") {
                    $reaction_exist = Reaction::where('user_id', $id)->where('feed_id', $feed->id)->first();

                    if ($reaction_exist !== null) {
                        $feed->reaction = $reaction_exist;
                    }
                }
            });
        }

        $data = $feeds->filter(function ($item) {
            return $item->user !== null;
        });
        
        $response = ['success' => true, 'data' => $data];

        if(!$data->isEmpty()){
            $existFeed = Feed::find(++$data[sizeof($data) - 1]->id);
            if($existFeed == "")
            {
                $response['completed'] = true;
            }
        }
        

        return response()->json($response);
    }



    public function get_feed_bg($id)
    {

        $feed_bg = Feed::select('media')->where('user_id', $id)->get();
        if (isset($feed_bg)) {

            // Create an empty array to store the converted data
            $convertedDataArray = [];

            // Loop through the array and convert the "media" values
            foreach ($feed_bg as $data) {
                $mediaArray = json_decode($data->media, true);
                foreach ($mediaArray as $media) {
                    if ($media['type'] == 0) {
                        $convertedDataArray[] = $media['path'];
                    }
                }
            }

            $images = array_slice($convertedDataArray, 0, 4);
            return ['success' => true, 'data' => $convertedDataArray];
        }

        return ['success' => false, 'message' => 'No image found..'];
    }

    public function get_all($id)
    {
        $feed_bg = Feed::select('media')->where('user_id', $id)->get();

        if (isset($feed_bg)) {

            // Create an empty array to store the converted data
            $convertedDataArray = [];

            // Loop through the array and convert the "media" values
            foreach ($feed_bg as $data) {
                $mediaArray = json_decode($data->media, true);

                foreach ($mediaArray as $media) {
                    if ($media['type'] == 0) {
                        $convertedDataArray[] = $media['path'];
                    }
                }
            }

            return ['success', true, 'data' => $convertedDataArray];
        }

        return ['success' => false, 'message' => 'No image found..'];
    }

    public function get_feed_background_video($id)
    {
        $feed_video = Feed::select('media')->where('user_id', $id)->get();

        if (isset($feed_video)) {
            // create empty array
            $converteedDataArray = [];

            foreach ($feed_video as $data) {
                $mediaArray = json_decode($data->media, true);

                foreach ($mediaArray as $media) {
                    if ($media['type'] == 1) {
                        $convertedDataArray[] = $media['path'];
                    }
                }
            }

            $videos = array_slice($convertedDataArray, 0, 4);
            return response()->json(['success' => true, 'data' => $videos]);
        }
        return ['error' => false, 'message' => 'No video found .'];
    }

    public function get_all_feed_videos($id)
    {
        $feed_videos = Feed::select('media')->where('user_id', $id)->get();

        if (isset($feed_videos)) {
            $convertedDataArray = [];
            foreach ($feed_videos as $data) {
                $mediaArray = json_decode($data->media, true);
                foreach ($mediaArray as $media) {
                    if ($media['type'] == 1) {
                        $convertedDataArray[] = $media['path'];
                    }
                }
            }
            return ['success' => true, 'data' => $convertedDataArray];
        }
        return ['success'  => false, 'message' => 'No videos found..'];
    }

    public function get_feed_media($id)
    {
        $feed = Feed::find($id);

        if ($feed == '')
            return response()->json(['success' => false, 'message' => 'No feed found by the id.']);

        $media = json_decode($feed->media);

        return response()->json(['success' => true, 'data' => $media]);
    }

    public function feed_media_delete(Request $request)
    {
        $feeds = Feed::where('user_id', $request->user_id)->get();

        foreach ($feeds as $feed) {
            $media = json_decode($feed->media);

            foreach ($media as $item) {
                if ($item->path == $request->path) {
                    $media_feed = Feed::find($feed->id);

                    $feed_media = collect(json_decode($media_feed->media));

                    $updated_media = $feed_media->filter(function ($single_media) use ($request) {
                        return $single_media->path !== $request->path;
                    });

                    $new_media = array_values($updated_media->toArray());

                    $media_feed->media = $new_media;
                    $media_feed->save();

                    return response()->json(['success' => true, 'message' => 'Successfully deleted.']);
                }
            }
        }

        return response()->json(['success' => false, 'message' => 'Not found.']);
    }
}
