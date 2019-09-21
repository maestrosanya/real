@extends('admin.layouts.admin_layout')



@section('button_form')
    @isset($category, $attribute)
        <a href="{{ route('admin.categories.attributes.edit', [$category, $attribute]) }}">
            <button type="button" class="btn btn-dark">Редактировать</button>
        </a>

        <form action="{{ route('admin.categories.attributes.destroy', [$category, $attribute]) }}" method="POST" class="list-inline-item">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
        </form>
    @endisset
@endsection

@section('content')

    <h3 align="center">Атрибут</h3>

    @isset( $attribute )

        <ul class="form-show">

            @isset( $category )
                <li class="form-group row">
                    <span class="col-sm-2 ">Принадлежит категории</span>
                    <div class="col-sm-10">
                        <a href="{{ route('admin.categories.show', $category) }}">{{ $category->name }}</a>
                    </div>
                </li>
            @endisset

            <li class="form-group row">
                <span class="col-sm-2 ">Имя</span>
                <div class="col-sm-10">
                    <span>{{ $attribute->name }}</span>
                </div>
            </li>

            <li class="form-group row">
                <span class="col-sm-2 ">Тип</span>
                <div class="col-sm-10">
                    <span>{{ $attribute->type }}</span>
                </div>
            </li>

            <li class="form-group row">
                <span class="col-sm-2 ">Обязателен для заполнения</span>
                <div class="col-sm-10">
                    <span>{{ $attribute->required ? 'Да' : 'Нет'}}</span>
                </div>
            </li>

            <li class="form-group row">
                <span class="col-sm-2 ">Сортировка</span>
                <div class="col-sm-10">
                    <span>{{ $attribute->sort }}</span>
                </div>
            </li>

            <li class="form-group row">
                <span class="col-sm-2 ">Варианты</span>

                <ul class="form-show col-sm-10">
                    @if(!empty(json_decode($attribute->variants)))
                        @foreach(json_decode($attribute->variants) as $variant)
                            <li class="form-group col-sm-10 row">
                                <span>{{ $variant }}</span>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </li>

        </ul>

    @endisset

@endsection
