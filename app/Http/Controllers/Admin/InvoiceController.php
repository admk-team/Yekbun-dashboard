<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
class InvoiceController extends Controller
{
    

    public function update_address(Request $request){
    
        $address = new Invoice();
        $address = Invoice::first() ?? $address;
        $address->address = $request->address;
        $address->title = $request->title;
        
        if($request->has('logo')){
            if(isset($address->logo)){
                $logo_path = public_path('storage/'.$address->logo);
                if(file_exists($logo_path)){
                    unlink($logo_path);
                }
                $image_path = $request->file('logo')->store('images/invoice/logo','public');
                $address->logo = $image_path;    
            }
            
        }
        if($address->save()){
            return back()->with('success' , 'Address updated successfully');
        }
    }
}
