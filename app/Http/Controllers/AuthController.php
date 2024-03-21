<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function auth_user(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            if (!empty(Auth::user()->is_admin) && Auth::user()->is_admin == 1) {
                return redirect('panel/dashboard')->with('success', 'Register successfully');
            } else {
                return redirect('account')->with('success', 'Register successfully');
            }
        } else {
            return redirect()->back()->with('error', 'Please enter current email and password');
        }
    }

    public
    function register()
    {
        return view('auth.register');
    }

    public
    function create_user(Request $request)
    {

        request()->validate(array(
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ));

        $save = new User;
        $save->name = trim($request->name);
        $save->email = trim($request->email);
        $save->password = Hash::make($request->password);
        $save->save();

        return redirect('login')->with('success', 'Register successfully');
    }

    public
    function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
