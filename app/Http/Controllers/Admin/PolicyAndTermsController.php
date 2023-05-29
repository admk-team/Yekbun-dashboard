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
         $privacy = Setting::firstorCreate(['name' => 'privacy_policy']);
        $decode =   json_decode($privacy->description);
        $disclaimer = Setting::firstorCreate(['name' => 'disclaimer']);
        return  view('content.policy_and_terms.index' , compact('decode' , 'disclaimer'));
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
            $data =[];
            $titles = $request->policy_title;
            $descriptions  = $request->policy_text;

            for($i=0; $i<count($titles); $i++){

                $pair =[
                    "title" => $titles[$i],
                    "description" => $descriptions[$i]
                ];
                    // Add the pair to the data array
            $data[] = $pair;
            }

            $setting = Setting::firstorCreate(['name'=>$request->privacy]);
            $setting->description = json_encode($data);

        }else{

            $setting = Setting::firstorCreate(['name'=>$request->disclaimer]);
            $setting->description = $request->disclaimer_text;

        }
        if($setting->save()){
            return redirect()->route('policy_and_terms.index')->with('success' , 'Policy has been Updated successfully');
        }else{
            return redirect()->route('policy_and_terms.index')->with('error' , 'Failed to Updated Policy');

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
