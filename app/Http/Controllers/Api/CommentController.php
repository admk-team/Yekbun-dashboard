<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store_comments(Request $request){

        $request->validate([
            'user_id' => 'required'
        ]);

        $comment = new Comment();
        $comment->user_id  = $request->user_id;
        $comment->type = $request->type;
        
    }
}
