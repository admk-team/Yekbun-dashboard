<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::orderBy('id' , 'desc')->get();
        return view('content.language.index' , compact('languages'));
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
            'icon' => 'required',
            'title' => 'required',
        ]);

        $language = new Language();
        $language->icon   = $request->icon;
        $language->title = $request->title;
        $language->status = $request->status;
        if($language->save()) {
            return redirect()->route('language.index')->with('success', 'Your language has been created successfully.');
        }else{
            return redirect()->route('language.index')->with('error', 'Your language has not  been created successfully.');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $language = Language::find($id);
        $language->icon   = $request->icon;
        $language->title = $request->title;
        $language->status = $request->status;
        if($language->update()) {
            return redirect()->route('language.index')->with('success', 'Your language has been updated successfully.');
        }else{
            return redirect()->route('language.index')->with('error', 'Your language has not  been updated.');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $language = Language::find($id);
        if($language->delete()){
            return redirect()->route('language.index')->with('success', 'Your language has been Deleted successfully.');
        }else{
            return redirect()->route('language.index')->with('success', 'Your language has been not deleted.');

        }
    }
}
