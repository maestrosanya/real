@extends('theme.first.layouts.app')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Личный кабинет</a></li>
            <li class="breadcrumb-item active" aria-current="page">Просмотр Объявление</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1>Просмотр Объявления</h1>
                <br>
                <h3>{{ $title }}</h3>

                <hr>
                <a href="{{ route('profile.adverts.edit', ['id' => 1]) }}">Редактировать объявление</a>

            </div>
        </div>
    </div>
@endsection