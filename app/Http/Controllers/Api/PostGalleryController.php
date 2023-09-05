<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PostGallery;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PostGalleryController extends Controller
{
    public function get_gallery(Request $request)
    {

        $post_gallery = PostGallery::where($request->type, $request->id)->get();

        if ($post_gallery->isNotEmpty()) {
            return response()->json(['success' => true, 'data' => $post_gallery, 'user' => User::find($post_gallery[0]->user_id), 'time' => Carbon::parse($post_gallery[0]->post->created_at)->format('d M, Y')]);
        }

        return response()->json(['success' => false, 'message' => 'No record found.']);
    }
}
