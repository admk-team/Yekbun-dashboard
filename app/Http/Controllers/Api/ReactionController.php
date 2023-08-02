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

        if($request->has('feed_id')){
            $previous_reaction = Reaction::where('user_id', $request->user_id)->where('feed_id', $request->feed_id)->first();

            if ($previous_reaction != "")
                $reaction = $previous_reaction;
            
            $reaction->feed_id = $request->feed_id;
        }
        if($request->has('news_id')){
            $previous_reaction = Reaction::where('user_id', $request->user_id)->where('news_id', $request->news_id)->first();

            if ($previous_reaction != "")
                $reaction = $previous_reaction;
            
            $reaction->news_id = $request->news_id;
        }
        if($request->has('history_id')){
            $previous_reaction = Reaction::where('user_id', $request->user_id)->where('history_id', $request->history_id)->first();

            if ($previous_reaction != "")
                $reaction = $previous_reaction;
            
            $reaction->history_id = $request->history_id;
        }
        if($request->has('vote_id')){
            $previous_reaction = Reaction::where('user_id', $request->user_id)->where('vote_id', $request->vote_id)->first();

            if ($previous_reaction != "")
                $reaction = $previous_reaction;
            
            $reaction->vote_id = $request->vote_id;
        }
        if($request->has('music_id')){
            $previous_reaction = Reaction::where('user_id', $request->user_id)->where('music_id', $request->music_id)->first();

            if ($previous_reaction != "")
                $reaction = $previous_reaction;
            
            $reaction->music_id = $request->music_id;
        }

        $reaction->user_id = $request->user_id;
        $reaction->emoji_id = $request->emoji_id;

        if($reaction->save()){
            return response()->json(['success' => true , 'data' => $reaction]);
        }else{
            return response()->json(['success' => false , 'data' => $reaction]);
        }
        
    }
}
