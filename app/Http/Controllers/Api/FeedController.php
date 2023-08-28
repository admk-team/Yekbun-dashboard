<?php

namespace App\Http\Controllers\Api;

use Share;
use App\Models\Feed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
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
        $post = new Post();
        $post->title = $request->title ?? '';
        $post->description = $request->description;
        $post->type = $request->type;
        $post->status = $request->status;

        if ($request->has('backgroundId'))
            $post->background_id = $request->backgroundId;

        if ($request->has('userId'))
            $post->user_id = $request->userId;

        if ($request->has('fanpageId'))
            $post->fanpage_id = $request->fanpageId;

        $post->media = $request->has('media') ? json_encode($request->media) : '{}';

        if ($post->save()) {
            return response()->json(['success' => true, 'message' => 'post successfully added.']);
        } else {
            return response()->json(['success' => false, 'data' => 'Failed to add post.']);
        }
    }

    public function get_first_feed($user_id)
    {
        $post = Post::where('user_id', $user_id)->with(['background', 'user'])->first();
        if (isset($post)) {
            $post->media = json_decode($post->media);
            return response()->json(['success' => true, 'data' => $post]);
        }
    }

    public function get_feed($user_id)
    {
        $posts = Post::with(['background', 'user'])->where('user_id', $user_id)->get();

        if ($posts != '[]')
            foreach ($posts as $post) {
                $post->media = json_decode($post->media);
            }

        return response()->json(['success' => true, 'data' => $posts]);
    }


    public function fetch_feed(Request $request , $id = "")
    {
        $offset = $request->offset;
        $limit = $request->limit;

        $postsQuery = Post::with(['background', 'user']);
        $postsQuery->offset($offset)->limit($limit);
        $posts = $postsQuery->get();


        if ($posts->isNotEmpty()) {
            $posts->each(function ($post) use ($id) {
                $post->media = json_decode($post->media);

                if ($id !== "") {
                    $reaction_exist = Reaction::where('user_id', $id)->where('feed_id', $post->id)->first();

                    if ($reaction_exist !== null) {
                        $post->reaction = $reaction_exist;
                    }
                }
            });
        }

        $data = $posts->filter(function ($item) {
            return $item->user !== null;
        });
        
        $response = ['success' => true, 'data' => $data];

        if(!$data->isEmpty()){
            $existPost = Post::find(++$data[sizeof($data) - 1]->id);
            if($existPost == "")
            {
                $response['completed'] = true;
            }
        }
        

        return response()->json($response);
    }



    public function get_feed_bg($id)
    {

        $post_bg = Post::select('media')->where('user_id', $id)->get();
        if (isset($post_bg)) {

            // Create an empty array to store the converted data
            $convertedDataArray = [];

            // Loop through the array and convert the "media" values
            foreach ($post_bg as $data) {
                $mediaArray = json_decode($data->media, true);
                foreach ($mediaArray as $media) {
                    if ($media['type'] == 0) {
                        $convertedDataArray[] = $media['path'];
                    }
                }
            }

            $images = array_slice($convertedDataArray, 0, 4);
            return ['success' => true, 'data' => $images];
        }

        return ['success' => false, 'message' => 'No image found..'];
    }

    public function get_all($id)
    {
        $post_bg = Post::select('media')->where('user_id', $id)->get();

        if (isset($post_bg)) {

            // Create an empty array to store the converted data
            $convertedDataArray = [];

            // Loop through the array and convert the "media" values
            foreach ($post_bg as $data) {
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
        $post_video = Post::select('media')->where('user_id', $id)->get();

        if (isset($post_video)) {
            // create empty array
            $converteedDataArray = [];

            foreach ($post_video as $data) {
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
        $post_videos = Post::select('media')->where('user_id', $id)->get();

        if (isset($post_videos)) {
            $convertedDataArray = [];
            foreach ($post_videos as $data) {
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
        $post = Post::find($id);

        if ($post == '')
            return response()->json(['success' => false, 'message' => 'No post found by the id.']);

        $media = json_decode($post->media);

        return response()->json(['success' => true, 'data' => $media]);
    }


    // checking thisssssssssssss.................................................
    public function feed_media_delete(Request $request)
    {
        return $request;
        $feeds = Post::where('user_id', $request->user_id)->get();
        foreach ($feeds as $feed) {
            $media = json_decode($feed->media);

            foreach ($media as $item) {
                if ($item->path == $request->path) {
                    $media_feed = Post::find($feed->id);

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
