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

        $playlist = Playlist::where('user_id', $request->user_id)->whereNotNull($request->type)->get();
        if (isset($playlist)) {
            return response()->json(['success' => true, 'data' => $playlist]);
        } else {
            return response()->json(['success' => false, 'data' => $playlist]);
        }
    }
}
