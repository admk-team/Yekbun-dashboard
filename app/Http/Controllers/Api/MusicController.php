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
        $query = Music::with(['artist' => function ($query){
            $query->select('first_name');
        }])->latest();

        if($request->has('limit')){
            $latest = $query->limit(10)->get();
        }else{
            $latest = $query->get();
        }
        if ($latest->isEmpty()) {
            return response()->json(['success' => false, 'data' => []]);
        } else {
            return response()->json(['success' => true, 'data' => $latest]);
        }
    }
    
    // Music with category
    if ($request->has('category')) {
        $category = $request->input('category');
        
        $category = MusicCategory::where('name', $category)->with(['musics.artist' => function ($query) {
            $query->select('first_name');
        }])->first();
        $data = $category->musics;
        return $data;

        if ($data->isEmpty()) {
            return response()->json(['success' => false, 'data' => []]);
        } else {
            return response()->json(['success' => true, 'data' => $data]);
        }
    }

    // Popular song 
    if($request->has('popular')){

        $query = Music::where('popular' , '>' , 0)->with(['artist' => function ($query){
            $query->select('first_name');
        }]);

        if($request->has('limit')){
            $popular = $query->limit(5)->get(); 
        }else{
            $popular = $query->get();
        }
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
