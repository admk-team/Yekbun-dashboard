<?php

namespace App\Http\Controllers\Api;

use Share;
use App\Models\Feed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostGallery;
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
        // $post->type = $request->type;
        $post->status = $request->status;

        if ($request->has('backgroundId'))
            $post->background_id = $request->backgroundId;

        if ($request->has('userId'))
            $post->user_id = $request->userId;

        if ($request->has('fanpageId'))
            $post->fanpage_id = $request->fanpageId;

        $post->media = $request->has('media') ? json_encode($request->media) : '{}';

        if ($post->save()) {
            $id = $post->id;
            foreach($request->media  as $media){
                $mediaType = $media['type'];
                $mediaGallery = $media['url'];
                $post_gallery = new PostGallery();
                $post_gallery->post_id = $id;
                $post_gallery->media_url = $mediaGallery;
                $post_gallery->media_type =$mediaType;
                $post_gallery->user_id = $request->userId;
                if($request->has('news_id')){
                    $post_gallery->news_id = $request->news_id;
                }
                if($request->has('vote_id')){
                    $post_gallery->post_id = $request->post_id;
                }
                if($request->has('history_id')){
                    $post_gallery->history_id = $request->history_id;
                }
                $post_gallery->save();
            }

            return response()->json(['success' => true, 'message' => 'post successfully added.']);
        } else {
            return response()->json(['success' => false, 'data' => 'Failed to add post.']);
        }
    }

    public function get_first_feed($user_id)
    {
        $post = Post::where('user_id', $user_id)->with(['background', 'user' , 'gallery'])->first();
        if (isset($post)) {
            $post->media = json_decode($post->media);
            return response()->json(['success' => true, 'data' => $post]);
        }
    }

    public function get_feed($user_id)
    {
        $posts = Post::with(['background', 'user' , 'gallery'])->where('user_id', $user_id)->get();

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

        $postsQuery = Post::with(['background', 'user' , 'gallery']);
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


    // Feed image get

    public function get_feed_bg($id)
    {

        // $post_bg = Post::select('media')->where('user_id', $id)->get();
        $post_bg = PostGallery::select('media_url' , 'media_type')->where('user_id', $id)->get();

        if (isset($post_bg)) {

            // Create an empty array to store the converted data
            $convertedDataArray = [];

            // Loop through the array and convert the "media" values
            foreach ($post_bg as $data) {
                    if ($data->media_type == 0) {
                        $convertedDataArray[] = $data->media_url;
                    }
            }

            $images = array_slice($convertedDataArray, 0, 4);
            return ['success' => true, 'data' => $images];
        }

        return ['success' => false, 'message' => 'No image found..'];
    }

    // Feed get all imge
    public function get_all($id)
    {
        // $post_bg = Post::select('media')->where('user_id', $id)->get();
        $post_bg = PostGallery::select('media_url','media_type')->where('user_id', $id)->get();

        if (isset($post_bg)) {

            // Create an empty array to store the converted data
            $convertedDataArray = [];

            // Loop through the array and convert the "media" values
            foreach ($post_bg as $data) {
                    if ($data->media_type == 0) {
                        $convertedDataArray[] = $data->media_url;
                    }
            }

            return ['success'=> true, 'data' => $convertedDataArray];
        }

        return ['success' => false, 'message' => 'No image found..'];
    }

    public function get_feed_background_video($id)
    {
        // $post_video = Post::select('media')->where('user_id', $id)->get();
        $post_video = PostGallery::select('media_url' , 'media_type')->where('user_id', $id)->get();

        if (isset($post_video)) {
            // create empty array
            $converteedDataArray = [];

            foreach ($post_video as $data) {
                    if ($data->media_type == 1) {
                        $converteedDataArray[] = $data->media_url;
                    }
            }

            $videos = array_slice($converteedDataArray, 0, 4);
            return response()->json(['success' => true, 'data' => $videos]);
        }
        return ['error' => false, 'message' => 'No video found .'];
    }

    public function get_all_feed_videos($id)
    {
        // $post_videos = Post::select('media')->where('user_id', $id)->get();
        $post_videos = PostGallery::select('media_url' , 'media_type')->where('user_id', $id)->get();

        if (isset($post_videos)) {
            $convertedDataArray = [];
            foreach ($post_videos as $data) {
                    if ($data->media_type == 1) {
                        $convertedDataArray[] = $data->media_url;
                    }
            }
            return ['success' => true, 'data' => $convertedDataArray];
        }
        return ['success'  => false, 'message' => 'No videos found..'];
    }

    public function get_feed_media($id)
    {
        $post = Post::find($id);
        $new_post = $post->load('gallery');
        return  $new_post;
        if ($post == '')
            return response()->json(['success' => false, 'message' => 'No post found by the id.']);

        $media = json_decode($post->media);

        return response()->json(['success' => true, 'data' => $media]);
    }


    // checking thisssssssssssss.................................................
    public function feed_media_delete(Request $request)
    {
    
        $feeds = Post::with('gallery')->where('user_id', $request->user_id)->get();

        foreach ($feeds as $feed) {
            $feed->delete(); 
            foreach ($feed->gallery as $gallery) {
                $gallery->delete();
            }
        }
        
        return response()->json(['success' => true, 'message' => 'Posts deleted successfully.']);
            
    }
}
