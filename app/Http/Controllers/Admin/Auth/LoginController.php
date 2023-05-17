<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.login', ['pageConfigs' => $pageConfigs]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials['is_admin_user'] = true;
        $credentials['status'] = 1;

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard-analytics'));
        }
    
        return back()->withInput(request()->only(['email', 'password']))->with('error', "Invalid Credentials!");
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('admin.login');
    }
}
