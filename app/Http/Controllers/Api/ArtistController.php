<?php

namespace App\Http\Controllers\Api;

use App\Models\Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistController extends Controller
{
    public function get_all_artist_music(){
        
        $artist = Artist::select('id','first_name' , 'last_name')->withCount('musics')->get();

        if($artist->isEmpty()){
            return response()->json(['success' => false , 'data' => []]);
        }else{
            return response()->json(['success' => true , 'data' => $artist]);
        }
    }

    public function get_single_artist_music($id) {

        $artist = Artist::select('id','image','first_name' , 'last_name')->with('musics')->where('id' , $id)->first();
        if(is_null($artist)){
            return response()->json(['success' => false , 'data' => [] ]);
        }else{
            return response()->json(['success' => true , 'data' => $artist]);
        }

    }
}
