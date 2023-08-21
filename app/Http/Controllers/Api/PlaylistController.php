<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\PlaylistMusic;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{



    protected $fileds = [
        "user_id",
        "playlist_name",
        "visibility",
        "is_music",
        "is_feed",
        "is_vote",
        "is_news",
        "is_history"
    ];

    public function playlist(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'playlist_name' => 'required',
            'visibility' => 'required'
        ]);

        $playlist = new Playlist();
        foreach ($this->fileds as $filed) {
            if ($request->has($filed)) {
                $playlist[$filed] = $request[$filed];
            }
        }
        if ($playlist->save()) {
            return response()->json(['success' => true, 'message' => 'Playlist saved successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to add playlist.']);
        }
    }

    public function get_playlist(Request $request)
    {
        $playlist = Playlist::where('user_id', $request->user_id)->where($request->type, 1)->with('PlaylistMusics')->get();
        if (isset($playlist)) {
            return response()->json(['success' => true, 'data' => $playlist]);
        } else {
            return response()->json(['success' => false, 'data' => $playlist]);
        }
    }

    public function set_music_to_playlist(Request $request) {
        $request->validate([
            'playlist_id' => 'required',
            'musics' => 'array'
        ]);
    
        $playlist = PlaylistMusic::where('playlist_id', $request->playlist_id)->first();

        if (!$playlist) {
            $playlist = new PlaylistMusic();
            $playlist->playlist_id = $request->playlist_id;
            $playlist->musics = [];
        }
    
        $existingMusics = collect($playlist->musics);
        $message = null;
        if(isset($request->musics)){

            foreach ($request->musics as $music) {
                if (!$existingMusics->contains($music)) {
                    $existingMusics->push($music);
                }else{
                    $message = 'Music Already Exists.';
                }
            }
        }
        $playlist->musics = $existingMusics->toArray();
        $playlist->save();
        if($message){
            
            return response()->json(['success'=> false , 'message' => 'Music Already exists.']);
        }
    
        $playlist->musics = $existingMusics;
        if ($playlist->save()) {
            return response()->json(['success' => true, 'message' => 'Music added to playlist.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to add music.']);
        }
    }
    


}
