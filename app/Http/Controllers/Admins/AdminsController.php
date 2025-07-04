<?php

namespace App\Http\Controllers\Admins;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminsController extends Controller
{
    //    <?php
    // ...existing code...

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('view.login');
    }
    // ...existing code...

    public function viewLogin()
    {
        // Return the admin login view
        return view('admins.login');
    }

    public function checkLogin(Request $request) {

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {

            return redirect() -> route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }

    public function index()
    {

        return view('admins.index');
    }


}
