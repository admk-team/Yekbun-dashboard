<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voting;
use App\Models\VotingCategory;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $votes = Voting::with('voting_category')->get();
        $vote_category = VotingCategory::get();
        return view('content.voting.index' , compact('votes' , 'vote_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.voting.create' , compact('vote_category'));
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

          $options = [];
          if ($request->{'group-a'}) {
            $options = array_map(function ($option) {
                return ["title" => $option['option']];
            }, $request->{'group-a'});
          }

          $vote = new Voting();
          $vote->name = $request->name;
          $vote->category_id = $request->category_id;
          $vote->description = $request->description;
          $vote->options = $options;

          if($request->hasFile('image')){
            $path = $request->file('image')->store('/images/voting/' , 'public');
            $vote->banner = $path;
          }
          if($vote->save()){
            return redirect()->route('vote.index')->with('success', 'Vote Has been inserted');
        }else{
            return redirect()->route('vote.index')->with('error', 'Failed to add vote');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voting  $voting
     * @return \Illuminate\Http\Response
     */
    public function show(Voting $voting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voting  $voting
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // $vote = Voting::find($id);
        // return view('content.voting.index', compact('vote'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Voting  $voting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vote = Voting::find($id);
        $vote->name = $request->name;
        $vote->category_id = $request->category_id;
        $vote->description = $request->description;

        $options = $vote->options;
        if ($request->{'group-a'}) {
            $options = array_map(function ($option) {
                return ["title" => $option['option']];
            }, $request->{'group-a'});
        }
        $vote->options = $options;

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
            return redirect()->route('vote.index')->with('success', 'Vote Has been Updated');
        }else{
            return redirect()->route('vote.index')->with('error', 'Failed to update vote');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voting  $voting
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
            return redirect()->route('vote.index')->with('success', 'Vote Has been Delted');

        }else{
            return redirect()->route('vote.index')->with('success', 'Vote not deleted');

        }
    }

      public function status($id , $status){
        $vote = Voting::find($id);
        $vote->status = $status;
        if($vote->update()){
            return redirect()->route('vote.index')->with('success', 'Status Has been Updated');
        }else{
            return redirect()->route('vote.index')->with('error', 'Status is not changed');

        }
    }
}
