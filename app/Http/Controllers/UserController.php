<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function list()
    {
        $data['active_class'] = 'users';
        $data['getRecord'] = User::getRecordUser()->get();
//        $data['getRecord'] = User::getRecordUser()->paginate(10);
        $data['getRecordAdmin'] = User::getRecordUserAdmin()->get();
//        $data['getRecordAdmin'] = User::getRecordUserAdmin()->paginate(10);
        return view('backend.users.list', $data);
    }
    public function add( Request $request)
    {
        $data['active_class'] = 'users';
        return view('backend.users.add', $data);
    }
    public function insert( Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        if ($validator->fails()) {
            if ($validator->errors()->has('name')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнено имя');
            }

            if ($validator->errors()->has('email')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнен email или email уже занят');
            }
        }

        $save = new User;
        $save->name = trim($request->name);
        $save->email = trim($request->email);
        $save->password = Hash::make($request->password);
        $save->is_admin = trim($request->is_admin);
        $save->save();

        return redirect('panel/users/')->with('success', 'Пользователь успешно добавлен');
    }
    public function edit($id)
    {
        $data['active_class'] = 'users';
        $data['getRecord'] = User::getSingle($id);
        return view('backend.users.edit', $data);
    }
    public function update( $id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id
        ]);

        if ($validator->fails()) {
            if ($validator->errors()->has('name')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнено имя');
            }

            if ($validator->errors()->has('email')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнен email или email уже занят');
            }
        }

        $save = User::getSingle($id);
        $save->name = trim($request->name);
        $save->email = trim($request->email);
        $save->is_admin = trim($request->is_admin);
        $save->save();

        return redirect('panel/users/')->with('success', 'Данные пользователя обновлены');
    }
    public function delete($id)
    {
        $user = User::getSingle($id);
        $user->delete();
        return redirect('panel/users/')->with('success', 'Пользователь успешно удалён');
    }
}
