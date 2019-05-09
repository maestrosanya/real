@extends('admin.layouts.admin_layout')



@section('button_form')
    <a href="{{ route('admin.regions.create') }}">
        <button type="button" class="btn btn-success">Добавить</button>
    </a>
@endsection

@section('content')

    @isset( $regions )
        <table class="table table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Название</th>
                <th scope="col">Slug</th>
                <th scope="col" class="text-center">Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($regions as $region)
                <tr>
                    <td>{{ $region->id }}</td>
                    <td>
                        <a href="{{ route('admin.regions.show', ['id' => $region->id]) }}">{{ $region->name }}</a>
                    </td>
                    <td>{{ $region->slug }}</td>

                    <td align="center">
                        <a href="{{ route('admin.regions.edit', ['id' => $region->id]) }}">
                            <button type="button" class="btn btn-dark">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="table-paginate">
            {{ $regions->links() }}
        </div>

    @endisset
@endsection