@extends('backend.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Изменить пользователя</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('')}}">Панель управления</a></li>
                <li class="breadcrumb-item">Пользователи</li>
                <li class="breadcrumb-item active">Изменить пользователя</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        @include('layouts._message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Form -->
                        <br>
                        <form class="row g-3"  action="" method="post" novalidate>
                            {{csrf_field()}}
                            <div class="col-8">
                                <label for="name" class="form-label">Заголовок</label>
                                <input id="name" type="text" name="name" value="{{ $getRecord->name }}" required class="form-control">
                            </div>
                            <div class="col-4">
                                <label for="slug" class="form-label">URL</label>
                                <input id="slug" type="text" name="slug" value="{{ $getRecord->slug }}" required class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="meta_title" class="form-label">Meta заголовок</label>
                                <input id="meta_title" type="text" name="meta_title" value="{{ $getRecord->meta_title }}" required class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="meta_keys" class="form-label">Meta ключевые слова</label>
                                <input id="meta_keys" type="text" name="meta_keys" value="{{ $getRecord->meta_keys }}" required class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="meta_desc" class="form-label">Meta описание</label>
                                <textarea id="meta_desc" name="meta_desc" required class="form-control">{{ $getRecord->meta_desc }}</textarea>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" name="status" type="checkbox" value="1" id="invalidCheck2" required {{ ($getRecord->status  == 1) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="invalidCheck2">
                                        Активность
                                    </label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Сохранить</button>
                                <a href="{{url('panel/users')}}" class="btn btn-outline-secondary">Назад</a>
                            </div>
                        </form><!-- End Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
