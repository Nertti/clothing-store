<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function users_list()
    {
        $data['getRecord'] = User::getRecordUser();
        return view('backend.users.list', $data);
    }
    public function add_user( Request $request)
    {
        return view('backend.users.add');
    }
    public function insert_user( Request $request)
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
        $save->is_admin = trim($request->is_admin);
        $save->save();

        return redirect('panel/users/list')->with('success', 'Пользователь успешно добавлен');
    }

    public function edit_user($id)
    {
        $data['getRecord'] = User::getSingle($id);
        return view('backend.users.edit', $data);
    }
    public function update_user( $id, Request $request)
    {
//        request()->validate(array(
//            'name' => 'required',
//            'email' => 'required|email|unique:users',
//        ));

        $save = User::getSingle($id);
        $save->name = trim($request->name);
        $save->email = trim($request->email);
        $save->is_admin = trim($request->is_admin);
        $save->save();

        return redirect('panel/users/list')->with('success', 'Данные пользователя обновлены');
    }
    public function delete_user($id)
    {
        $user = User::getSingle($id);
        $user->delete();
        return redirect('panel/users/list')->with('success', 'Пользователь успешно удалён');
    }
}
