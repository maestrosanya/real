@extends('theme.first.layouts.app')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Личный кабинет</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile.adverts.create') }}">Создать объявление</a></li>
            <li class="breadcrumb-item active" aria-current="page">Выбор атрибутов</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1>Создать объявление</h1>
                <br />
                <div class="form-group">
                    <h4>Категория:</h4>
                    <p>{{ $category->name }}</p>
                </div>
                <hr />

                <form id="createAdvertForm" v-on:submit.prevent="send" action="{{ route('profile.adverts.create.store', ['category' => $category] ) }}" method="POST">

                    @csrf
                    @method('POST')

                    <h3>Параметры</h3>

                    <div class="form-group row">
                        <label for="title" class="col-sm-4 col-form-label">Название объявления</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="col-sm-8 form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">
                        @if($errors->has('title'))
                            <div class="invalid-feedback offset-sm-4">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="content" class="col-sm-4 col-form-label">Описание</label>
                        <textarea name="content" id="content" class="col-sm-8 form-control {{ $errors->has('content') ? 'is-invalid' : '' }}">{{ old('content') }}</textarea>
                        @if($errors->has('content'))
                            <div class="invalid-feedback offset-sm-4">
                                {{ $errors->first('content') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="price" class="col-sm-4 col-form-label">Цена</label>
                        <input type="text" inputmode="numeric" name="price" id="price" value="{{ old('price') }}" class="col-sm-8 form-control {{ $errors->has('price') ? 'is-invalid' : '' }}">
                        @if($errors->has('price'))
                            <div class="invalid-feedback offset-sm-4">
                                {{ $errors->first('price') }}
                            </div>
                        @endif
                    </div>

                    @if($category->allAttributes())
                            @foreach($category->allAttributes() as $attribute)

                                @if($attribute->isString())
                                    <div class="form-group row">
                                        <label for="{{ $attribute->id }}" class="col-sm-4 col-form-label">{{ $attribute->name }}</label>
                                        <input type="text" name="attribute[{{ $attribute->id }}]" id="{{ $attribute->id }}" value="{{ old('attribute.' . $attribute->id) }}" class="col-sm-8 form-control {{ $errors->has('attribute.' . $attribute->id) ? 'is-invalid' : '' }}">
                                        @if($errors->has('attribute.' . $attribute->id))
                                            <div class="invalid-feedback offset-sm-4">
                                                {{ $errors->first('attribute.' . $attribute->id) }}
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                @if($attribute->isSelect())
                                    <div class="form-group row">
                                        <label for="{{ $attribute->id }}" class="col-sm-4 col-form-label">{{ $attribute->name }}</label>
                                        <select name="attribute[{{ $attribute->id }}]" id="{{ $attribute->id }}"  class="col-sm-8 form-control {{ $errors->has('attribute.' . $attribute->id ) ? 'is-invalid' : ''}}">
                                            <option value="">-------</option>
                                            @if(!empty($attribute->variants))
                                                @foreach(json_decode($attribute->variants) as $variant)
                                                    <option value="{{ $variant }}" {{ old('attribute.' . $attribute->id) == $variant ? 'selected' : '' }}>{{ $variant }}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        @if($errors->has('attribute.' . $attribute->id ))
                                            <div class="invalid-feedback offset-sm-4">
                                                {{ $errors->first('attribute.' . $attribute->id ) }}
                                            </div>
                                        @endif

                                    </div>
                                @endif

                                @if($attribute->isInteger())
                                    <div class="form-group row">
                                        <label for="{{ $attribute->id }}" class="col-sm-4 col-form-label">{{ $attribute->name }}</label>
                                        <input type="number" min="0" name="attribute[{{ $attribute->id }}]" id="{{ $attribute->id }}" value="{{ old('attribute.' . $attribute->id) }}" class="col-sm-8 form-control {{ $errors->has('attribute.' . $attribute->id ) ? 'is-invalid' : ''}}">
                                        @if($errors->has('attribute.' . $attribute->id ))
                                            <div class="invalid-feedback offset-sm-4">
                                                {{ $errors->first('attribute.' . $attribute->id ) }}
                                            </div>
                                        @endif
                                    </div>
                                @endif

                            @endforeach
                    @endif

                    <h3>Контактная информация</h3>

                    <div id="region_container">
                        <div class="form-group row">
                            <label for="region" class="col-sm-4 col-form-label">Регион</label>
                            <div id="region_autocomplite" class="col-sm-8 region-autocomplite">
                                <input autocomplete="off" v-model="region_name" type="text"  name="region" id="region" value="{{ old('region') }}" class="form-control {{ $errors->has('region') ? 'is-invalid' : '' }}" placeholder="Введите название региона">

                                <ul class="list-group region-autocomplite__list" style="position: absolute">
                                    <li v-for="regionVariant in regionVariants" v-on:click="selectInputRegion" v-bind:region_id="regionVariant.id" class="list-group-item itemRegion">
                                        @{{ regionVariant.name }}
                                    </li>
                                </ul>

                            </div>


                            {{-- Town --}}

                            <template v-if="show_select_city">
                                <label for="city" class="col-sm-4 col-form-label">Город</label>
                                <select v-model="city_name" @change="changeCity" type="text"  name="city" id="city" value="{{ old('city') }}" class="col-sm-8 form-control {{ $errors->has('city') ? 'is-invalid' : '' }}">
                                    <option value="">----</option>
                                    <option v-for="cityVariant in cityVariants"  class="list-group-item itemCity">
                                        @{{ cityVariant.name }}
                                    </option>
                                </select>
                            </template>
                        </div>


                        <div v-if="addressShow" id="address_container" class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Адрес</label>
                            <input v-on:keyup.enter="input_getAddress"  type="text" name="address" id="region_value" class="form-control col-sm-8" value="">
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="phone" class="col-sm-4 col-form-label">Телефон</label>
                        <input type="text"  inputmode="tel" name="phone" id="phone" value="{{ old('phone') }}" class="col-sm-8 form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" placeholder="8 ___ ___-__-__">
                        @if($errors->has('phone'))
                            <div class="invalid-feedback offset-sm-4">
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                    </div>

                    <button type="submit">Создать объявление</button>

                </form>

            </div>
        </div>
    </div>
@endsection


@section('script')

    <script type="text/javascript">

        var nameRegionGlobal = '';

        $('#createAdvertForm').submit(function (e) {
            e.preventDefault();
        });

        var region = new Vue({
            el: '#region_container',
            data: {
                region_name: '',
                region_id: '',
                regionVariants: [],
                city_name: '',
                city_id: '',
                cityVariants: [],

                addressShow: false,

                show_select_city: false,
                selectedRegion: false
            },
            watch: {
                region_name: function (val) {

                    if (this.selectedRegion) {
                        this.selectedRegion = false;
                        return
                    }

                    if (val.length >= 2) {
                        axios.post('/profile/adverts/create/advert/region/', {
                            region_name: val
                        })
                            .then((response) => {
                                console.log(response.data);
                                this.regionVariants = response.data; // Сохраняем ответ с Регионами

                                this.show_select_city = false; // При измменении Региона скрываем поле выбора города

                                this.addressShow = false;

                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    } else {
                        this.regionVariants = [];
                    }
                },
                city_name: function (val) {
                    val ? this.addressShow = true : this.addressShow = false; // Если поле выбора горада окажется пустым, тогда скрываем поле ввода адреса
                }
            },
            methods: {
                selectInputRegion: function (event) {

                    region.regionVariants = [];
                    region.region_name = event.toElement.innerText;
                    region.region_id = event.toElement.attributes.region_id.value;

                    this.selectedRegion = true;
                    this.show_select_city = true;

                    console.log(this.show_select_city);


                    axios.post('/profile/adverts/create/advert/city/', {
                        region_id: region.region_id
                    })
                        .then(function (response) {
                            console.log(response.data);

                            region.cityVariants = response.data;

                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                changeCity: function () {

                    this.addressShow = true;

                }

            }
        });

        /*var mapContainer = $('#map');

        var addressMap = new Vue({
            el: '#address_container',
            data: {
                address: '',
                fullAddress: '',
                mapContainer: ''
            },
            methods: {
                getAddress: function (event) {


                    console.log(region.city_name);

                    if (region.city_name) {
                        this.fullAddress = region.region_name + ', ' + this.address;

                        console.log(this.fullAddress);
                        viewMapRegion(this.fullAddress);
                    }
                    return '';


                },
                input_getAddress: function (event) {

                    if (region.city_name) {
                        this.fullAddress = region.region_name + ', ' + region.city_name + ', ' + this.address;

                        console.log(this.fullAddress);
                        viewMapRegion(this.fullAddress);
                    }
                    return '';

                },
            }
        });*/


       /* var createAdvertForm = new Vue({
            el: '#city_container',
            methods: {
                send: function (event) {
                    console.log(addressMap.address);
                    //viewMapRegion(addressMap.address);
                }
            }

        });*/



    </script>


@endsection
