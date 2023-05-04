<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $artist = Artist::get();
         $album = Album::with('artist')->get();
       return view('content.album.index' , compact('album' , 'artist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'artist_id' => 'required',
            'status' => 'required'
        ]);

        $album  = new Album();
        $album->artist_id = $request->artist_id;
        $album->title = $request->title;
        if($request->hasFile('image')){
            $path = $request->file('image')->store('/images/album/img' , 'public');
            $album->image = $path;
        }
        $albums = collect([]);
        foreach($request->file('album') as $value){
            $path = $value->store('/images/album/album' , 'public');
            $albums->push($path);
        }
        $album->album = $albums;
        $album->status = $request->status;
        if($album->save()){
            return redirect()->route('album.index')->with('success' , 'Album Created Successfully');
        }else{
            return redirect()->route('album.index')->with('error', 'Album not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $album = Album::findorFail($id);
        $album->artist_id = $request->artist_id;
        $album->title = $request->title;
        if($request->hasFile('image')){
            if(isset($album->image)){
                $image_path = public_path('storage/'.$album->image);
                if(file_exists($image_path)){
                    unlink($image_path);
                }
                $path = $request->file('image')->store('/images/album/img','public');
                $album->image = $path;
            }
        }

        $albums = collect([]);
        if($request->file('album')){
        foreach($request->file('album') as $value){
             if(isset($album->album)){
                $album_path = public_path('storage/'.$album->album);
                if(file_exists($album_path)){
                    unlink($album_path);
                }
                $path = $value->store('/images/album/album/','public');
                $albums->push($path);
                $album->album = $albums;
             }
        }
    }else{
        $oldalbum  = $album->album;
        $album->album = $oldalbum;
    }

        if($album->update()){
            return redirect()->route('album.index')->with('success', 'Album  Has been Updated');

        }else{
            return redirect()->route('album.index')->with('success', 'Album not updated');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Album::findorFail($id);
         if($album->album){
            $image_path = public_path('storage/'.$album->album);
            if(file_exists($image_path)){
                unlink($image_path);
            }
         }

         if($album->delete($album->id)){
            return redirect()->route('album.index')->with('success', 'Album Has been Deleted');

         }else{
            return redirect()->route('album.index')->with('success', 'Album not Deleted');

         }
    }
}
