@extends('admin.layouts.admin_layout')



@section('button_form')

    <button type="submit" form="regions_create" class="btn btn-success">Сохранить</button>

@endsection

@section('content')

        <form id="regions_create" action="{{ route('admin.regions.store') }}" method="POST">

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
                <label for="slug" class="col-sm-2 col-form-label show-form_label">Slug</label>
                <div class="col-sm-10">
                    <input type="text"  name="slug" class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" id="slug" value="{{ old('slug') }}">
                    @if($errors->has('slug'))
                        <span class="invalid-feedback" >
                            {{ $errors->first('slug') }}
                        </span>
                    @endif
                </div>
            </div>


                <div class="form-group row">
                    <label for="parent_id" class="col-sm-2 col-form-label show-form_label">Родительский регион</label>
                    <div class="col-sm-10">
                        @if($parent)
                            <span class="form-control">{{ $parent->name }}</span>
                            <input type="hidden"  name="parent_id" class="form-control" id="parent_id" value="{{ $parent->id }}">
                        @else
                            <span class="form-control">Родитель</span>
                            <input type="hidden"  name="parent_id" class="form-control" id="parent_id" value="0">
                        @endif
                    </div>
                </div>


        </form>
@endsection