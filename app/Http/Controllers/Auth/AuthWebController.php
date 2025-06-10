<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthWebController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard');
        }

        /* if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // menghindari session fixation
            return redirect()->intended(route('admin.dashboard'));
        } */

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
