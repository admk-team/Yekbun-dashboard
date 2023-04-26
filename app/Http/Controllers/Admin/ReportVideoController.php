<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReportVideo;
use Illuminate\Http\Request;

class ReportVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $reported_video = ReportVideo::with('video')->get();
        return view('content.report_video.index', compact('reported_video'));
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
     * @param  \App\Models\ReportVideo  $reportVideo
     * @return \Illuminate\Http\Response
     */
    public function show(ReportVideo $reportVideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReportVideo  $reportVideo
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportVideo $reportVideo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReportVideo  $reportVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportVideo $reportVideo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReportVideo  $reportVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportVideo $reportVideo)
    {
        //
    }

    public function status($id , $status){
        $report = ReportVideo::find($id);
        $report->status = $status;
        if($report->update()){
            return redirect()->route('report-video.index')->with('success' , 'Status Changed Successfully');
        }else{
            return redirect()->route('report-video.index')->with('success' , 'Status Not change Successfully');

        }
    }
}
