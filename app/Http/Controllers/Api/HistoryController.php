<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['History ' =>History::get()] , 200);
        
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
            'category_id'=> 'required',
            'language' => 'required'
          ]);

        $history = History::create([
               'title' => $request->title,
               'language' => $request->language,
               'category_id' => $request->category_id
           ]);
          return response()->json([
           "success" => true,
           "message" => "History  successfully created.",
           "data" => $history
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
        $history = History::findorFail($id);
        $history->title = $request->title ?? $history->title;
        $history->language = $request->language ?? $history->language;
        $history->category_id = $request->category_id ?? $history->category_id;
        if($history->update()){
           return response()->json('History  Updated Successfully' , 200);
        }else{
           return response()->json('Failed to updated history ' , 400);
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
        $history = History::findorFail($id);
        if($history->delete($history->id)){
          return response()->json('History  Deleted Successfully' ,200);
        }else{
           return response()->json('Failed to delete history ' , 400);
        }
    }
}
