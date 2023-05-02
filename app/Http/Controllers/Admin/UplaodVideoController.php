<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UplaodVideo;
use App\Models\UploadVideoCategory;
use Illuminate\Http\Request;

class UplaodVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $upload_video = UplaodVideo::with('videocategory')->orderBy('id', 'desc')->get();
         $video_category = UploadVideoCategory::get();
        return view('content.videos.index' ,compact('upload_video' , 'video_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.videos.create', compact('video_category'));
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
            'thumbnail' => 'required',
            'title' => 'required',
            'video' => 'required',
          ]); 

        $video = new UplaodVideo();
        $video->title = $request->title;
        $video->description = $request->description;
        $video->category_id = $request->category_id;
        $videos = collect([]);

        if($request->file('thumbnail')){
            $path  = $request->file('thumbnail')->store('/images/thumbnail/','public');
            $video->thumbnail = $path;
        }

        foreach($request->file('video') as $value){
            $path = $value->storeAs('/images/video/' , 'public');
            $videos->push($path);
        }
        $video->video = $videos;

       if($video->save()){
        return redirect()->route('upload-video.index')->with('success', 'Video Has been inserted');
       }else{
        return redirect()->route('upload-video.index')->with('error', 'Video Has not inserted');

       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UplaodVideo  $uplaodVideo
     * @return \Illuminate\Http\Response
     */
    public function show(UplaodVideo $uplaodVideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UplaodVideo  $uplaodVideo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = UplaodVideo::find($id);
        $video_category = UploadVideoCategory::get();
        return view('content.videos.edit', compact('video' , 'video_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UplaodVideo  $uplaodVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $video = UplaodVideo::find($id);
        $video->thumbnail = $request->thumbnail;
        $video->title = $request->title;
        $video->description = $request->description;
        $video->category_id = $request->category_id;
        $videos = collect([]);

        if($request->file('thumbnail')){
            if(isset($video->thumbnail)){
                $image_path = public_path('/storage/'.$video->thumbnail);
                if(file_exists($image_path)){
                    unlink($image_path);
                }
            }
            $path  = $request->file('thumbnail')->store('/images/thumbnail/','public');
            $video->thumbnail = $path;
        }

        if($request->hasFile('video')){
            foreach($request->file('video') as $value){
                    if(isset($video->video)){
                        $video_path  = public_path('/storage/'.$video->video);
                        if(file_exists($video_path)){
                            unlink($video_path);
                        }
                        $path  = $value->storeAs('/images/video/' , 'public');
                        $videos->push($path);
                        $video->video  = $videos;
                    }
            }
        }else{
            $arr = $video->video;
            $video->video = $arr;
        }

        if($video->update()){
            return redirect()->route('upload-video.index')->with('success', 'Video Has been updated');
           }else{
            return redirect()->route('upload-video.index')->with('error', 'Video Has not updated');
    
           }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UplaodVideo  $uplaodVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $video = UplaodVideo::findorFail($id);
         if($video->video){
            $image_path = public_path('storage/'.$video->video);
            if(file_exists($image_path)){
                unlink($image_path);
            }
         }

         if($video->delete($video->id)){
            return redirect()->route('upload-video.index')->with('success', 'Video Has been Deleted');

         }else{
            return redirect()->route('upload-video.index')->with('success', 'Video not Deleted');

         }
    }

    public function status($id , $status){
        $video = UplaodVideo::find($id);
        $video->status = $status;
        if($video->update()){
            return redirect()->route('upload-video.index')->with('success', 'Status Has been Updated');
        }else{
            return redirect()->route('upload-video.index')->with('error', 'Status is not changed');

        }
    }
}
