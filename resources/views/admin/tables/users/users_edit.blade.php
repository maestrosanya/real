@extends('admin.layouts.admin_layout')



@section('button_form')

    @isset($user)
        <button type="submit" form="user_update" class="btn btn-success">Сохранить</button>

        <form action="{{ route('admin.users.destroy', ['id' => $user->id]) }}" method="POST" class="list-inline-item">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
        </form>
    @endisset

@endsection

@section('content')

    @isset($user)
        <form id="user_update" action="{{ route('admin.users.update', ['id' => $user->id]) }}" method="POST" novalidate>

            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label show-form_label">Имя</label>
                <div class="col-sm-10">
                    <input type="text" name="name"  class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" value="{{ old('name' ,$user->name) }}">
                    @if($errors->has('name'))
                        <span class="invalid-feedback" >
                            {{ $errors->first('name') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label show-form_label">Email</label>
                <div class="col-sm-10">
                    <input type="text"  name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}">
                    @if($errors->has('email'))
                        <span class="invalid-feedback" >
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label show-form_label">Статус</label>
                <div class="col-sm-10">
                    <select name="status" id="status" class="form-control">
                        @foreach($statuses as $value => $key)
                            <option value="{{ $value }}" {{ $user->status == $value ? 'selected' : '' }}>{{ $key }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="role" class="col-sm-2 col-form-label show-form_label">Роль</label>
                <div class="col-sm-10">
                    <select name="role" id="role" class="form-control">
                        @foreach($roles as $value => $key)
                            <option value="{{ $value }}" {{ $user->role == $value ? 'selected' : '' }}>{{ $key }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </form>
    @endisset
@endsection