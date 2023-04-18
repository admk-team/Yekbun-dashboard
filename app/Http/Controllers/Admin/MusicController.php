<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Music;
use App\Models\MusicCategory;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
   {
           $music  = Music::with('music_category')->get();
        return view('content.music.index' , compact('music'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $music_category  = MusicCategory::get();
        return view('content.music.create' , compact('music_category'));
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
            'audio' => 'required'
          ]); 
   
      
      $music = new Music();
      $music->name = $request->title;
      $music->category_id = $request->category_id;
      
      if($request->hasFile('audio')){
        $path  = $request->file('audio')->store('/images/music/' , 'public');
        $music->audio = $path;
      }

    if($music->save()){
        return redirect()->route('music.index')->with('success', 'Music Has been inserted');
    }else{
        return redirect()->route('music.index')->with('error', 'Failed to add music');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function show(Music $music)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $music = Music::findorFail($id);
        $music_category = MusicCategory::get();
        return view('content.music.edit' , compact('music_category' , 'music'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $music = Music::findorFail($id);
        $music->name = $request->title;
        $music->category_id = $request->category_id;
        
        if($request->hasFile('audio')){
           if(isset($music->audio)){
               $image_path  = public_path('storage/'.$music->audio);
               if(file_exists($image_path)){
                   unlink($image_path);
               }
               $path = $request->file('audio')->store('/images/music' , 'public');
               $music->audio = $path;
           }
        }

        if($music->update()){
            return redirect()->route('music.index')->with('success', 'Mujsic Has been Updated');

        }else{
            return redirect()->route('music.index')->with('success', 'Music not updated');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $music = Music::findorFail($id);
        if($music->audio){
           $image_path = public_path('storage/'.$music->audio);
           if(file_exists($image_path)){
               unlink($image_path);
           }
        }

        if($music->delete($music->id)){
           return redirect()->route('music.index')->with('success', 'Music  Has been Deleted');

        }else{
           return redirect()->route('music.index')->with('success', 'Music not Deleted');

        }
    }
    public function status($id , $status){
        $music = Music::find($id);
        $music->status = $status;
        if($music->update()){
            return redirect()->route('music.index')->with('success', 'Status Has been Updated');
        }else{
            return redirect()->route('music.index')->with('error', 'Status is not changed');

        }
    }
}