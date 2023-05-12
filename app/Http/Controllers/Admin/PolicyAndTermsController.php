<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class PolicyAndTermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $policy = Setting::first();
        return  view('content.policy_and_terms.index' , compact('policy'));
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
    
        if($request->has('privacy')){
            $request->validate([
                'policy_text' => 'required',
                'privacy' => 'required'
            ]);
        }else{
            $request->validate([
                'disclaimer_text' => 'required',
                'disclaimer' => 'required'
            ]);
        }
      
        if($request->has('privacy')){
            $setting = Setting::first() ?? new Setting();
            $setting->name = $request->privacy;
            $setting->description = $request->policy_text;

        }else{
            $setting = Setting::first() ?? new Setting();
            $setting->name = $request->disclaimer;
            $setting->description = $request->disclaimer_text;
        }
        if($setting->save()){
            return redirect()->route('policy_and_terms.index')->with('success' , 'Record has been inserted successfully');
        }else{
            return redirect()->route('policy_and_terms.index')->with('error' , 'Record has been not been inserted ');

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
