<?php

namespace App\Http\Controllers\Admin;

use App\Models\Story;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreStoryRequest;
use App\Http\Requests\UpdateStoryRequest;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app = null;
        if (request()->app)
            $app = request()->app;

        $stories = Story::where('app', $app?? 'main')->get();

        return view("content.stories.index", compact("stories", "app"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoryRequest $request)
    {
        $validated = $request->validated();

        $mediaPath = $validated["media_path"]?? null; // Get media path if exists in request
        if ($request->hasFile('media')) { // Store actual media if media file exists
            $mediaPath = $request->media->store("/stories", "public");
            $validated["media_path"] = $mediaPath;
        }

        $story = Story::create($validated);

        return back()->with("success", "Story successfully created.");
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
    public function update(UpdateStoryRequest $request, $id)
    {
        $validated = $request->validated();

        $mediaPath = $validated["media_path"]?? null; // Get media path if exists in request
        if ($request->hasFile('media')) { // Store actual media if media file exists
            $mediaPath = $request->media->store("/stories", "public");
            $validated["media_path"] = $mediaPath;
        }

        $story = Story::find($id);
        $story->fill($validated);
        $story->save();

        return back()->with("success", "Story successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $story = Story::find($id);

        // Delete Image
        if ($story->media_path)
            Storage::delete($story->media_path);

        $story->delete();

        return back()->with("success", "Story successfully deleted.");
    }
}
