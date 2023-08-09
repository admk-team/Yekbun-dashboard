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
        $latest = Music::latest()->paginate(10);

        if ($latest->isEmpty()) {
            return response()->json(['success' => false, 'data' => []]);
        } else {
            return response()->json(['success' => true, 'data' => $latest]);
        }
    }
    
    // Music with category
    if ($request->has('category')) {
        $category = $request->input('category'); // Retrieve the category from the request
        
        $category = MusicCategory::where('name' , $category)->with('musics')->first();
        $data = $category->musics;
        if ($data->isEmpty()) {
            return response()->json(['success' => false, 'data' => []]);
        } else {
            return response()->json(['success' => true, 'data' => $data]);
        }
    }

    // If none of the conditions are met, return an error response
    return response()->json(['success' => false, 'message' => 'Invalid request']);
}
}
