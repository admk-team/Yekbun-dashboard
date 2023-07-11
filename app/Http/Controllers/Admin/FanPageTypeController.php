<?php

namespace App\Http\Controllers\Admin;

use App\Models\FanPageType;
use App\Traits\UploadMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FanPageTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = FanPageType::get();
        return view('content.fanpage_types.index' , compact('types'));
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
            'title' => 'required',
            'icon' => 'required'
        ]);
         $service = $request->option;
         $new_service = [];
         foreach($service as $value){
            $new_service[] = $value;
         }
         $fanpage = new FanPageType(); 
         $fanpage->name = $request->title;
            if($request->hasFile("icon")){
                $path = UploadMedia::index($request->file('icon'));
                $fanpage->icon  = $path;  
            }
        $fanpage->types = json_encode($new_service);
        if($fanpage->save()){
            return redirect()->back()->with('success' , 'FanPage Sevice has been created successfully.');
        }else{
            return redirect()->back()->with('error' , 'Failed to created FanPage Service');
        }
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FanPageType  $fanPageType
     * @return \Illuminate\Http\Response
     */
    public function show(FanPageType $fanPageType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FanPageType  $fanPageType
     * @return \Illuminate\Http\Response
     */
    public function edit(FanPageType $fanPageType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FanPageType  $fanPageType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FanPageType  $fanPageType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
