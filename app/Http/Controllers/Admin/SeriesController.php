<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Series;
use App\Models\Category;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $series = Series::with('series_category')->get();
        $series_category = Category::where('target' , 'series')->get();
       return view('content.series.index' , compact('series_category' , 'series'));
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
            'thumbnail' => 'required',
            'title' => 'required',
            'series' => 'required',
          ]); 

        $serie = new Series();
        $serie->title = $request->title;
        $serie->description = $request->description;
        $serie->category_id = $request->category_id;
        $serie->status = $request->status;
        $series = collect([]);

        if($request->hasFile('thumbnail')){
            $series_path = $request->file('thumbnail')->store('/images/series/thumbnail','public');
            $serie->thumbnail = $series_path;
           }
       

        foreach($request->file('series') as $value){
            $path = $value->store('/images/series','public');
            $series->push($path);
        }
        $serie->series = $series->toJson();

       if($serie->save()){
        return redirect()->route('series.series.index')->with('success', 'Series  Has been inserted');
       }else{
        return redirect()->route('series.series.index')->with('error', 'Series Has not inserted');

       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function show(Series $series)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function edit(Series $series)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $serie = Series::find($id);
        $serie->title = $request->title;
        $serie->description = $request->description;
        $serie->category_id = $request->category_id;
        $serie->status = $request->status;
        $series = collect([]);

        if($request->hasFile('thumbnail')){
            if(isset($serie->thumbnail)){
                $image_path = public_path('storage/'.$serie->thumbnail);
                if(file_exists($image_path)){
                    unlink($image_path);
                }
            }
            $path  = $request->file('thumbnail')->store('/images/series/thumbnail','public');
            $serie->thumbnail = $path;
           
        }

      
        if($request->hasFile('series')){
            foreach($request->file('series') as $value){
                    if(isset($serie->series)){
                        $video_path  = public_path('storage/'.$serie->series);
                        if(file_exists($video_path)){
                            unlink($video_path);
                        }
                        $path  = $value->store('/images/series/video' , 'public');
                        $series->push($path);
                        $serie->series = $series;
                    }
            }
        }else{
            $arr = $serie->series;
            $serie->series = $arr;
        }

        if($serie->update()){
            return redirect()->route('series.series.index')->with('success', 'Series Has been updated');
           }else{
            return redirect()->route('series.series.index')->with('error', 'Series Has not updated');
    
           }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $series = Series::findorFail($id);
        if($series->series){
           $series_path = public_path('storage/'.$series->series);
           if(file_exists($series_path)){
               unlink($series_path);
           }
        }
        
        if($series->delete($series->id)){
            return redirect()->route('series.series.index')->with('success', 'Series Has been Deleted');

         }else{
            return redirect()->route('series.series.index')->with('success', 'Series not Deleted');

         }
    }
}
