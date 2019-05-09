@extends('admin.layouts.admin_layout')



@section('button_form')

    @isset($category)
        <button type="submit" form="categories_update" class="btn btn-success">Сохранить</button>

        <form action="{{ route('admin.categories.destroy', ['id' => $category->id]) }}" method="POST" class="list-inline-item">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
        </form>
    @endisset

@endsection

@section('content')

    @isset($category)
        <form id="categories_update" action="{{ route('admin.categories.update', ['id' => $category->id]) }}" method="POST" novalidate>

            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label show-form_label">Имя</label>
                <div class="col-sm-10">
                    <input type="text" name="name"  class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" value="{{ old('name' ,$category->name) }}">
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
                    <input type="text"  name="slug" class="form-control" id="slug" value="{{ old('slug', $category->slug) }}">
                    @if($errors->has('slug'))
                        <span class="invalid-feedback" >
                            {{ $errors->first('slug') }}
                        </span>
                    @endif
                </div>
            </div>

            @isset($parents)
                <div class="form-group row">
                    <label for="parent" class="col-sm-2 col-form-label show-form_label">Родительская категория</label>
                    <div class="col-sm-10">
                        <select name="parent" id="parent" class="form-control">
                            <option selected value="{{ $category->parent->id ?? 0 }}">{{ $category->parent->name ?? 'Родительская категория' }}</option>
                            @foreach($parents as $parent)
                                <option value="{{ $parent->id }}">
                                    @for($i=0; $i < $parent->depth; $i++) &mdash; @endfor
                                    {{ $parent->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endisset

        </form>
    @endisset
@endsection