<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BazarCategory;
use App\Models\SubCategoryBazar;

class OnlineCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bazar_category = BazarCategory::with('bazarsubcategory')->get();
        return view('content.category_online.index' , compact('bazar_category'));
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
            'bazar_category' => 'required'
        ]);

        $model = new BazarCategory();
        $model->name = $request->bazar_category;
        if($model->save()){
            return redirect()->route('online-category.index')->with('success', 'Bazar  Category Has been inserted');
        }else{
            return redirect()->route('online-category.index')->with('error', 'Failed to add bazar category');
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
        $bazar = BazarCategory::findorFail($id);
        $bazar->name = $request->bazar_category;
        if($bazar->update()){
           return redirect()->route('online-category.index')->with('success', 'Bazar Category Has been Updated');
       }else{
           return redirect()->route('online-category.index')->with('error', 'Failed to update bazar category');
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
        $bazar = BazarCategory::findorFail($id);
        if($bazar->delete($bazar->id)){
            return redirect()->route('online-category.index')->with('success', 'bazar Category Has been Deleted');
        }else{
            return redirect()->route('online-category.index')->with('error', 'Failed to delete bazar category');
        }
    }
    public function status($id , $status){
        $bazar = BazarCategory::find($id);
        $bazar->status = $status;
        if($bazar->update()){
            return redirect()->route('online-category.index')->with('success', 'Status Has been Updated');
        }else{
            return redirect()->route('online-category.index')->with('error', 'Status is not changed');

        }
    }

    public function save(Request $request){
        $request->validate([
            'category_id' => 'required',
            'name'=> 'required'
        ]);

        $model = new SubCategoryBazar();
        $model->category_id = $request->category_id;
        $model->name = $request->name;
        if($model->save()){
            return redirect()->route('online-category.index');
        }
    }
}
