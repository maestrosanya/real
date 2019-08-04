@extends('admin.layouts.admin_layout')



@section('button_form')

    @isset($region)
        <button type="submit" form="regions_update" class="btn btn-success">Сохранить</button>

        <form action="{{ route('admin.regions.destroy', ['id' => $region->id]) }}" method="POST" class="list-inline-item">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
        </form>
    @endisset

@endsection

@section('content')

    @isset($region)
        <form id="regions_update" action="{{ route('admin.regions.update', ['id' => $region->id]) }}" method="POST" novalidate>

            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label show-form_label">Имя</label>
                <div class="col-sm-10">
                    <input v-model="message"  type="text" name="name"  class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" value="{{ old('name' ,$region->name) }}">
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
                    <input type="text"  name="slug" class="form-control" id="slug" v-bind:value="slug">
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
                    @if($parent = $region->parent)
                        <span class="form-control">{{ $parent->name }}</span>
                        <input type="hidden"  name="parent_id" class="form-control" id="parent_id" value="{{ $parent->id }}">
                    @else
                        <span class="form-control">Родитель</span>
                        <input type="hidden"  name="parent_id" class="form-control" id="parent_id" value="0">
                    @endif
                </div>
            </div>

        </form>
    @endisset
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/transliteration@2.1.3/dist/browser/bundle.umd.min.js"></script>

    <script>

        /*
            Функция slugify() переводит текст из кириллицы в латиницу
            Плагин "transliteration" подключен через SDN 'https://cdn.jsdelivr.net/npm/transliteration@2.1.3/dist/browser/bundle.umd.min.js'
         */

        var region_update = new Vue({
            el: '#regions_update',
            data: {
                message: "{{ old('name' ,$region->name) }}",
                slug: "{{ old('slug', $region->slug) }}"
            },
            watch: {
                message: function (val) {
                    this.slug = slugify(val, { separator: '_' });
                }
            }
        });



    </script>
@endsection