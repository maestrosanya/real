@extends('theme.first.layouts.app')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Личный кабинет</a></li>
            <li class="breadcrumb-item active" aria-current="page">Создать Объявление</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1>Создать Объявление</h1>
                <br>
                <a href="{{ route('profile.adverts.create') }}">Создать объявление</a>

                <hr>
                <button class="ajaxAdverts">Получить категории</button>

                <hr>
                <form action="{{ route('profile.adverts.store') }}" method="post">

                    <div class="region_array form-group" style="overflow: auto; height: 400px">
                        <ul class="list-group region_array_list">
                            @foreach($categories as $category )
                                <li class="list-group-item">
                                    <input type="radio" value="{{ $category->id }}" name="region" class="regionAjax" data-parent="{{ $category->parent_id }}" data-title="{{ $category->name }}">
                                    <label for="{{  $category->id }}->id }}">{{ $category->name }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="region_array_btn_box form-group" >

                        <button class="region_array_btn_back">Назад к регионам</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection




@section('script')
    <script type="text/javascript">

        var ajaxRegionRequest = function (parent_id) {

            $.ajax({

                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                method: "POST",
                url: "{{ route('profile.adverts.ajax') }}",
                dataType: 'json',
                data: {parent_id: parent_id},
                success: function (response) {
                    console.log('Success');


                    var html = '<li class="list-group-item">';

                    $.each(response, function (i, region) {
                        console.log(response);

                        if (response.length != 0) {
                            html +=  '<li class="list-group-item">' +
                                '<input type="radio" value="' +region['id']+ '" name="region" class="regionAjax" data-parent="' +region['parent_id']+ '" data-title="' +region['name']+ '">' +
                                '<label for="' +region['id']+ '">' +region['name']+ '</label>' +
                                '</li>';
                        }

                    });

                    if (response.length != 0){
                        $('.region_array_list').html(html);
                    }

                }

            });
        };

        ////////////////////////////////////////////////////

        var ajaxRegion = function () {

            var currentName = [];
            var parent_id;
            var btn_back_parent_id;

            $(document).on('change', 'input[type="radio"][name="region"]:checked', function (event) {

                currentName += $(this).attr('data-title');
                parent_id = $(this).val();
                btn_back_parent_id = $(this).attr('data-parent');

                console.log("Текущее имя" + currentName);
                console.log("Парент ид для кнопки" + btn_back_parent_id);

                ajaxRegionRequest(parent_id);



            });

        };
        ajaxRegion();


        $('.region_array_btn_back').click(function (event) {

            event.preventDefault();

            ajaxRegionRequest(null)

        });



    </script>
@endsection