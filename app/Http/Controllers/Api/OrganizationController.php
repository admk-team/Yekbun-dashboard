<?php

namespace App\Http\Controllers\Api;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->limit) {
            return Organization::orderBy("updated_at", "DESC")
                        ->paginate(request()->limit)
                        ->appends(["limit" => request()->limit]);
        }

        $organizations = Organization::orderBy("updated_at", "DESC")->get();

        return [
            "data" => $organizations
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrganizationRequest $request)
    {
        $validated = $request->validated();

        $imagePath = null;
        if ($request->hasFile('logo')) {
            $imagePath = $request->logo->store("/organizations", "public");
            $validated["logo"] = $imagePath;
        }

        $organizations = Organization::create($validated);

        return [
            "message" => "Organization successfully created.",
            "data" => $organizations
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return [
            "data" => Organization::find($id)
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrganizationRequest $request, $id)
    {
        $validated = $request->validated();

        $imagePath = null;
        if ($request->hasFile('logo')) {
            $imagePath = $request->logo->store("/organizations", "public");
            $validated["logo"] = $imagePath;
        }

        $organizations = Organization::find($id);
        $organizations->fill($validated);
        $organizations->save();

        return [
            "message" => "Organization successfully updated.",
            "data" => $organizations
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organizations = Organization::find($id);

        // Delete Image
        if ($organizations->logo)
            Storage::delete($organizations->logo);

        $organizations->delete();

        return [
            "message" => "Organization successfully deleted."
        ];
    }
}
