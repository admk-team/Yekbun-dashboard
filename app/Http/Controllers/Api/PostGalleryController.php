<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PostGallery;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PostGalleryController extends Controller
{
    public function get_gallery(Request $request)
    {

        $post_gallery = PostGallery::where($request->type, $request->id)->get();

        $parent_table = explode('_', $request->type)[0];

        if ($parent_table[strlen($parent_table) - 1] != 's')
            $parent_table .= 's';

        if ($post_gallery->isNotEmpty()) {
            return response()->json(['success' => true, 'data' => $post_gallery, 'user' => User::find($post_gallery[0]->user_id), 'time' => Carbon::parse(DB::table()->find($request->id)->created_at)->format('M d Y')]);
        }

        return response()->json(['success' => false, 'message' => 'No record found.']);
    }
}
