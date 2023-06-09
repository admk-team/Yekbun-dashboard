<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PaymentOffice;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePaymentOfficeRequest;
use App\Http\Requests\UpdatePaymentOfficeRequest;

class PaymentOfficeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentOffices = PaymentOffice::orderBy("updated_at", "DESC")->get();
        return view("content.payment_offices.index", compact("paymentOffices"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("content.payment_offices.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentOfficeRequest $request)
    {
        $validated = $request->validated();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->image->store("/payment_offices", "public");
            $validated["image_path"] = $imagePath;
        }

        $paymentOffice = PaymentOffice::create($validated);

        return back()->with("success", "Payment office successfully created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paymentOffice = PaymentOffice::find($id);
        return view("content.payment_offices.show", compact("paymentOffice"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentOffice = PaymentOffice::find($id);
        return view("content.payment_offices.edit", compact("paymentOffice"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentOfficeRequest $request, $id)
    {
        $validated = $request->validated();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->image->store("/payment_offices", "public");
            $validated["image_path"] = $imagePath;
        }

        $paymentOffice = PaymentOffice::find($id);
        $paymentOffice->fill($validated);
        $paymentOffice->save();

        return back()->with("success", "Payment office successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentOffice = PaymentOffice::find($id);

        // Delete Image
        if ($paymentOffice->image)
            Storage::delete($paymentOffice->image);

        $paymentOffice->delete();

        return back()->with("success", "Payment office successfully deleted.");
    }
}
