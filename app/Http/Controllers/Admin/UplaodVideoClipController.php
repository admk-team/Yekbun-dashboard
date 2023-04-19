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
            'video' => 'required'
          ]); 
   
      $video = new UplaodVideoClip();
      $video->title = $request->title;
      $video->category_id = $request->artist_id;

      if($request->hasFile('video')){
            $path  = $request->file('video')->store('/images/video/' , 'public');
            $video->video = $path;
    }
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
    public function edit($id)
    {
        $upload_video = UplaodVideoClip::find($id);
        $artist =  Artist::get();
        return view('content.upload_video.edit' , compact('upload_video' , 'artist'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UplaodVideoClip  $uplaodVideoClip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $video = UplaodVideoClip::findorFail($id);
        $video->title = $request->title;
        $video->category_id = $request->artist_id;
        
        if($request->hasFile('video')){
           if(isset($news->video)){
               $image_path  = public_path('storage/'.$video->image);
               if(file_exists($image_path)){
                   unlink($image_path);
               }
               $path = $request->file('image')->store('/images/video' , 'public');
               $video->video = $path;
           }
        }

        if($video->update()){
            return redirect()->route('upload_video.index')->with('success', 'Video  Has been Updated');

        }else{
            return redirect()->route('upload_video.index')->with('success', 'Video not updated');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UplaodVideoClip  $uplaodVideoClip
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = UplaodVideoClip::findorFail($id);
         if($video->video){
            $image_path = public_path('storage/'.$video->video);
            if(file_exists($image_path)){
                unlink($image_path);
            }
         }

         if($video->delete($video->id)){
            return redirect()->route('upload_video.index')->with('success', 'Video Has been Deleted');

         }else{
            return redirect()->route('upload_video.index')->with('success', 'Video not Deleted');

         }
    }
    public function status($id , $status){
        $video = UplaodVideoClip::find($id);
        $video->status = $status;
        if($video->update()){
            return redirect()->route('upload_video.index')->with('success', 'Status Has been Updated');
        }else{
            return redirect()->route('upload_video.index')->with('error', 'Status is not changed');

        }
    }
}
