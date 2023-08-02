<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reaction;

class ReactionController extends Controller
{
    
    // store reaction 

    public function store_reaction(Request $request){
        $request->validate([
            'user_id' => 'required',
        ]);

        $reaction =  new Reaction();
        $reaction->user_id  = $request->user_id;
        $reaction->emoji_id = $request->emoji_id;

        if($request->has('feed_id')){
            $reaction->feed_id = $request->feed_id;
        }
        if($request->has('news_id')){
            $reaction->news_id = $request->news_id;
        }
        if($request->has('history_id')){
            $reaction->history_id = $request->history_id;
        }
        if($request->has('vote_id')){
            $reaction->vote_id = $request->vote_id;
        }
        if($request->has('music_id')){
            $reaction->music_id = $request->music_id;
        }

        if($reaction->save()){
            return response()->json(['success' => true , 'data' => $reaction]);
        }else{
            return response()->json(['success' => false , 'data' => $reaction]);
        }
        
    }
}
