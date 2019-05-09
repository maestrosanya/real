@extends('admin.layouts.admin_layout')



@section('button_form')

    @isset($category)
        <button type="submit" form="categories_attributes_create" class="btn btn-success">Сохранить</button>
    @endisset

@endsection

@section('content')

    @isset($category)
        <form id="categories_attributes_create" action="{{ route('admin.categories.attributes.store', $category) }}" method="POST" novalidate>

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

            @isset($attribute_types)
                <div class="form-group row">
                    <label for="type" class="col-sm-2 col-form-label show-form_label">Тип</label>
                    <div class="col-sm-10">
                        <select name="type" id="type" class="form-control">
                            @foreach($attribute_types as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endisset

            <div class="form-group row">
                <label for="sort" class="col-sm-2 col-form-label show-form_label">Сортировка</label>
                <div class="col-sm-10">
                    <input type="number" min="0"  name="sort" class="form-control" id="sort" value="{{ old('sort') ?? 0 }}" >
                    @if($errors->has('sort'))
                        <span class="invalid-feedback" >
                            {{ $errors->first('sort') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="required" class="col-sm-2 col-form-label show-form_label">Обязательно для заполнения</label>
                <div class="col-sm-10">
                    <select class="custom-select" name="required" id="required">
                        <option value="0" selected>Нет</option>
                        <option value="1">Да</option>
                    </select>
                    @if($errors->has('required'))
                        <span class="invalid-feedback" >
                            {{ $errors->first('required') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="variants_attr" class="col-sm-2 col-form-label show-form_label">Варианты</label>
                <div class="col-sm-10" id="variants_attr">

                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="btn_variants_attr">Добавить вариант</button>
                    </div>

                    @if($errors->has('variants_attr'))
                        <span class="invalid-feedback" >
                            {{ $errors->first('variants_attr') }}
                        </span>
                    @endif

                    @if(is_array(old('variants_attr')))
                        @foreach(old('variants_attr') as $variant_key => $variant)
                            <div class="form-group form-inline">
                                <input type="text" name="variants_attr[]" value="{{ $variant }}" class="form-control col-10 {{ $errors->first('variants_attr.'.$variant_key) ? 'is-invalid' : '' }}">
                                <button type="button" class="btn btn-danger btn_delete_input"><i class="fa fa-minus-circle"></i></button>

                                 @if($errors->has('variants_attr.'.$variant_key))
                                    <span class="invalid-feedback" >
                                        {{ $errors->first('variants_attr.'.$variant_key) }}
                                    </span>
                                 @endif
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>


        </form>
    @endisset
@endsection