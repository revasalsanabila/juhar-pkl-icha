<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruLoginController extends Controller
{
    public function login()
    {
        return view('auth.guru_login');
    }

    public function auth(Request $request)
    {
        $credential = $request->validate([
            'nip_or_email' => 'required',
            'password' => 'required',
        ]);

        $loginGuru = filter_var($credential['nip_or_email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'nip';

        if (Auth::guard('guru')->attempt([$loginGuru => $credential['nip_or_email'], 'password' => $credential['password']])) {
            return redirect()->route('guru_dashboard');
        }
        return back()->withErrors(['login_error' => 'NIP/Email/Password Salah'])
                     ->onlyInput('nip_or_email');
    }
}
