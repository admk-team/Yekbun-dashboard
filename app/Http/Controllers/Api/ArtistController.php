<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artist;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['Artist' =>Artist::get()] , 200);
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
            'first_name' => 'required',
            'last_name' => 'required',
            'city' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'image' => 'required'
          ]); 

          $imagePath  = $request->audio;
          if($request->hasFile('image')){
                    $path = $request->file('image')->store('/images/artist/' , 'public');
                    $imagePath = $path;
             }

          $artist = Artist::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'city' => $request->city,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'image'=> $imagePath
          ]);

          return response()->json([
            "success" => true,
            "message" => "Artist successfully created.",
            "data" => $artist
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $artist = Artist::findorFail($id);
        $artist->first_name = $request->first_name ?? $artist->first_name;
        $artist->last_name = $request->last_name ?? $artist->last_name;
        $artist->city = $request->city ?? $artist->city;
        $artist->dob= $request->dob ?? $artist->dob;
        $artist->gender = $request->gender ?? $artist->gender;

        if($request->hasFile('image')){
            if(isset($artist->image)){
                $image_path  = public_path('storage/'.$artist->image);
                if(file_exists($image_path)){
                    unlink($image_path);
                }
                $path = $request->file('audio')->store('/images/artist' , 'public');
                $artist->image = $path;
            }
         }
         if($artist->update()){
            return response()->json('Artist Updated Successfully' , 200);
         }else{
            return response()->json('Failed to updated artist' , 400);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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
            return response()->json('Artist Deleted Successfully' ,200);
          }else{
             return response()->json('Failed to delete artist' , 400);
          }

    }
}
