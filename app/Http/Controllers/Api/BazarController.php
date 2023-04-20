<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bazar;

class BazarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['Bazar' =>Bazar::get()] , 200);
        
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
            'title' => 'required',
            'user_name' => 'required',
            'category_id' => 'required',
           
          ]);
          $imagePath  = $request->image;
          if($request->hasFile('image')){
           $path = $request->file('image')->store('/images/bazar/' , 'public');
           $imagePath = $path;
      }
        $bazar = Bazar::create([
               'title' => $request->title,
               'user_name' => $request->user_name,
               'category_id' => $request->category_id,
               'image' => $imagePath,
           ]);
          return response()->json([
           "success" => true,
           "message" => "Bazar  successfully created.",
           "data" => $bazar
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
        $bazar = Bazar::findorFail($id);
        $bazar->title = $request->title ?? $bazar->title;
        $bazar->user_name = $request->user_name ?? $bazar->user_name;
        $bazar->category_id = $request->category_id ?? $bazar->category_id;
  
        if($request->hasFile('image')){
           if(isset($bazar->image)){
               $image_path  = public_path('storage/'.$bazar->image);
               if(file_exists($image_path)){
                   unlink($image_path);
               }
               $path = $request->file('image')->store('/images/bazar/' , 'public');
               $bazar->image = $path;
           }
        }

        if($bazar->update()){
            return response()->json('Bazar  Updated Successfully' , 200);
         }else{
            return response()->json('Failed to updated bazar' , 400);
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
        $bazar = Bazar::findorFail($id);
        if($bazar->images){
            $image_path = public_path('storage/'.$bazar->images);
            if(isset($image_path)){
                unlink($image_path);
            }
        }
        if($bazar->delete($bazar->id)){
            return response()->json('Bazar  Deleted Successfully' , 200);
         }else{
            return response()->json('Failed to delete bazar' , 400);
         }
    }
}
