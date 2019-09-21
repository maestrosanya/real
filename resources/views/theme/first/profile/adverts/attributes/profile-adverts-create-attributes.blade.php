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

                <form id="createAdvertForm" action="{{ route('profile.adverts.create.store', ['category' => $category] ) }}" method="POST">

                    @csrf
                    @method('POST')

                    <h3>Параметры</h3>

                    <div class="form-group row">
                        <label for="title" class="col-sm-4 col-form-label">Название объявления</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="col-sm-8 form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">
                        @if($errors->has('title'))
                            <div class="invalid-feedback offset-sm-4">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="content" class="col-sm-4 col-form-label">Описание</label>
                        <textarea name="content" id="content" class="col-sm-8 form-control {{ $errors->has('content') ? 'is-invalid' : '' }}">{{ old('content') }}</textarea>
                        @if($errors->has('content'))
                            <div class="invalid-feedback offset-sm-4">
                                {{ $errors->first('content') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="price" class="col-sm-4 col-form-label">Цена</label>
                        <input type="text" inputmode="numeric" name="price" id="price" value="{{ old('price') }}" class="col-sm-8 form-control {{ $errors->has('price') ? 'is-invalid' : '' }}">
                        @if($errors->has('price'))
                            <div class="invalid-feedback offset-sm-4">
                                {{ $errors->first('price') }}
                            </div>
                        @endif
                    </div>

                    @if($category->allAttributes())
                            @foreach($category->allAttributes() as $attribute)

                                @if($attribute->isString())
                                    <div class="form-group row">
                                        <label for="{{ $attribute->id }}" class="col-sm-4 col-form-label">{{ $attribute->name }}</label>
                                        <input type="text" name="attribute[{{ $attribute->id }}]" id="{{ $attribute->id }}" value="{{ old('attribute.' . $attribute->id) }}" class="col-sm-8 form-control {{ $errors->has('attribute.' . $attribute->id) ? 'is-invalid' : '' }}">
                                        @if($errors->has('attribute.' . $attribute->id))
                                            <div class="invalid-feedback offset-sm-4">
                                                {{ $errors->first('attribute.' . $attribute->id) }}
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                @if($attribute->isSelect())
                                    <div class="form-group row">
                                        <label for="{{ $attribute->id }}" class="col-sm-4 col-form-label">{{ $attribute->name }}</label>
                                        <select name="attribute[{{ $attribute->id }}]" id="{{ $attribute->id }}"  class="col-sm-8 form-control {{ $errors->has('attribute.' . $attribute->id ) ? 'is-invalid' : ''}}">
                                            <option value="">-------</option>
                                            @if(!empty($attribute->variants))
                                                @foreach(json_decode($attribute->variants) as $variant)
                                                    <option value="{{ $variant }}" {{ old('attribute.' . $attribute->id) == $variant ? 'selected' : '' }}>{{ $variant }}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        @if($errors->has('attribute.' . $attribute->id ))
                                            <div class="invalid-feedback offset-sm-4">
                                                {{ $errors->first('attribute.' . $attribute->id ) }}
                                            </div>
                                        @endif

                                    </div>
                                @endif

                                @if($attribute->isInteger())
                                    <div class="form-group row">
                                        <label for="{{ $attribute->id }}" class="col-sm-4 col-form-label">{{ $attribute->name }}</label>
                                        <input type="number" min="0" name="attribute[{{ $attribute->id }}]" id="{{ $attribute->id }}" value="{{ old('attribute.' . $attribute->id) }}" class="col-sm-8 form-control {{ $errors->has('attribute.' . $attribute->id ) ? 'is-invalid' : ''}}">
                                        @if($errors->has('attribute.' . $attribute->id ))
                                            <div class="invalid-feedback offset-sm-4">
                                                {{ $errors->first('attribute.' . $attribute->id ) }}
                                            </div>
                                        @endif
                                    </div>
                                @endif

                            @endforeach
                    @endif

                    <h3>Контактная информация</h3>



                    <example-component></example-component>
                    <select-region :errors="{{ $errors }}"></select-region>





                    <div class="form-group row">
                        <label for="phone" class="col-sm-4 col-form-label">Телефон</label>
                        <input type="text"  inputmode="tel" name="phone" id="phone" value="{{ old('phone') }}" class="col-sm-8 form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" placeholder="8 ___ ___-__-__">
                        @if($errors->has('phone'))
                            <div class="invalid-feedback offset-sm-4">
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                    </div>

                    <button type="submit">Создать объявление</button>

                </form>

            </div>
        </div>
    </div>
@endsection



