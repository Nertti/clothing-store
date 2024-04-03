@extends('backend.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Добавить категорию</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('')}}">Панель управления</a></li>
                <li class="breadcrumb-item">Блог</li>
                <li class="breadcrumb-item">Посты</li>
                <li class="breadcrumb-item active">Добавить пост</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @include('layouts._message')
                        <form class="row g-3" action="" method="post" novalidate enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="col-8">
                                <label for="name" class="form-label">Заголовок</label>
                                <input id="name" type="text" name="name" value="{{old('name')}}" required
                                       class="form-control">
                            </div>
                            <div class="col-4">
                                <label for="slug" class="form-label">URL</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"
                                          id="slug-addon">https://example.com/blog/category/</span>
                                    <input id="slug" type="text" name="slug" value="{{old('slug')}}" required
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelect"
                                            aria-label="Floating label select example" name="id_category">
                                        <option selected="">Выберите одну из доступных категорий</option>
                                        @forelse($getCategory as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @empty

                                        @endforelse
                                    </select>
                                    <label for="floatingSelect">Категория</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="formFile" class="col-sm-2 col-form-label">Изображение</label>
                                <input class="form-control" type="file" id="formFile" name="image">
                            </div>
                            <div class="col-12">
                                <label for="description" class="col-sm-2 col-form-label">Контент</label>
                                <textarea class="tinymce-editor" id="description" name="description">{{old('description')}}</textarea>
                            </div>
                            <br>
                            <hr>
                            <div class="col-6">
                                <label for="meta_title" class="form-label">Meta заголовок</label>
                                <input id="meta_title" type="text" name="meta_title" value="{{old('meta_title')}}"
                                       required class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="meta_keys" class="form-label">Meta ключевые слова</label>
                                <input id="meta_keys" type="text" name="meta_keys" value="{{old('meta_keys')}}" required
                                       class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="meta_desc" class="form-label">Meta описание</label>
                                <textarea id="meta_desc" name="meta_desc" required
                                          class="form-control">{{old('meta_desc')}}</textarea>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" name="status" type="checkbox" value="1"
                                           id="invalidCheck2" required>
                                    <label class="form-check-label" for="invalidCheck2">
                                        Активность
                                    </label>
                                </div>
                            </div>
                            <input hidden="" type="text" name="id_user" value="{{ Auth::user()->id }}">
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Сохранить</button>
                                <button type="reset" class="btn btn-outline-secondary">Сбросить</button>
                                <a href="{{url('panel/blog/posts/')}}" class="btn btn-secondary">Назад</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
