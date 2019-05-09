@extends('theme.first.layouts.app')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">Личный кабинет</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1>Личный кабинет пользователя</h1>
                <br>
                <a href="{{ route('profile.adverts.index') }}">Мои объявления</a>
                <br>
                <a href="{{ route('profile.adverts.create') }}">Создать объявление</a>

            </div>
        </div>
    </div>
@endsection