<template>
    <div class="container">
        <form action="" method="post">
            <div class="form-row">
                <div class="form-group col-3">
                    <select v-on:change="searchForCategory" v-model="selectCategory" name="category" class="custom-select">
                        <option value="">Любая категория</option>
                    <!--<option value="{{ categoryid }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>-->
                        <option v-for="category in categories" v-bind:value="category.id">
                            {{ category.name }}
                        </option>
                    </select>
                </div>
                <div class="form-group col-4">
                    <input type="text" name="search_string" class="form-control" placeholder="Поиск по объявлениям">
                </div>
                <div class="form-group col-3">
                    <select v-on:change="searchForRegion" v-model="selectRegion" name="region" class="custom-select">
                        <option value="0">Любой регион</option>
                    <!--<option value="{{ $region->id }}"  {{ old('region') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>-->
                        <option v-for="region in regions" v-bind:value="region.slug">
                            {{ region.name }}
                        </option>
                    </select>
                </div>

                <div class="form-group col-2">
                    <button type="submit" class="btn">Найти</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: {
            categories: Array,
            regions: Array,
        },
        data: function(){
            return {
                selectCategory: '',
                selectRegion: "volgograd",
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            searchForCategory: function (event) {
                console.log(event, 'Category->id = ' + this.selectCategory);

                location.replace('/adverts/' + this.selectRegion +'/'+ this.selectCategory)
            },
            searchForRegion: function (event) {
                console.log(event, 'Region->id = ' + this.selectRegion);

                location.replace('/adverts/' + this.selectRegion +'/'+ this.selectCategory)
            }
        }
    }
</script>
