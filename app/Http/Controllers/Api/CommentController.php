<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $fields = [
        "user_id",
        "post_id",
        "parent_id",
        "content",
        "status",
        "type",
        "feed_id",
        "news_id",
        "history_id",
        "vote_id",
        "music_id",
        "emoji_id"
    ];

    public function store_comment(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'content' => 'required',
            'type' => 'required',
        ]);

        $comment = new Comment;

        foreach ($this->fields as $item) {
            if ($request->has($item))
                $comment[$item] = $request[$item];
        }

        $comment->save();

        return response()->json(['success' => true, 'data' => $comment, 'message' => 'Comment saved.']);
    }
}
