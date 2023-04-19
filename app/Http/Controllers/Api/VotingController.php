<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voting;

class VotingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['Voting' =>Voting::get()] , 200);
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
            'name' => 'required',
            'image' => 'required',
            'category_id' => 'required',
            'description' => 'required'
          ]); 

          $imagePath  = $request->audio;
          if($request->hasFile('image')){
                    $path = $request->file('image')->store('/images/voting/' , 'public');
                    $imagePath = $path;
             }
            $voting = Voting::create([
                'name' => $request->name,
                'image' => $imagePath,
                'category_id' => $request->category_id,
                'description' => $request->description,
            ]);

            return response()->json([
                "success" => true,
                "message" => "Voting successfully created.",
                "data" => $voting
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
        $vote = Voting::find($id);
        $vote->name = $request->name;
        $vote->category_id = $request->category_id;
        $vote->description = $request->description;

        if($request->hasFile('image'))
        {
            if(isset($vote->banner)){
                $image_path = public_path('storage/'.$vote->banner);
                if(file_exists($image_path)){
                    unlink($image_path);
                }
                $path = $request->file('image')->store('/images/voting','public');
                $vote->banner = $path;
            }
        }
        if($vote->update()){
            return response()->json('Voting Updated Successfully' , 200);
         }else{
            return response()->json('Failed to updated voting' , 400);
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
        $vote = Voting::find($id);
        if($vote->banner){
            $image_path = public_path('storage/'.$vote->banner);
                if(file_exists($image_path)){
                    unlink($image_path);
                }
        }
         if($vote->delete($vote->id)){
            return response()->json('Voting Deleted Successfully' ,200);
          }else{
             return response()->json('Failed to delete vote' , 400);
          }
    }
}
