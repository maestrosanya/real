@extends('admin.layouts.admin_layout')



@section('button_form')
    @isset($user)
        <a  href="{{ route('admin.users.edit', ['id' => $user->id]) }}" >
            <button type="submit" class="btn btn-dark">Редактировать</button>
        </a>

        <form action="{{ route('admin.users.destroy', ['id' => $user->id]) }}" method="POST" class="list-inline-item">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
        </form>
    @endisset
@endsection

@section('content')

    @isset($user)
        <ul class="form-show">
            <li class="form-group row">
                <span class="col-sm-2 ">Имя</span>
                <div class="col-sm-10">
                    <span>{{ $user->name }}</span>
                </div>
            </li>

            <li class="form-group row">
                <span class="col-sm-2 ">Email</span>
                <div class="col-sm-10">
                    <span>{{ $user->email }}</span>
                </div>
            </li>

            <li class="form-group row">
                <span class="col-sm-2 ">Статус</span>
                <div class="col-sm-10">
                    <span>{{ $user->status }}</span>
                </div>
            </li>

            <li class="form-group row">
                <span class="col-sm-2 ">Роль</span>
                <div class="col-sm-10">
                    <span>{{ $user->role }}</span>
                </div>
            </li>
        </ul>
    @endisset
@endsection