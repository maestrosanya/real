<div class="container">
    <form action="{{ route('adverts') }}" method="post">
        @csrf
        @method('post')
        <div class="form-row">
            <div class="form-group col-3">
                <select name="category" class="custom-select">
                    <option value="">Любая категория</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-4">
                <input type="text" name="search_string" class="form-control" placeholder="Поиск по объявлениям">
            </div>
            <div class="form-group col-3">
                <select name="region" class="custom-select">
                    <option value="">Любой регион</option>
                    @foreach($regions as $region)
                        <option value="{{ $region->slug }}"  {{ old('region') == $region->slug ? 'selected' : '' }}>{{ $region->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-2">
                <button type="submit" class="btn">Найти</button>
            </div>
        </div>
    </form>
</div>
