<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
            'locked',
            'unlock',
            'toLocked'
        ]);
    }

    public function locked()
    {
        if(!session('lock-expires-at')){
            return redirect('/');
        }

        if(session('lock-expires-at') > now()){
            return redirect('/');
        }

        return view('auth.locked');
    }

    public function unlock(Request $request)
    {
        $check = Hash::check($request->input('password'), $request->user()->password);

        if(!$check){
            return redirect()->route('dashboard')->withErrors([
                'Your password does not match your profile.'
            ]);
        }

        session(['lock-expires-at' => now()->addMinutes($request->user()->getLockoutTime())]);

        return redirect('/dashboard');
    }

    public function toLocked(Request $request)
    {
        session(['lock-expires-at' => now()->subMinutes(1)]);
        return redirect()->route('login.locked');
    }
}
