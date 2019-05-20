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
                    <h4>Категория:</h4>
                    <p>{{ $category->name }}</p>
                </div>
                <hr />
                <h5>Выбор атрибутов</h5>

                <form action="{{ route('profile.adverts.store') }}">

                    @if($category->allAttributes())
                            @foreach($category->allAttributes() as $attribute)

                                {{--@php
                                    dump($attribute);
                                @endphp--}}

                                @if($attribute->isString())
                                    <div class="form-group row">
                                        <label for="{{ $attribute->id }}" class="col-sm-4 col-form-label">{{ $attribute->name }}</label>
                                        <input type="text" id="{{ $attribute->id }}" class="form-control">
                                    </div>
                                @endif

                                @if($attribute->isSelect())
                                    <div class="form-group row">
                                        <label for="{{ $attribute->id }}" class="col-sm-4 col-form-label">{{ $attribute->name }}</label>
                                        <select name="" id="{{ $attribute->id }}" class="form-control">
                                            @if(!empty($attribute->variants))
                                                @foreach(json_decode($attribute->variants) as $variant)
                                                    <option value="{{ $variant }}">{{ $variant }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                @endif

                            @if($attribute->isInteger())
                                <div class="form-group row">
                                    <label for="{{ $attribute->id }}" class="col-sm-4 col-form-label">{{ $attribute->name }}</label>
                                    <input type="number" id="{{ $attribute->id }}" class="form-control">
                                </div>
                            @endif

                            @endforeach
                    @endif

                </form>



                <h1>Список объявлений</h1>
                <br />
                <a href="{{ route('profile.adverts.show', ['id' => 1]) }}">Продаю корову</a>

            </div>
        </div>
    </div>
@endsection