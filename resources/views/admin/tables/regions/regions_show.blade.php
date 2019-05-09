@extends('admin.layouts.admin_layout')



@section('button_form')
    @isset($region)
        <a href="{{ route('admin.regions.create', ['parent_id' => $region->id]) }}">
            <button type="button" class="btn btn-success">Добавить</button>
        </a>
    @endisset
@endsection

@section('content')

    @isset( $region )
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
                @foreach($sub_regions as $sub_region)
                    <tr>
                        <td>{{ $sub_region->id }}</td>
                        <td>
                            <a href="{{ route('admin.regions.show', ['id' => $sub_region->id]) }}">{{ $sub_region->name }}</a>
                        </td>
                        <td>{{ $sub_region->slug }}</td>

                        <td align="center">
                            <a href="{{ route('admin.regions.edit', ['id' => $sub_region->id]) }}">
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