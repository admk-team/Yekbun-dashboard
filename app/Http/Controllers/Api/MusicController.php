<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Music;
use App\Models\MusicCategory;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function index(Request $request)
{
    // Music with latest uploads
    if ($request->has('latest_uploads')) {
        $latest = Music::with('artist:id,first_name,last_name,image')->latest()->get();

        if ($latest->isEmpty()) {
            return response()->json(['success' => false, 'data' => []]);
        } else {
            return response()->json(['success' => true, 'data' => $latest]);
        }
    }
    
    // Music with category
    if ($request->has('category')) {
        $category = $request->input('category');
        
        $category = MusicCategory::where('name' , $category)->with('musics')->first();
        $data = $category->musics::with('artist:id,first_name,last_name,image');
        return $data;

        if ($data->isEmpty()) {
            return response()->json(['success' => false, 'data' => []]);
        } else {
            return response()->json(['success' => true, 'data' => $data]);
        }
    }

    // Popular song 
    if($request->has('popular')){
        $popular = Music::where('popular' , '>' , 0)->get();
        if($popular->isEmpty()){
            return response()->json(['success' => false , 'popular' => []]);
        }else{
            return response()->json(['succcess' => true , 'popular' => $popular]);
        }
    }

    return response()->json(['success' => false, 'message' => 'Invalid request']);
}

    public function popular_song($id){
        $music = Music::find($id);
        
        if(!$music){
            return response()->json(['success' => false , 'message' => 'Music not found..']);
        }
        $music->popular += 1;
        if($music->save()){
            return response()->json(['success' => true ]);
        }else{
            return response()->json(['succcess' => false]);
        }
    }

    

}
