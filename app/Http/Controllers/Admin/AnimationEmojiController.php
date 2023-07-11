<?php

namespace App\Http\Controllers\Admin;

use App\Models\AnimationEmoji;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnimationEmojiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'emoji' => 'required',
        ]);

        $animated = new AnimationEmoji();
        // $animated->title  = $request->title;
        if($request->hasFile('emoji')){
            $path = $request->file('emoji')->store('images/EmojiFeed','public');
            $animated->emoji = $path;
        }

        if($animated->save()){
            return redirect()->back()->with('success'  , 'Animated Emoji successfully added.');
        }else{
            return redirect()->back()->with('error'  , 'Failed to add Animatd Emoji feed.');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnimationEmoji  $animationEmoji
     * @return \Illuminate\Http\Response
     */
    public function show(AnimationEmoji $animationEmoji)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnimationEmoji  $animationEmoji
     * @return \Illuminate\Http\Response
     */
    public function edit(AnimationEmoji $animationEmoji)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnimationEmoji  $animationEmoji
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $animated = AnimationEmoji::find($id);
        if($request->hasFile('emoji')){
            if(isset($animated->emoji)){
                $emoji_path = public_path('storage/'.$animated->emoji);
                if(file_exists($emoji_path)){
                    unlink($emoji_path);
                }
                $path = $request->file('emoji')->store('images/EmojiFeed','public');
                $animated->emoji = $path;
            }
        }
        
        if($animated->update()){
            return redirect()->back()->with('success' , 'Animated Emoji updated successfully.');
        }else{
            return redirect()->back()->with('success' , 'Failed to update Animated Emoji .');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnimationEmoji  $animationEmoji
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $animated = AnimationEmoji::find($id);
        if(isset($animated->emoji)){
            $emoji_path = public_path('storage/'.$animated->emoji);
            if(file_exists($emoji_path)){
                unlink($emoji_path);
            }
        }
        if($animated->destroy($id)){
            return redirect()->back()->with('success' , 'Animated Emoji has been removed sucessfully.');
        }else{
            return redirect()->back()->with('error' , 'Animated Emoji has not  been removed .');

        }
    }
}
