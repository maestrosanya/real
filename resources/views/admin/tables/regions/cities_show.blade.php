@extends('admin.layouts.admin_layout')



@section('button_form')
    @isset($city)
        <a href="{{ route('admin.cities.edit', ['id' => $city->id]) }}">
            <button type="button" class="btn btn-dark">Редактировать</button>
        </a>

        <form action="{{ route('admin.cities.destroy', ['id' => $city->id]) }}" method="POST" class="list-inline-item">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
        </form>
    @endisset
@endsection

@section('content')

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @isset( $city )
        <table class="table table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Город</th>
                <th scope="col">Регион</th>
                <th scope="col">Slug</th>
            </tr>
            </thead>


            <tbody>

                <tr>
                    <td>{{ $city->id }}</td>
                    <td>{{ $city->name }}</td>
                    <td>{{ $city->region->name }}</td>
                    <td>{{ $city->slug }}</td>

                </tr>

            </tbody>
        </table>


    @endisset
@endsection
