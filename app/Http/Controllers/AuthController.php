<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'=> 'required|string|max:255',
            'email'=> 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        log_audit('lietotājs_reģistrēts', $user, ['email' => $user->email]);

        return redirect()->route('ieraksti.index')->with('success', 'Reģistrācija veiksmīga!');
    }

    public function login(Request $request)
    {
        $attempt = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($attempt)){
            $request->session()->regenerate();
            return redirect()->intended(route('ieraksti.index'));
        }

        $user = Auth::user();

        log_audit('lietotājs_pieslēdzies', $user, ['email' => $user->email]);

        return back()->withErrors([
            'email' => 'Nepareizs e-pasts vai parole!',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        log_audit('lietotājs_izrakstījies', $user, ['email' => $user->email]);

        return redirect()->route('login')->with('success', 'Izrakstīšanās veiksmīga');
    }
}
