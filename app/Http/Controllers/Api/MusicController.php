<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Music;

class MusicController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $music = Music::with('music_category')->get();
    return response()->json(['Music' => $music], 200);
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
      'category_id' => 'required',
      'status' => 'required',
    ]);

    $audios = [];
    foreach ($request->file('audio') as $value) {
      $audio_path = $value->store('/images/music/audio/', 'public');
      $audios[] = $audio_path;
    }
    $music = Music::create([
      'category_id' => $request->category_id,
      'audio' => json_encode($audios),
      'status' => $request->status,
    ]);

    return response()->json(
      [
        'success' => true,
        'message' => 'Music has been successfully created.',
        'data' => $music,
      ],
      200
    );
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
    $music = Music::findorFail($id);
    $music->name = $request->title ?? $music->name;
    $music->category_id = $request->category_id ?? $music->category_id;
    $music->status = $request->status ?? $music->status;
    $musics = [];
    if ($request->hasFile('audio')) {
      foreach ($request->file('audio') as $value) {
        if (isset($music->audio)) {
          $image_path = public_path('storage/' . $music->audio);
          if (file_exists($image_path)) {
            unlink($image_path);
          }
          $path = $value->store('/images/music/audio/', 'public');
          $musics[] = $path;
        }
      }
      $music->audio = $musics;
    } else {
      $music->audio = $music->audio;
    }

    if ($music->update()) {
      return response()->json('Music Updated Successfully', 200);
    } else {
      return response()->json('Failed to updated music', 400);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Responses
   */
  public function destroy($id)
  {
    $music = Music::findorFail($id);
    if ($music->audio) {
      $image_path = public_path('storage/' . $music->audio);
      if (file_exists($image_path)) {
        unlink($image_path);
      }
    }
    if ($music->delete($music->id)) {
      return response()->json('Music Deleted Successfully', 200);
    } else {
      return response()->json('Failed to delete music', 400);
    }
  }
}
