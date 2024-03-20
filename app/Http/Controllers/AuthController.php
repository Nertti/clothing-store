<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function auth_user (Request $request)
    {
        $remember = !empty($request->remember) ? true : false;

        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $remember))
        {
            if (!empty(Auth::user()->email_verified_at))
            {
                echo 'successfully';
            }
            else
            {
                echo 'successfully 2';
            }
        }else{
            return redirect()->back()->with('error', 'Please enter current email and password');
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function create_user(Request $request)
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
}
