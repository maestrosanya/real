@extends('admin.layouts.admin_layout')



@section('button_form')

    @isset($attribute , $category)
        <button type="submit" form="categories_attributes_update" class="btn btn-success">Сохранить</button>

        <form action="{{ route('admin.categories.attributes.destroy', [$category, $attribute]) }}" method="POST" class="list-inline-item">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
        </form>
    @endisset

@endsection

@section('content')

    @isset($attribute, $category)
        <form id="categories_attributes_update" action="{{ route('admin.categories.attributes.update', [$category, $attribute]) }}" method="POST" novalidate>

            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label show-form_label">Имя</label>
                <div class="col-sm-10">
                    <input type="text" name="name"  class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" value="{{ old('name', $attribute->name) }}">
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
                            <option value="{{ $attribute->type }}">{{ $attribute->type }}</option>
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
                    <input type="number" min="0"  name="sort" class="form-control" id="sort" value="{{ old('sort', $attribute->sort) }}" >
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
                        <option value="{{ $attribute->required }}" selected>{{ $attribute->required ? 'Да' : 'Нет'}}</option>
                        <option value="0">Нет</option>
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

                                <input type="text" name="variants_attr[]" value="{{ $variant }}" class="form-control col-10 {{ $errors->get('variants_attr.'.$variant_key.'') ? 'is-invalid' : '' }}">
                                <button type="button" class="btn btn-danger btn_delete_input"><i class="fa fa-minus-circle"></i></button>

                                @if($errors->has('variants_attr.'.$variant_key))
                                    <span class="invalid-feedback" >
                                        {{ $errors->first('variants_attr.'.$variant_key) }}
                                    </span>
                                @endif
                            </div>
                        @endforeach

                    @else
                        @if(!empty(json_decode($attribute->variants)))
                            @foreach(json_decode($attribute->variants) as $variant_key => $variant)
                                <div class="form-group form-inline">

                                    <input type="text" name="variants_attr[]" value="{{ old('variants_attr.'.$variant_key.'', $variant) }}" class="form-control col-10 {{ $errors->get('variants_attr.'.$variant_key.'') ? 'is-invalid' : '' }}">
                                    <button type="button" class="btn btn-danger btn_delete_input"><i class="fa fa-minus-circle"></i></button>

                                    @if($errors->has('variants_attr.'.$variant_key))
                                        <span class="invalid-feedback" >
                                            {{ $errors->first('variants_attr.'.$variant_key) }}
                                        </span>
                                    @endif

                                </div>
                            @endforeach
                        @endif
                    @endif

                </div>
            </div>

        </form>
    @endisset
@endsection