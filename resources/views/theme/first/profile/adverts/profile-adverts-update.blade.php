@extends('theme.first.layouts.app')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Личный кабинет</a></li>
            <li class="breadcrumb-item active" aria-current="page">Редактировать Объявление</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1>Редактировать Объявление</h1>
                <br>
                <a href="{{ route('profile.adverts.update', ['id' => 1]) }}">Сохранить</a>

            </div>
        </div>
    </div>
@endsection