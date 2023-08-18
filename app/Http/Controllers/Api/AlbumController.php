<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;

class AlbumController extends Controller
{
    public function new_albums()
    {
        $albums = Album::orderBy('created_at', 'desc')
            ->take(2)
            ->with('artist')
            ->select('id', 'title', 'artist_id', 'album', 'image')
            ->get();

        $updated_albums = $albums->map(function ($item) {
            $item->music_count = sizeof($item->album);
            return $item;
        });

        return response()->json(['success' => true, 'data' => $updated_albums]);
    }

    public function albums()
    {
        $albums = Album::orderBy('created_at', 'desc')
            ->take(2)
            ->select('id', 'title', 'album', 'image')
            ->get();

        $updated_albums = $albums->map(function ($item) {
            $item->music_count = sizeof($item->album);
            return $item;
        });

        return response()->json(['success' => true, 'data' => $updated_albums]);
    }

    public function albums_details($id)
    {
        $album = Album::with('artist')->find($id);

        $album->music_count = sizeof($album->album);

        return response()->json(['success' => true, 'data' => $album]);
    }
}
