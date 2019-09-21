@extends('admin.layouts.admin_layout')



@section('button_form')
    <a href="{{ route('admin.users.create') }}">
        <button type="button" class="btn btn-success">Добавить</button>
    </a>
@endsection

@section('content')

    <form action="?" method="GET" class="col">
        <div class="col">
            <button type="submit" class="btn btn-primary">Фильтр</button>
        </div>
        <div class="form-row py-4">
            <div class="col">
                <label for="name" class="col">Имя</label>
                <input id="name" name="name" type="text" class="form-control">
            </div>

            <div class="col">
                <label for="email" class="col">Email</label>
                <input id="email" name="email" type="text" class="form-control">
            </div>

            @isset($statuses)
                <div class="col">
                    <label for="status" class="col">Статус</label>
                    <select id="status" name="status" class="form-control">
                            <option value="" selected></option>
                        @foreach($statuses as $status => $value)
                            <option value="{{ $status }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            @endisset

            @isset($roles)
                <div class="col">
                    <label for="role" class="col">Роль</label>
                    <select id="role" name="role" class="form-control">
                        <option value="" selected></option>
                        @foreach($roles as $role => $value)
                            <option value="{{ $role }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            @endisset

        </div>
    </form>

    @isset( $users )
        <table class="table table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col">Имя</th>
                <th scope="col">Email</th>
                <th scope="col">Статус</th>
                <th scope="col">Роль</th>
                <th scope="col" class="text-center">Действие</th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <a href="{{ route('admin.users.show', ['id' => $user->id]) }}">{{ $user->name }}</a>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->status }}</td>
                        <td>{{ $user->role }}</td>
                        <td align="center">
                            <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}">
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
            {{ $users->links() }}
        </div>

    @endisset
@endsection