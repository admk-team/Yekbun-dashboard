<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AnimationEmoji;
use App\Http\Controllers\Controller;

class AnimationEmojiController extends Controller
{
    public function get_all_emoji(){

        $emoji = AnimationEmoji::get();
        if($emoji->isEmpty()){
            return response()->json(['success' => false , 'data' =>  $emoji]);
        }else{
            
            $emojiArray = $emoji->toArray(); 
            $collectionLength = count($emojiArray);
            $splitData = array_chunk($emojiArray, 4);
            return response()->json(['success' =>true, 'data' => $splitData]);
        }
    }
}
