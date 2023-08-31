<?php

namespace App\Http\Controllers\Api;

use App\Models\Reaction;
use Illuminate\Http\Request;
use App\Models\AnimationEmoji;
use App\Http\Controllers\Controller;

class AnimationEmojiController extends Controller
{
    public function get_all_emoji($userId=0,$type=''){

        $emoji = AnimationEmoji::get();
        if($emoji->isEmpty()){
            return response()->json(['success' => false , 'data' =>  $emoji]);
        }else{
            $exist = false;
            if($userId != '' & $type != '' ){
                
                $reaction_exists = Reaction::where('user_id',$userId)->whereNotNull($type.'_id')->first();
                if($reaction_exists != ''){
                    $exist = true;
                }
            }
            $emojiArray = $emoji->toArray(); 
            $collectionLength = count($emojiArray);
            $splitData = array_chunk($emojiArray, 4);
            return response()->json(['success' =>true, 'data' => $splitData , 'exist' => $exist]);
        }
    }
}
