@extends('admin.layouts.admin_layout')



@section('button_form')

    <button type="submit" form="user_create" class="btn btn-success">Сохранить</button>

@endsection

@section('content')

        <form id="user_create" action="{{ route('admin.users.store') }}" method="POST">

            @csrf
            @method('POST')

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label show-form_label">Имя</label>
                <div class="col-sm-10">
                    <input type="text" name="name"  class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" value="{{ old('name') }}">
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
                    <input type="email"  name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" value="{{ old('email') }}">
                    @if($errors->has('email'))
                        <span class="invalid-feedback" >
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label show-form_label">Пароль</label>
                <div class="col-sm-10">
                    <input type="password"  name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" value="">
                    @if($errors->has('password'))
                        <span class="invalid-feedback" >
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password_confirmation" class="col-sm-2 col-form-label show-form_label">Подтвердите пароль</label>
                <div class="col-sm-10">
                    <input type="password"  name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" id="password_confirmation" value="">
                    @if($errors->has('password_confirmation'))
                        <span class="invalid-feedback" >
                            {{ $errors->first('password_confirmation') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label show-form_label">Статус</label>
                <div class="col-sm-10">
                    <select name="status" id="status" class="form-control">
                        @foreach($statuses as $value => $key)
                            <option value="{{ $value }}" {{ old('status') == $value ? 'selected' : '' }}>{{ $key }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="role" class="col-sm-2 col-form-label show-form_label">Статус</label>
                <div class="col-sm-10">
                    <select name="role" id="role" class="form-control">
                        @foreach($roles as $value => $key)
                            <option value="{{ $value }}" {{ old('role') == $value ? 'selected' : '' }}>{{ $key }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </form>
@endsection