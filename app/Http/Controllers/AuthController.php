<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function login_post(Request $request)
    {
        if ($request->input('checkbox')) {
            $remember = true;
        } else {
            $remember = false;
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        $result = Auth()->attempt($credentials, $remember);

        if ($result) {
            return redirect('dashboard');
        } else {
            return redirect()->back()->with('error', 'credentials do not match');
        }
    }

    public function logout()
    {
        Auth()->logout();

        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function register_post(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        Auth()->login($user);

        if (Auth()->check()) {
            return redirect('dashboard');
        } else {
            return redirect()->back()->with('error', 'something went wrong');
        }
    }
}
