<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voting;
use App\Models\VotingReaction;

class VotingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['Voting' => Voting::get()], 200);
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
            'name' => 'required',
            'image' => 'required',
            'category_id' => 'required',
            'description' => 'required'
        ]);

        $imagePath  = $request->audio;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('/images/voting/', 'public');
            $imagePath = $path;
        }
        $voting = Voting::create([
            'name' => $request->name,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        return response()->json([
            "success" => true,
            "message" => "Voting successfully created.",
            "data" => $voting
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
        $vote = Voting::find($id);
        $vote->name = $request->name ?? $vote->name;
        $vote->category_id = $request->category_id ?? $vote->category_id;
        $vote->description = $request->description ?? $vote->description;

        if ($request->hasFile('image')) {
            if (isset($vote->banner)) {
                $image_path = public_path('storage/' . $vote->banner);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                $path = $request->file('image')->store('/images/voting', 'public');
                $vote->banner = $path;
            }
        }
        if ($vote->update()) {
            return response()->json('Voting Updated Successfully', 200);
        } else {
            return response()->json('Failed to updated voting', 400);
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
        $vote = Voting::find($id);
        if ($vote->banner) {
            $image_path = public_path('storage/' . $vote->banner);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        if ($vote->delete($vote->id)) {
            return response()->json('Voting Deleted Successfully', 200);
        } else {
            return response()->json('Failed to delete vote', 400);
        }
    }

    public function get_cover()
    {
        $voting = Voting::orderBy('created_at', 'desc')->take(1)->get();

        if ($voting != "")
            $voting[0]->banner = url('/') . '/storage/' . $voting[0]->banner;

        return response()->json(['success' => true, 'data' => $voting]);
    }

    public function fetch()
    {
        $voting = Voting::orderBy('created_at', 'desc')->take(5)->get();

        foreach ($voting as $item) {
            $item->banner = url('/') . '/storage/' . $item->banner;
        }

        return response()->json(['success' => true, 'data' => $voting]);
    }

    public function fetch_all()
    {
        $voting = Voting::orderBy('created_at', 'desc')->get();

        foreach ($voting as $item) {
            $item->banner = url('/') . '/storage/' . $item->banner;
        }

        return response()->json(['success' => true, 'data' => $voting]);
    }

    public function get_details($id)
    {
        $voting = Voting::find($id);

        if ($voting != "")
            $voting->banner = url('/') . '/storage/' . $voting->banner;

        return response()->json(['success' => true, 'data' => $voting]);
    }

    public function store_reaction(Request $request)
    {
        $credentails = $request->validate([
            'user_id' => 'required',
            'vote_id' => 'required',
            'type' => 'required',
        ]);

        $existing_voting = VotingReaction::where('user_id', $request->user_id)->where('vote_id', $request->vote_id)->first();

        if ($existing_voting != "") {
            if ($existing_voting->type == $request->type) {
                $existing_voting->delete();

                return response()->json(['success' => true, 'message' => 'Vote removed.']);
            } else {
                $existing_voting->type = $request->type;
                $existing_voting->save();

                return response()->json(['success' => true, 'message' => 'Vote updated.']);
            }
        }

        VotingReaction::create($credentails);

        return response()->json(['success' => true, 'message' => 'Vote saved.']);
    }
}
