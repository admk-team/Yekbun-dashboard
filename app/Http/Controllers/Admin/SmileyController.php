<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Smiley;
use Illuminate\Http\Request;

class SmileyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $smileys  = Smiley::get();
        return view('content.smiley.index' , compact('smileys'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Smiley  $smiley
     * @return \Illuminate\Http\Response
     */
    public function show(Smiley $smiley)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Smiley  $smiley
     * @return \Illuminate\Http\Response
     */
    public function edit(Smiley $smiley)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Smiley  $smiley
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Smiley $smiley)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Smiley  $smiley
     * @return \Illuminate\Http\Response
     */
    public function destroy(Smiley $smiley)
    {
        //
    }
}
