<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function list()
    {
        $data['active_class'] = 'category';
//        $data['getRecord'] = Category::getRecordCategory()->paginate(10);
        $data['getRecord'] = Category::getRecordCategory()->get();
        return view('backend.blog.category.list', $data);
    }
    public function add( Request $request)
    {
        $data['active_class'] = 'category';
        return view('backend.blog.category.add', $data);
    }
    public function insert( Request $request)
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
    public function edit($id)
    {
        $data['active_class'] = 'category';
        $data['getRecord'] = Category::getSingle($id);
        return view('backend.blog.category.edit', $data);
    }
    public function update( $id, Request $request)
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
    public function delete($id)
    {
        $user = Category::getSingle($id);
        $user->delete();
        return redirect('panel/blog/category/')->with('success', 'Категория успешно удалёна');
    }
}
