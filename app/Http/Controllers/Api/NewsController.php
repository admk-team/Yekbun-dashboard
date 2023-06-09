<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['news' =>News::get()] , 200);
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
         'description' => 'required',
         'category_id' => 'required',
       ]);

       $imagePath  = $request->image;
       if($request->hasFile('image')){
        $path = $request->file('image')->store('/images/news/' , 'public');
        $imagePath = $path;
   }
            $news = News::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $imagePath
        ]);
       return response()->json([
        "success" => true,
        "message" => "News successfully created.",
        "data" => $news
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
      
         $news = News::findorFail($id);
         $news->title = $request->title ?? $news->title;
         $news->description = $request->description ?? $news->description;
         $news->category_id = $request->category_id ?? $news->category_id;
         
         if($request->hasFile('image')){
            if(isset($news->image)){
                $image_path  = public_path('storage/'.$news->image);
                if(file_exists($image_path)){
                    unlink($image_path);
                }
                $path = $request->file('image')->store('/images/news', 'public');
                $news->image = $path;
            }
         }

         if($news->update()){
            return response()->json('News Updated Successfully' , 200);
         }else{
            return response()->json('Failed to updated news' , 400);
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
         $news = News::findorFail($id);
         if($news->image){
            $image_path = public_path('storage/'.$news->image);
            if(file_exists($image_path)){
                unlink($image_path);
            }
         }

         if($news->delete($news->id)){
           return response()->json('News Deleted Successfully' ,200);
         }else{
            return response()->json('Failed to delete news' , 400);
         }
    }
}
