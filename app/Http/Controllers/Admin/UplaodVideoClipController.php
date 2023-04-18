<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UplaodVideoClip;
use Illuminate\Http\Request;
use App\Models\Artist;

class UplaodVideoClipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $upload_video = UplaodVideoClip::with('artist')->get();
        return view('content.upload_video.index' , compact('upload_video'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $artist = Artist::get();
        return view('content.upload_video.create' , compact('artist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'video' => 'required',
            'artist_id' => 'required'
          ]); 
   
      $video = new UplaodVideoClip();
      $video->title = $request->title;
      $video->category_id = $request->artist_id;
      $videos = collect([]);
      foreach($request->file('video') as $value){
            $path  = $value->store('/images/video/' , 'public');
            $videos->push($path);
    }
    $video->video = $videos;
    if($video->save()){
        return redirect()->route('upload_video.index')->with('success', 'Video Has been inserted');
    }else{
        return redirect()->route('upload_video.index')->with('error', 'Failed to add video');
    }
   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UplaodVideoClip  $uplaodVideoClip
     * @return \Illuminate\Http\Response
     */
    public function show(UplaodVideoClip $uplaodVideoClip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UplaodVideoClip  $uplaodVideoClip
     * @return \Illuminate\Http\Response
     */
    public function edit(UplaodVideoClip $uplaodVideoClip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UplaodVideoClip  $uplaodVideoClip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UplaodVideoClip $uplaodVideoClip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UplaodVideoClip  $uplaodVideoClip
     * @return \Illuminate\Http\Response
     */
    public function destroy(UplaodVideoClip $uplaodVideoClip)
    {
        //
    }
}
