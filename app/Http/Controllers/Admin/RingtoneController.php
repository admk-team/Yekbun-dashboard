<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ringtone;
use Illuminate\Http\Request;

class RingtoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ringtones  = Ringtone::get();
        return view('content.ringtone.index' , compact('ringtones'));
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
            'ringtone' => 'required'
        ]);

        $ringtone  = new Ringtone();
        $ringtone->title = $request->title;
        $ringtone->ringtone_path = $request->ringtone;
        // if($request->has('ringtone')){
        //     $path = $request->file('ringtone')->store('/images/ringtone/','public');
        //     $ringtone->ringtone_path = $path;
        // }
        if($ringtone->save()){
            return redirect()->route('ringtone.index')->with('success' , 'Ringtone was successfully created');
        }else{
            return redirect()->route('ringtone.index')->with('success' , 'Ringtone was not created successfully');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ringtone  $ringtone
     * @return \Illuminate\Http\Response
     */
    public function show(Ringtone $ringtone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ringtone  $ringtone
     * @return \Illuminate\Http\Response
     */
    public function edit(Ringtone $ringtone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ringtone  $ringtone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ringtone  =Ringtone::find($id);
        $ringtone->title = $request->title;
        $ringtone->ringtone_path = $request->ringtone;
        // if($request->has('ringtone')){
        //     if(isset($ringtone->ringtone_path)){
        //         $img_path = public_path('storage/'.$ringtone->ringtone_path);
        //         if(file_exists($img_path)){
        //             unlink($img_path);
        //         }
        //         $path = $request->file('ringtone')->store('/images/ringtone/','public');
        //         $ringtone->ringtone_path = $path;
        //     }
            
        // }
        if($ringtone->update()){
            return redirect()->route('ringtone.index')->with('success' , 'Ringtone was successfully Updated');
        }else{
            return redirect()->route('ringtone.index')->with('success' , 'Ringtone was not updated successfully');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ringtone  $ringtone
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ringtone = Ringtone::find($id);
        if(isset($ringtone->ringtone_path)){
           $img_path = public_path('storage/'.$ringtone->ringtone_path);
           if(file_exists($img_path)){
             unlink($img_path);
           }
        }
        if($ringtone->destroy($ringtone->id)){
         return redirect()->route('ringtone.index')->with('success' , 'Ringtone was Deleted successfully');
 
        }else{
         return redirect()->route('ringtone.index')->with('success' , 'Ringtone was not  Deleted ');
 
        }
    }

    public function deleteRingtone($id)
    {
        $ringtone = Ringtone::find($id);
        if ($ringtone && isset($ringtone->ringtone_path)) {
            $path = public_path('storage/' . $ringtone->ringtone_path);
            if (file_exists($path)) {
                unlink($path);
            }
    
            // Remove the image filename from the model attribute
            $ringtone->ringtone_path = null;
            $ringtone->save();
        }
        
        return [
            'status' => true
        ];
    }
}
