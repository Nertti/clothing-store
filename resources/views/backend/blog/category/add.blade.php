@extends('backend.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Добавить пользователя</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('')}}">Панель управления</a></li>
                <li class="breadcrumb-item">Пользователи</li>
                <li class="breadcrumb-item active">Добавить пользователя</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
{{--                        <h5 class="card-title">Horizontal Form</h5>--}}

                        <!-- Form -->
                        <br>
                        @include('layouts._message')

                        <form action="" method="post">
                            {{csrf_field()}}
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Имя</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="{{old('name')}}" required class="form-control" id="inputText">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" value="{{old('email')}}" required class="form-control" id="inputEmail">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Пароль</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" required class="form-control" id="inputPassword">
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Админ</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" {{ (old('is_admin') == 1) ? 'checked' : '' }} name="is_admin" id="gridRadios1" value="1">
                                        <label class="form-check-label" for="gridRadios1">
                                            Да
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" {{ (old('is_admin') == 0) ? 'checked' : '' }} name="is_admin" id="gridRadios2" value="0">
                                        <label class="form-check-label" for="gridRadios2">
                                            Нет
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Сохранить</button>
                                <button type="reset" class="btn btn-outline-secondary">Сбросить</button>
                                <a href="{{url('panel/users')}}" class="btn btn-secondary">Назад</a>
                            </div>
                        </form><!-- End Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
