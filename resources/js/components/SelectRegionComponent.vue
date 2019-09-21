<template>
    <div id="region_container">
        <div class="form-group row">
            <label for="region" class="col-sm-4 col-form-label">Регион</label>
            <div id="region_autocomplite" class="col-sm-8 region-autocomplite">
                <input autocomplete="off" v-model="region_name" type="text"  name="region" id="region" value="" v-bind:class="{'is-invalid': errors.region}" class="form-control" placeholder="Введите название региона">

                <ul class="list-group region-autocomplite__list" style="position: absolute">
                    <li v-for="regionVariant in regionVariants" v-on:click="selectInputRegion" v-bind:region_id="regionVariant.id" class="list-group-item itemRegion">
                        {{ regionVariant.name}}
                    </li>
                </ul>

            </div>

            <template v-if="show_select_city">
                <label for="city" class="col-sm-4 col-form-label">Город</label>
                <select v-model="city_name" @change="changeCity" type="text"  name="city_id" id="city" class="col-sm-8 form-control">
                    <option value="">----</option>
                    <option v-for="cityVariant in cityVariants" v-bind:value="cityVariant.id" class="list-group-item itemCity">
                        {{ cityVariant.name}}
                    </option>
                </select>
            </template>
        </div>


        <div v-if="addressShow" id="address_container" class="form-group row">
            <label for="address" class="col-sm-4 col-form-label">Адрес</label>
            <input  type="text" name="address" id="address" class="form-control col-sm-8" value="">
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'errors',
        ],
        data: function(){
            return {
                error:  this.errors,
                send: "",

                region_name: '',
                region_id: '',
                regionVariants: [],
                city_name: '',
                city_id: '',
                cityVariants: [],

                addressShow: false,

                show_select_city: false,
                selectedRegion: false
            }


        },
        mounted() {
            console.log('Component mounted.');

        },
        watch: {
            region_name: function (val) {

                if (this.selectedRegion) {
                    this.selectedRegion = false;
                    return
                }

                if (val.length >= 3) {
                    axios.post('/profile/adverts/create/advert/region/', {
                        region_name: val
                    })
                        .then((response) => {
                            console.log(val);

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
            selectInputRegion: function (event)  {

                this.regionVariants = [];
                this.region_name = event.toElement.innerText;
                this.region_id = event.toElement.attributes.region_id.value;

                this.selectedRegion = true;
                this.show_select_city = true;

                console.log(this.cityVariants);


                axios.post('/profile/adverts/create/advert/city/', {
                    region_id: this.region_id
                })
                    .then(response => {
                        console.log(response.data);

                        this.cityVariants = response.data;

                        console.log(this.cityVariants);

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            changeCity: function () {

                this.addressShow = true;

            }

        }
    }
</script>
