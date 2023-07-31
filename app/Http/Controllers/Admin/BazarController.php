<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bazar;
use App\Models\BazarCategory;
use Illuminate\Http\Request;

class BazarController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $bazars = Bazar::with('bazar_category')->get();
        $bazar_category = BazarCategory::with('sub_categories')->get();
        return view('content.bazars.index' , compact('bazars' , 'bazar_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.bazars.create' , compact('bazar_category'));
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
            'image'=>'required'
          ]);

          $bazar = new Bazar();
          $bazar->category_id = $request->category_id;
          $bazar->title  = $request->title;
          $images = collect([]);
          foreach($request->file('image') as $value){
             $path = $value->store('/images/bazar/img' , 'public');
             $images->push($path);
          }
          $bazar->image = $images;
        //   if($request->hasFile('image')){
        //     $path = $request->file('image')->store('/images/bazar/' , 'public');
        //     $bazar->image = $path;
        //   }
          $bazar->user_id  = auth()->user()->id ?? null;
          $bazar->price = $request->price;
          $bazar->status = $request->status;
          $bazar->warranty = $request->warranty;

          if($bazar->save()){
            return redirect()->route('bazar.index')->with('success', 'Bazar Has been inserted');
        }else{
            return redirect()->route('bazar.index')->with('error', 'Failed to add bazar');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bazar  $bazar
     * @return \Illuminate\Http\Response
     */
    public function show(Bazar $bazar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bazar  $bazar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bazar = Bazar::find($id);
        $bazar_category = BazarCategory::get();
        return view('content.bazars.edit' , compact('bazar', 'bazar_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bazar  $bazar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
        $bazar = Bazar::findorFail($id);
        $bazar->title = $request->title;
        $bazar->category_id = $request->category_id;
        $bazar->title = $request->title;
        $bazar->warranty =  $request->warranty;
        $bazar->status = $request->status;
        $images = collect([]);

  
        if($request->hasFile('image')){
            foreach($request->file('image') as $value){
           if(isset($bazar->image)){
               $image_path  = public_path('storage/'.$bazar->image);
               if(file_exists($image_path)){
                   unlink($image_path);
               }
               $path = $value->store('/images/bazar/img' , 'public');
               $images->push($path);
           }
        }
        $bazar->image = $images;
        }else{
            $bazar->image = $bazar->image ?? '';
        }

        if($bazar->update()){
            return redirect()->route('bazar.index')->with('success', 'Bazar Has been Updated');
        }else{
            return redirect()->route('bazar.index')->with('error', 'Failed to update bazar');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bazar  $bazar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bazar = Bazar::findorFail($id);
        if($bazar->image){
           $image_path = public_path('storage/'.$bazar->image);
           if(file_exists($image_path)){
               unlink($image_path);
           }
        }
        if($bazar->delete($bazar->id)){
            return redirect()->route('bazar.index')->with('success', 'Bazar Has been Deleted');
        }else{
            return redirect()->route('bazar.index')->with('error', 'Failed to delete bazar');
        }
    }

    public function status($id , $status){
        $bazar = Bazar::find($id);
        $bazar->status = $status;
        if($bazar->update()){
            return redirect()->route('bazar.index')->with('success', 'Status Has been Updated');
        }else{
            return redirect()->route('bazar.index')->with('error', 'Status is not changed');

        }
    }
}
