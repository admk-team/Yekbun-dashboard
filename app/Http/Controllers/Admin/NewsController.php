<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news_category  = NewsCategory::get();
          $news  = News::with('news_category')->get();
        return view('content.news.index' , compact('news' , 'news_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.news.create'  , compact('news_category'));
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
            'image' => 'required'
          ]); 
   
      
      $news = new News();
      $news->title = $request->title;
      $news->description = $request->description;
      $news->category_id = $request->category_id;
      $news->status = (int) $request->status;
      
      if($request->hasFile('image')){
        $path  = $request->file('image')->store('/images/news/' , 'public');
        $news->image = $path;
      }

    if($news->save()){
        return redirect()->route('news.index')->with('success', 'News Has been inserted');
    }else{
        return redirect()->route('news.index')->with('error', 'Failed to add news');
    }
   
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
         $news = News::findorFail($id);
        $news_category = NewsCategory::get();
        return view('content.news.edit' , compact('news_category' , 'news'));
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
        $news->title = $request->title;
        $news->description = $request->description;
        $news->category_id = $request->category_id;
        
        if($request->hasFile('image')){
           if(isset($news->image)){
               $image_path  = public_path('storage/'.$news->image);
               if(file_exists($image_path)){
                   unlink($image_path);
               }
               $path = $request->file('image')->store('/images/news' , 'public');
               $news->image = $path;
           }
        }

        if($news->update()){
            return redirect()->route('news.index')->with('success', 'News Has been Updated');

        }else{
            return redirect()->route('news.index')->with('success', 'News not updated');

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
            return redirect()->route('news.index')->with('success', 'News Has been Deleted');

         }else{
            return redirect()->route('news.index')->with('success', 'News not Deleted');

         }
    }
    public function status($id , $status){
        $news = News::find($id);
        $news->status = $status;
        if($news->update()){
            return redirect()->route('news.index')->with('success', 'Status Has been Updated');
        }else{
            return redirect()->route('news.index')->with('error', 'Status is not changed');

        }
    }
}
