<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\UserCode;
use Illuminate\Support\Facades\Auth;

class TwoFAController extends Controller
{
    public function index()
    {
        return view('content.2FA.2fa');
    }
     
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $request->validate([
            'code'=>'required',
        ]);
  
        $find = UserCode::where('user_id', auth()->user()->id)
                        ->where('code', $request->code)
                        ->where('updated_at', '>=', now()->subMinutes(2))
                        ->first();
  
        if (!is_null($find)) {
            Session::put('user_2fa', auth()->user()->id);
           return redirect()->intended(route('dashboard-analytics'));
        }
  
        return back()->with('error', 'You entered wrong code.');
    }
      /**
     * Write code on Method
     *
     * @return response()
     */
    public function resend()
    {
        auth()->user()->generateCode();
  
        return back()->with('success', 'We sent you code on your email.');
    }
}
