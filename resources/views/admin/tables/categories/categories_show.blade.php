@extends('admin.layouts.admin_layout')



@section('button_form')
    @isset($category)
        <a href="{{ route('admin.categories.edit', ['id' => $category->id]) }}">
            <button type="button" class="btn btn-dark">Редактировать</button>
        </a>
    @endisset
@endsection

@section('content')

    @isset( $category )
        <ul class="form-show">
            <li class="form-group row">
                <span class="col-sm-2 ">Имя</span>
                <div class="col-sm-10">
                    <span>{{ $category->name }}</span>
                </div>
            </li>

            <li class="form-group row">
                <span class="col-sm-2 ">Slug</span>
                <div class="col-sm-10">
                    <span>{{ $category->slug }}</span>
                </div>
            </li>

            <li class="form-group row">
                <span class="col-sm-2 ">Родительская категория</span>
                <div class="col-sm-10">
                    @if($category->parent)
                        <a href="{{ route('admin.categories.show', $category->parent) }}">{{ $category->parent->name }}</a>
                    @else
                        <span>Верхний уровень категорий</span>
                    @endif
                </div>
            </li>
        </ul>
    @endisset

    <div class="button_form container-fluid">
        <a href="{{ route('admin.categories.attributes.create', [$category]) }}"><button class="btn btn-success">Добавить атрибут</button></a>
    </div>

    <h3 align="center">Атрибуты</h3>

    @if( $category->attributes )
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Имя</th>
                    <th scope="col">Тип</th>
                    <th scope="col">Обязательно</th>
                    <th scope="col" class="text-center table_th_button">Действие</th>
                </tr>
            </thead>
            <tbody>
            @foreach($category->attributes as $attribute)
                <tr>
                    <td scope="row">
                        <a href="{{ route('admin.categories.attributes.show', [$category, $attribute]) }}">
                            {{ $attribute->name }}
                        </a>
                    </td>

                    <td>{{ $attribute->type }}</td>

                    <td>{{ $attribute->required ? 'да' : 'нет' }}</td>

                    <td align="center">
                        <a href="{{ route('admin.categories.attributes.edit', [$category, $attribute]) }}">
                            <button type="button" class="btn btn-dark">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

@endsection