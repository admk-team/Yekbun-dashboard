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
        "emoji_id",
        "audio_path"
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

    public function get_comment($type, $id)
    {
        $comments = Comment::where($type, $id)
            ->with(['user' => function ($query) {
                $query->select('id', 'name', 'image');
            }])
            ->get();

        $formattedComments = $comments->map(function ($comment) {
            $comment->time = $this->formatCreatedAt($comment->created_at);
            return $comment;
        });

        return response()->json(['success' => true, 'data' => $formattedComments]);
    }

    private function formatCreatedAt($createdAt)
    {
        $now = time();
        $createdAtTimestamp = strtotime($createdAt);
        $diffInSeconds = $now - $createdAtTimestamp;

        if ($diffInSeconds >= 31536000) {
            $years = floor($diffInSeconds / 31536000);
            return $years . ' yr' . ($years > 1 ? 's' : '');
        } elseif ($diffInSeconds >= 2592000) {
            $months = floor($diffInSeconds / 2592000);
            return $months . ' mon' . ($months > 1 ? 's' : '');
        } elseif ($diffInSeconds >= 86400) {
            $days = floor($diffInSeconds / 86400);
            return $days . ' day' . ($days > 1 ? 's' : '');
        } elseif ($diffInSeconds >= 3600) {
            $hours = floor($diffInSeconds / 3600);
            return $hours . ' hr' . ($hours > 1 ? 's' : '');
        } elseif ($diffInSeconds >= 60) {
            $minutes = floor($diffInSeconds / 60);
            return $minutes . ' min' . ($minutes > 1 ? 's' : '');
        } else {
            return 'Just now';
        }
    }
}
