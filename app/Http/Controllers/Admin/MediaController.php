<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\MediaCategory;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $media = Media::with('media_category')->get();
        return view('content.media.index' , compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $media_category = MediaCategory::get();
        return view('content.media.create' , compact('media_category'));
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
            'image'=>'required',
            'category_id'=>'required'
          ]);

          $media = new Media();
          $media->title  = $request->title;
          $media->category_id = $request->category_id;
          if($request->hasFile('image')){
            $path = $request->file('image')->store('/images/media/' , 'public');
            $media->images  = $path;
          }

          if($media->save()){
            return redirect()->route('media.index')->with('success', 'Media Has been inserted');
        }else{
            return redirect()->route('media.index')->with('error', 'Failed to add media');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $media = Media::findorFail($id);
        $media_category = MediaCategory::get();
        return view('content.media.edit' , compact('media_category' , 'media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $media = Media::findorFail($id);
        $media->title=$request->title;
        $media->category_id = $request->category_id;
        
        if($request->hasFile('image')){
            if(isset($media->images)){
                $image_path = public_path('storage/'.$media->images);
                if(isset($image_path)){
                    unlink($image_path);
                }
                $path  = $request->file('image')->store('/images/media/'  , 'public');
                $media->images = $path;
            }
        }
        if($media->update()){
            return redirect()->route('media.index')->with('success', 'Media Has been Updated');
        }else{
            return redirect()->route('media.index')->with('error', 'Failed to update media');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $media = Media::findorFail($id);
        if($media->images){
            $image_path = public_path('storage/'.$media->images);
            if(isset($image_path)){
                unlink($image_path);
            }
        }
        if($media->delete($media->id)){
            return redirect()->route('media.index')->with('success', 'Media Has been Deleted');
        }else{
            return redirect()->route('media.index')->with('error', 'Failed to delete media');
        }
    }

    public function status($id , $status){
        $media = Media::find($id);
        $media->sttus = $status;
        if($media->update()){
            return redirect()->route('media.index')->with('success', 'Status Has been Updated');
        }else{
            return redirect()->route('media.index')->with('error', 'Status is not changed');

        }
    }
}
