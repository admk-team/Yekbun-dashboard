<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BackgroundFeed;
use Illuminate\Http\Request;
use App\Traits\UploadMedia;
use Intervention\Image\Facades\Image;
class BackgroundFeedController extends Controller
{
    use UploadMedia;
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max_image_dimensions:375,314',
        ]);
       
        $background = new BackgroundFeed();
        // $background->title  = $request->title;
        if ($request->hasFile('image')) {
            $path = UploadMedia::index($request->file('image')) ?? '';
            $background->image = $path;
        }

        if ($background->save()) {
            return redirect()->back()->with('success', 'Background feed successfully added.');
        } else {
            return redirect()->back()->with('errors', 'Failed to add background feed.');
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
        $request->validate([
            'image.'.$id => 'required|image|mimes:jpeg,png,jpg,gif|max_image_dimensions:375,314',
        ]);
        $background = BackgroundFeed::find($id);
        // $background->title = $request->title;
        if ($request->hasFile('image')) {
            if (isset($background->image)) {
                $image_path = public_path('storage/' . $background->image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                $path = UploadMedia::index($request->file('image')) ?? '';
                $background->image = $path;
            }
        }

        if ($background->update()) {
            return redirect()->back()->with('success', 'Background Feed updated successfully.');
        } else {
            return redirect()->back()->with('success', 'Failed to update Background Feed.');
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
        $background = BackgroundFeed::find($id);
        if (isset($background->image)) {
            $image_path = public_path('storage/' . $background->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        if ($background->destroy($id)) {
            return redirect()->back()->with('success', 'Background Feed has been removed sucessfully.');
        } else {
            return redirect()->back()->with('error', 'Background Feed has not  been removed .');
        }
    }
}
