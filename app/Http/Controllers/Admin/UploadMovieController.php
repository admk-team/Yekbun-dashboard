<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UploadMovie;
use App\Models\UploadMovieCategory;
use Illuminate\Http\Request;

class UploadMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $upload_movie = UploadMovie::with('moviecategory')->orderBy('id' , 'desc')->get();
        return view('content.movies.index' , compact('upload_movie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $movie_category = UploadMovieCategory::get();
        return view('content.movies.create' , compact('movie_category'));
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
            'movie' => 'required',
          ]); 

        $movies = new UploadMovie();
        $movies->thumbnail = $request->thumbnail;
        $movies->title = $request->title;
        $movies->description = $request->description;
        $movies->category_id = $request->category_id;

       if($request->hasFile('movie')){
        $movies_path = $request->file('movie')->store('/images/movies/' , 'public');
        $movies->movie = $movies_path;
       }

       if($movies->save()){
        return redirect()->route('upload-movies.index')->with('success', 'Movies Has been inserted');
       }else{
        return redirect()->route('upload-movies.index')->with('error', 'Movies Has not inserted');

       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UploadMovie  $uploadMovie
     * @return \Illuminate\Http\Response
     */
    public function show(UploadMovie $uploadMovie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UploadMovie  $uploadMovie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = UploadMovie::find($id);
        $movie_category = UploadMovieCategory::get();
        return view('content.movies.edit', compact('movie' , 'movie_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UploadMovie  $uploadMovie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $movie = UploadMovie::find($id);
        $movie->thumbnail = $request->thumbnail;
        $movie->title = $request->title;
        $movie->description = $request->description;
        $movie->category_id = $request->category_id;


        if($request->hasFile('movie')){
            if(isset($movie->movie)){
                $movie_path  = public_path('/storage/'.$movie->movie);
                if(file_exists($movie_path)){
                    unlink($movie_path);
                }
                $path  = $request->file('movie')->storeAs('/images/movies/' , 'public');
                $movie->movie = $path;
             }
        }

        if($movie->update()){
            return redirect()->route('upload-movies.index')->with('success', 'Movie Has been updated');
           }else{
            return redirect()->route('upload-movies.index')->with('error', 'Movie Has not updated');
    
           }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UploadMovie  $uploadMovie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = UploadMovie::findorFail($id);
        if($movie->movie){
           $movie_path = public_path('storage/'.$movie->movie);
           if(file_exists($movie_path)){
               unlink($movie_path);
           }
        }
        
        if($movie->delete($movie->id)){
            return redirect()->route('upload-movies.index')->with('success', 'Movie Has been Deleted');

         }else{
            return redirect()->route('upload-movies.index')->with('success', 'Movie not Deleted');

         }
    }
    public function status($id , $status){
        $movie = UploadMovie::find($id);
        $movie->status = $status;
        if($movie->update()){
            return redirect()->route('upload-movies.index')->with('success', 'Status Has been Updated');
        }else{
            return redirect()->route('upload-movies.index')->with('error', 'Status is not changed');

        }
    }
}
