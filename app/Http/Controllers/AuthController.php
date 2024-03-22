<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'terms' => 'required',
        ]);

        if ($validator->fails()) {
            if ($validator->errors()->has('name')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнено имя');
            }

            if ($validator->errors()->has('email')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Email не заполнен или уже занят');
            }

            if ($validator->errors()->has('password')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнен пароль');
            }
            if ($validator->errors()->has('terms')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Вы должны согласиться перед отправкой');
            }
        }

        $save = new User;
        $save->name = trim($request->name);
        $save->email = trim($request->email);
        $save->password = Hash::make($request->password);
        $save->save();

        return redirect('login')->with('success', 'Вы успешно авторизовались');
    }

    public
    function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
