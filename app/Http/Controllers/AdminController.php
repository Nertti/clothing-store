<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function users_list()
    {
        $data['active_class'] = 'users';
        $data['getRecord'] = User::getRecordUser()->paginate(10);
        $data['getRecordAdmin'] = User::getRecordUserAdmin()->get();
//        $data['getRecordAdmin'] = User::getRecordUserAdmin()->paginate(10);
        return view('backend.users.list', $data);
    }
    public function add_user( Request $request)
    {
        $data['active_class'] = 'users';
        return view('backend.users.add', $data);
    }
    public function insert_user( Request $request)
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

        return redirect('panel/users/list')->with('success', 'Пользователь успешно добавлен');
    }
    public function edit_user($id)
    {
        $data['active_class'] = 'users';
        $data['getRecord'] = User::getSingle($id);
        return view('backend.users.edit', $data);
    }
    public function update_user( $id, Request $request)
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

        return redirect('panel/users/list')->with('success', 'Данные пользователя обновлены');
    }
    public function delete_user($id)
    {
        $user = User::getSingle($id);
        $user->delete();
        return redirect('panel/users/list')->with('success', 'Пользователь успешно удалён');
    }


    public function category_list()
    {
        $data['active_class'] = 'users';
        $data['getRecord'] = User::getRecordUser();
        return view('backend.blog.category.list', $data);
    }
    public function category_add( Request $request)
    {
        $data['active_class'] = 'users';
        return view('backend.blog.category.list', $data);
    }
    public function category_insert( Request $request)
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

        return redirect('panel/users/list')->with('success', 'Пользователь успешно добавлен');
    }
    public function category_edit($id)
    {
        $data['active_class'] = 'users';
        $data['getRecord'] = User::getSingle($id);
        return view('backend.blog.category.edit', $data);
    }
    public function category_update( $id, Request $request)
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

        return redirect('panel/users/list')->with('success', 'Данные пользователя обновлены');
    }
    public function category_delete($id)
    {
        $user = User::getSingle($id);
        $user->delete();
        return redirect('panel/users/list')->with('success', 'Пользователь успешно удалён');
    }
}
