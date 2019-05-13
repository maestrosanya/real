@extends('theme.first.layouts.app')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Личный кабинет</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile.adverts.create') }}">Создать объявление</a></li>
            <li class="breadcrumb-item active" aria-current="page">Выбор атрибутов</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1>Создать объявление</h1>
                <br />
                <div class="form-group">
                    <h5>Категория:</h5>
                    <p>{{ $category->name }}</p>
                </div>
                <hr />
                <h3>Выбор атрибутов</h3>

                <form action="{{ route('profile.adverts.store') }}">

                    @if($category->attributes)
                        <div class="form-group">
                            @foreach($category->attributes as $attribute)

                                @if($attribute->type == 'string')
                                    <label for="{{ $attribute->id }}">{{ $attribute->name }}</label>
                                @endif

                            @endforeach
                        </div>
                    @endif

                </form>



                <h1>Список объявлений</h1>
                <br />
                <a href="{{ route('profile.adverts.show', ['id' => 1]) }}">Продаю корову</a>

            </div>
        </div>
    </div>
@endsection