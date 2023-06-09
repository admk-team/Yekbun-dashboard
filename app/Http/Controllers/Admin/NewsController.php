<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Traits\UploadMedia;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            'description' => 'required'
          ]);

      $news = new News();
      $news->title = $request->title;
      $news->description = $request->description;
      $news->category_id = $request->category_id;
      $news->status = (int) $request->status;

      $asset = collect([]);
      foreach($request->file('image') as $file){
        $path = UploadMedia::index($file ?? '');
        $asset->push($path);
      }

      $news->image = json_encode($asset);
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
        $asset = collect([]);
        foreach($request->file('image') as $file){
            if(isset($news->image)){
                $image_path = public_path('storage/'.$news->image);
                if(file_exists($image_path)){
                    unlink($image_path);
                }
                $path = UploadMedia::index($file ?? '');
                $asset->push($path);
            }
        }

        $news->image = json_encode($asset);
        
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
