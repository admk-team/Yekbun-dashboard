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
            if (Auth::user()->enable_2fa) {
                auth()->user()->generateCode();
                return redirect()->route('2fa.index');
            }
            
            activity()
                ->event('logged_in')
                ->log("<strong>" . Auth::user()->name . "</strong> logged in");
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard-analytics'));
        }
    
        return back()->withInput(request()->only(['email', 'password']))->with('error', "Invalid Credentials!");
    }

    public function logout(Request $request)
    {
        activity()
            ->event('logged_out')
            ->log("<strong>" . Auth::user()->name . "</strong> logged out");
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('admin.login');
    }
}
