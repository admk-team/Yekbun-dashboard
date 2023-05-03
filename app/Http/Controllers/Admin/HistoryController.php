<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\HistoryCategory;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $history = History::with('history_category')->get();
        $history_category = HistoryCategory::get();
        return view('content.history.index' , compact('history' , 'history_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('content.history.create', compact('history_category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;
        dd($request->image);
        $request->validate([
            'title' => 'required',
            'category_id'=>'required',
            'description' => 'required',
            'image'=> 'required',
            'video'=> 'required'
          ]);

          $history = new History();
          $history->title  = $request->title;
          $history->category_id = $request->category_id;
          $history->description = $request->description;
          $images = collect([]);
          if($history->save()){
            return redirect()->route('history.index')->with('success', 'History Has been inserted');
        }else{
            return redirect()->route('history.index')->with('error', 'Failed to add history');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function show(History $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $history = History::find($id);
        $history_category = HistoryCategory::get();
        return view('content.history.edit', compact('history', 'history_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $history = History::find($id);
        $history->title  = $request->title;
        $history->language  = $request->language;
        $history->category_id = $request->category_id;
        if($history->update()){
            return redirect()->route('history.index')->with('success', 'History Has been Updated');
        }else{
            return redirect()->route('history.index')->with('error', 'Failed to update history');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $history = History::find($id);
        if($history->delete($history->id)){
            return redirect()->route('history.index')->with('success', 'History Has been Deleted');
        }else{
            return redirect()->route('history.index')->with('error', 'Failed to delete history');
        }
    }
    public function status($id , $status){
        $history = History::find($id);
        $history->status = $status;
        if($history->update()){
            return redirect()->route('history.index')->with('success', 'Status Has been Updated');
        }else{
            return redirect()->route('history.index')->with('error', 'Status is not changed');

        }
    }
}
