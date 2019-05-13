@extends('theme.first.layouts.app')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Личный кабинет</a></li>
            <li class="breadcrumb-item active" aria-current="page">Мои объявления</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1>Мои объявления</h1>
                <br />
                <a href="{{ route('profile.adverts.create') }}">Создать объявление</a>
                <hr />

                <h1>Список объявлений</h1>
                <br />
                <a href="{{ route('profile.adverts.show', ['id' => 1]) }}">Продаю корову</a>

            </div>
        </div>
    </div>
@endsection