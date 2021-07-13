<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\User_Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

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
            $todayDate = Carbon::now()->format('Y-m-d');
            $usersC = User_Campaign::where('user_id', '=', Auth::user()->id)->get();
            $aCampaigns = Campaign::where('delivery_date', '>', $todayDate)->get();
            $user = User::where('id', '=', Auth::user()->id)->first();
            return view('mainPage', compact('user', 'aCampaigns', 'usersC'));
        }
        return redirect()->route("loginPage")->withSuccess('You are not allowed to access');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('loginPage')->withSuccess('You have logged out');
    }

    public function subscribe(Request $request)
    {
        $data = $request->all();
        $create = $this->createSubscribtion($data);

        return redirect()->route('mainPage')->withSuccess('You are subscribed');
    }

    public function createSubscribtion($data)
    {
        return User_Campaign::create([
            'user_id' => Auth::id(),
            'campaign_id' => $data['campaign_id'],
        ]);
    }

    public function unsubscribe(Request $request)
    {
        $data = $request->all();
        $create = $this->deleteSubscribtion($data);

        return redirect()->route('mainPage')->withSuccess('You are unsubscribed');
    }

    public function deleteSubscribtion($data)
    {
        return User_Campaign::where('campaign_id', '=', $data['campaign_id'])->where('user_id', '=', Auth::id())->delete();
    }
}
