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
}
