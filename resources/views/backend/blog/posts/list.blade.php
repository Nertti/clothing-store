@extends('backend.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Список постов</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('')}}">Панель управления</a></li>
                <li class="breadcrumb-item">Блог</li>
                <li class="breadcrumb-item">Посты</li>
                <li class="breadcrumb-item active">Список</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        @include('layouts._message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
{{--                        <h5 class="card-title">Table with hoverable rows</h5>--}}
                        <div class="control-buttons">
                            <a href="{{url('panel/blog/category/add/')}}" class="btn btn-primary">Добавить</a>
                        </div>
                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Заголовок</th>
                                <th scope="col">URL</th>
                                <th scope="col">Активность</th>
                                <th scope="col">Дата создания</th>
                                <th scope="col">Управление</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($getRecord as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->slug}}</td>
                                    <td>{{($value->status === 1) ? 'Да' : 'Нет'}}</td>
                                    <td>{{ date('d.m.Y H:i', strtotime($value->created_at)) }}</td>
                                    <td>
                                        <a href="{{url('panel/blog/category/edit/' . $value->id)}}" class="btn btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a onclick="return confirm('Вы уверены что хотите удалить пользователя?')" href="{{url('panel/blog/category/delete/' . $value->id)}}" class="btn btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Записей не найдено</td>
                                    </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->
                        {!! $getRecord->appends(\Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
