<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('mainPage')->withSuccess('Signed in');
        }

        return redirect()->route('loginPage')->withSuccess('Login details are not valid');
    }

    public function registrationPage()
    {
        return view('auth.registration');
    }

    public function registration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'address' => 'required',
            'phone_number' => 'required',
        ]);

        $data = $request->all();
        $check = $this->createUser($data);

        return redirect()->route('loginPage')->withSuccess('You have signed-in');
    }

    public function createUser(array $data)
    {
        $count = count($data);
        if ($count == 6) {
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'address' => $data['address'],
                'phone_number' => $data['phone_number'],
            ]);
        } else {
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'address' => $data['address'],
                'phone_number' => $data['phone_number'],
                'role' => $data['role'],
            ]);
        }
    }

    public function mainPage()
    {
        if (Auth::check()) {
            return view('mainPage');
        }
        return redirect()->route("loginPage")->withSuccess('You are not allowed to access');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('loginPage')->withSuccess('You have logged out');
    }
}
