<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{

  protected $fileds = [
        "user_id",
        "playlist_name",
        "visibility",
        "music_id",
        "feed_id",
        "vote_id",
        "news_id",
        "history_id"
    ];

    public function playlist(Request $request){
        return $request;
        $request->validate([
            'user_id' => 'required',
            'playlist_name' => 'required',
            'visibility' => 'required'
        ]);

        $playlist = new Playlist();
        foreach($this->fileds as $filed){
            if($request->has($filed)){
                $playlist[$filed] = $request[$filed];      
            }
        }
        if($playlist->save()){
            return response()->json(['success' => true , 'message' => 'Playlist saved successfully.']);
        }else{
            return response()->json(['success' => false , 'message' => 'Failed to add playlist.']);
        }

    }

    public function get_playlist($id){

        // $playlist = Playlist::find($id);
        if(isset($playlist)){
            return response()->json(['success' => true , 'data' => $playlist]);
        }else{
            return response()->json(['success' => false , 'data' => $playlist]);
        }
    }
}
