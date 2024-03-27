<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $data['active_class'] = 'category';
        $data['getRecord'] = Category::getRecordCategory()->paginate(10);
        return view('backend.blog.category.list', $data);
    }
    public function category_add( Request $request)
    {
        $data['active_class'] = 'category';
        return view('backend.blog.category.add', $data);
    }
    public function category_insert( Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:category,slug,',
            'meta_title' => 'required',
            'meta_keys' => 'required',
            'meta_desc' => 'required',
        ]);

        if ($validator->fails()) {
            if ($validator->errors()->has('name')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнен заголовок');
            }
            if ($validator->errors()->has('slug')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнен или не уникален URL');
            }
            if ($validator->errors()->has('meta_title')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнен Meta заголовок');
            }
            if ($validator->errors()->has('meta_keys')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнены Meta ключи');
            }
            if ($validator->errors()->has('meta_desc')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнено Meta описание');
            }
        }

        $save = new Category;
        $save->name = trim($request->name);
        $save->slug = trim($request->slug);
        $save->meta_title = trim($request->meta_title);
        $save->meta_keys = trim($request->meta_keys);
        $save->meta_desc = trim($request->meta_desc);

        $save->save();

        return redirect('panel/blog/category/')->with('success', 'Категория успешно добавлена');
    }
    public function category_edit($id)
    {
        $data['active_class'] = 'category';
        $data['getRecord'] = Category::getSingle($id);
        return view('backend.blog.category.edit', $data);
    }
    public function category_update( $id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:category,slug,' . $id,
            'meta_title' => 'required',
            'meta_keys' => 'required',
            'meta_desc' => 'required',
        ]);

        if ($validator->fails()) {
            if ($validator->errors()->has('name')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнен заголовок');
            }
            if ($validator->errors()->has('slug')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнен или не уникален URL');
            }
            if ($validator->errors()->has('meta_title')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнен Meta заголовок');
            }
            if ($validator->errors()->has('meta_keys')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнены Meta ключи');
            }
            if ($validator->errors()->has('meta_desc')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнено Meta описание');
            }
        }

        $save = Category::getSingle($id);
        $save->name = trim($request->name);
        $save->slug = trim($request->slug);
        $save->meta_title = trim($request->meta_title);
        $save->meta_keys = trim($request->meta_keys);
        $save->meta_desc = trim($request->meta_desc);
        $save->status = trim(!empty($request->status) ? 1 : 0);
        $save->save();

        return redirect('panel/blog/category/')->with('success', 'Данные категории обновлены');
    }
    public function category_delete($id)
    {
        $user = Category::getSingle($id);
        $user->delete();
        return redirect('panel/category/')->with('success', 'Категория успешно удалёна');
    }
}
