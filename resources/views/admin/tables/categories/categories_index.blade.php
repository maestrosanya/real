@extends('admin.layouts.admin_layout')



@section('button_form')
    <a href="{{ route('admin.categories.create') }}">
        <button type="button" class="btn btn-success">Добавить</button>
    </a>
@endsection

@section('content')

    @isset( $categories )

        <table class="table table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col">Имя</th>
                <th scope="col">Slug</th>
                <th scope="col" class="text-center">Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>
                        @for($i=0; $i<$category->depth; $i++) &mdash; @endfor
                        <a href="{{ route('admin.categories.show', $category) }}">
                            {{ $category->name }}
                        </a>
                    </td>

                    <td>{{ $category->slug }}</td>

                    <td align="center">
                        <a href="{{ route('admin.categories.edit', ['id' => $category->id]) }}">
                            <button type="button" class="btn btn-dark">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endisset
@endsection