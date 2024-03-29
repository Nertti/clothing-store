@extends('backend.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Добавить категорию</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('')}}">Панель управления</a></li>
                <li class="breadcrumb-item">Блог</li>
                <li class="breadcrumb-item">Категории</li>
                <li class="breadcrumb-item active">Добавить категорию</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @include('layouts._message')
                        <form class="row g-3" action="" method="post" novalidate>
                            {{csrf_field()}}
                            <div class="col-8">
                                <label for="name" class="form-label">Заголовок</label>
                                <input id="name" type="text" name="name" value="{{old('name')}}" required class="form-control">
                            </div>
                            <div class="col-4">
                                <label for="slug" class="form-label">URL</label>
                                <input id="slug" type="text" name="slug" value="{{old('slug')}}" required class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="meta_title" class="form-label">Meta заголовок</label>
                                <input id="meta_title" type="text" name="meta_title" value="{{old('meta_title')}}" required class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="meta_keys" class="form-label">Meta ключевые слова</label>
                                <input id="meta_keys" type="text" name="meta_keys" value="{{old('meta_keys')}}" required class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="meta_desc" class="form-label">Meta описание</label>
                                <textarea id="meta_desc" name="meta_desc" required class="form-control">{{old('meta_desc')}}</textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Сохранить</button>
                                <button type="reset" class="btn btn-outline-secondary">Сбросить</button>
                                <a href="{{url('panel/blog/category/')}}" class="btn btn-secondary">Назад</a>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
