<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artist  = Artist::get();
        
        return view('content.artist.index' , compact('artist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.artist.create');
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
            'first_name' => 'required',
            'last_name' => 'required',
            'city' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'image' => 'required'
          ]); 
   

      $artist = new Artist();
      $artist->first_name = $request->first_name;
      $artist->last_name = $request->last_name;
      $artist->city = $request->city;
      $artist->dob= $request->dob;
      $artist->gender = $request->gender;
      $artist->status = $request->status;
      if($request->hasFile('image')){
        $path  = $request->file('image')->store('/images/artist/' , 'public');
        $artist->image = $path;
      }

    if($artist->save()){
        return redirect()->route('artist.index')->with('success', 'Artist Has been inserted');
    }else{
        return redirect()->route('artist.index')->with('error', 'Failed to add artist');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $artist = Artist::findorFail($id);
        return view('content.artist.edit' , compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id)
    {
        $artist = Artist::findorFail($id);
        $artist->first_name = $request->first_name;
        $artist->last_name = $request->last_name;
        $artist->city = $request->city;
        $artist->dob= $request->dob;
        $artist->gender = $request->gender;
        
        if($request->hasFile('image')){
           if(isset($artist->image)){
               $image_path  = public_path('storage/'.$artist->image);
               if(file_exists($image_path)){
                   unlink($image_path);
               }
               $path = $request->file('image')->store('/images/artist' , 'public');
               $artist->image = $path;
           }
        }

        if($artist->update()){
            return redirect()->route('artist.index')->with('success', 'Artist Has been Updated');

        }else{
            return redirect()->route('artist.index')->with('success', 'Artist not updated');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artist = Artist::findorFail($id);
        if($artist->image){
           $image_path = public_path('storage/'.$artist->image);
           if(file_exists($image_path)){
               unlink($image_path);
           }
        }

        if($artist->delete($artist->id)){
           return redirect()->route('artist.index')->with('success', 'Artist  Has been Deleted');

        }else{
           return redirect()->route('artist.index')->with('success', 'Artist not Deleted');

        }
    }

    public function status($id , $status){
        $artist = Artist::find($id);
        $artist->status = $status;
        if($artist->update()){
            return redirect()->route('artist.index')->with('success', 'Status Has been Updated');
        }else{
            return redirect()->route('artist.index')->with('error', 'Status is not changed');

        }
    }
}
