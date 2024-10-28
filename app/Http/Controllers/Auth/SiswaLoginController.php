<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaLoginController extends Controller
{
    public function login()
    {
        return view('auth.siswa_login');
    }

    public function auth(Request $request)
    {
        $credential = $request->validate([
            'nisn' => 'required',
            'password' => 'required',
        ]);
    
        if (Auth::guard('siswa')->attempt($credential)) {
            return redirect()->route('siswa.dashboard');
        }

        return back()->withErrors(['login_error' => 'NISN/Password Salah'])
                    ->onlyInput('nisn');
    }
}
