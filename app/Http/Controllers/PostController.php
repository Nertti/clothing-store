<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function list()
    {
        $data['active_class'] = 'posts';
//        $data['getRecord'] = Post::getRecord()->paginate(10);
        $data['getRecord'] = Post::getRecord()->get();
        return view('backend.blog.posts.list', $data);
    }

    public function add(Request $request)
    {
        $data['active_class'] = 'posts';
        $data['getCategory'] = Category::getCategory()->get();
        return view('backend.blog.posts.add', $data);
    }

    public function insert(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:posts,slug,',

            'id_category' => 'required',
            'description' => 'required',
            'image' => 'required',

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
            if ($validator->errors()->has('id_category')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнена категория');
            }
            if ($validator->errors()->has('description')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнен контент поста');
            }
            if ($validator->errors()->has('image')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнена картинка');
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

        $save = new Post;
        $save->name = trim($request->name);
        $save->slug = trim($request->slug);

        $save->id_category = trim($request->id_category);
        $save->description = trim($request->description);
        //$save->image = trim($request->image);

        $save->meta_title = trim($request->meta_title);
        $save->meta_keys = trim($request->meta_keys);
        $save->meta_desc = trim($request->meta_desc);

        $save->status = trim(!empty($request->status) ? 1 : 0);
        $save->id_user = trim($request->id_user);

        if (!empty($request->file('image')))
        {
            $ext = $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $random_number = rand(10000, 99999);
            $current_datetime = date('YmdHis');
            $filename = $current_datetime . '_' . $random_number . '.' . $ext;
            $file->move('upload/blog/', $filename);
            $save->image = $filename;
        }
        $save->save();

        return redirect('panel/blog/posts/')->with('success', 'Пост успешно добавлен');
    }

    public function edit($id)
    {
        $data['active_class'] = 'posts';
        $data['getRecord'] = Post::getSingle($id);
        $data['getCategory'] = Category::getCategory()->get();
        return view('backend.blog.posts.edit', $data);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:posts,slug,' . $id,

            'id_category' => 'required',
            'description' => 'required',
            'image' => 'required',

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
            if ($validator->errors()->has('id_category')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнена категория');
            }
            if ($validator->errors()->has('description')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнен контент поста');
            }
            if ($validator->errors()->has('image')) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Не заполнена картинка');
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

        $save = Post::getSingle($id);
        $save->name = trim($request->name);
        $save->slug = trim($request->slug);

        $save->id_category = trim($request->id_category);
        $save->description = trim($request->description);
        //$save->image = trim($request->image);

        $save->meta_title = trim($request->meta_title);
        $save->meta_keys = trim($request->meta_keys);
        $save->meta_desc = trim($request->meta_desc);

        $save->status = trim(!empty($request->status) ? 1 : 0);
        $save->id_user = trim($request->id_user);

        if (!empty($request->file('image')))
        {
            if (!empty($save->getImage()))
            {
                unlink('upload/blog/'. $save->image);
            }
            $ext = $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $random_number = rand(10000, 99999);
            $current_datetime = date('YmdHis');
            $filename = $current_datetime . '_' . $random_number . '.' . $ext;
            $file->move('upload/blog/', $filename);
            $save->image = $filename;
        }

        $save->save();

        return redirect('panel/blog/posts/')->with('success', 'Данные поста обновлены');
    }

    public function delete($id)
    {
        $blog = Post::getSingle($id);
        if (!empty($blog->getImage()))
        {
            unlink('upload/blog/'. $blog->image);
        }
        $blog->delete();
        return redirect('panel/blog/posts/')->with('success', 'Пост успешно удалён');
    }
}
