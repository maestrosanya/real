<?php

use App\Models\Attribute\AttributeForCategoryModel;
use App\Models\Category\CategoryModel;
use App\Models\Regions\CityModel;
use App\Models\Regions\RegionModel;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


// Главная
Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('Главная', route('admin.dashboard'));
});

/*
 * Пользователи
 */

// Главная / Пользователи
Breadcrumbs::for('admin.users.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Пользователи', route('admin.users.index'));
});
// Главная / Пользователи / Редактировать
Breadcrumbs::for('admin.users.edit', function ($trail, $id) {
    $trail->parent('admin.users.index');
    $trail->push('Редактировать');
});
// Главная / Пользователи / Просмотр пользователя
Breadcrumbs::for('admin.users.show', function ($trail, $id) {
    $trail->parent('admin.users.index');
    $trail->push('Просмотр пользователя');
});
// Главная / Пользователи / Редактировать
Breadcrumbs::for('admin.users.create', function ($trail) {
    $trail->parent('admin.users.index');
    $trail->push('Создать пользователя');
});

/*
 * Регионы
 */

// Главная / Регионы
Breadcrumbs::for('admin.regions.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Регионы', route('admin.regions.index'));
});
// Главная / Регионы / Просмот дочерних регионов (Городов)
Breadcrumbs::for('admin.regions.show', function ($trail, $region) {

    if ($parent = $region->parent) {
        $trail->parent('admin.regions.show', $parent);
    } else {
        $trail->parent('admin.regions.index');
    }

    $trail->push($region->name, route('admin.regions.show', $region));
});
// Главная / Регионы / Добавить регион
Breadcrumbs::for('admin.regions.create', function ($trail) {
    $trail->parent('admin.regions.index');
    $trail->push('Добавить регион');
});
// Главная / Регионы / Добавить регион
Breadcrumbs::for('admin.regions.edit', function ($trail, RegionModel $region) {
    $trail->parent('admin.regions.index');
    $trail->push('Редактировать регион - ' . $region->name);
});

//////// Города

// Главная / Города
Breadcrumbs::for('admin.cities.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Города', route('admin.cities.index'));
});
// Главная / Города / Конкретный город
Breadcrumbs::for('admin.cities.show', function ($trail, CityModel $city) {

    if ($parent_region = $city->region) {
        $trail->parent('admin.regions.show', $parent_region);
       // $trail->push($parent_region->name, route('admin.regions.show', $parent_region));
    } else {
        $trail->parent('admin.cities.index');
    }

    $trail->push($city->name, route('admin.regions.show', $city));
});
// Главная / Города / Добавить город
Breadcrumbs::for('admin.cities.create', function ($trail) {
    $trail->parent('admin.cities.index');
    $trail->push('Добавить город');
});
// Главная / Города / Редактировать город
Breadcrumbs::for('admin.cities.edit', function ($trail, CityModel $city) {
    $trail->parent('admin.cities.index');
    $trail->push('Редактировать регион - ' . $city->name);
});


/*
 * Категории
 */

// Главная / Категории
Breadcrumbs::for('admin.categories.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Категории', route('admin.categories.index'));
});
// Главная / Категории / $category->name / Редактировать
Breadcrumbs::for('admin.categories.edit', function ($trail, CategoryModel $category) {
    $trail->parent('admin.dashboard');
    $trail->push('Категории', route('admin.categories.index'));
    $trail->push($category->name, route('admin.categories.show', $category));
    $trail->push('Редактировать');
});
// Главная / Категории / Просмот дочерних категорий
Breadcrumbs::for('admin.categories.show', function ($trail, CategoryModel $category) {

    if ($parent = $category->parent) {
        $trail->parent('admin.categories.show', $parent);
    } else {
        $trail->parent('admin.categories.index');
    }

    $trail->push($category->name, route('admin.categories.show', $category));
});
// Главная / Категории / Добавить категорию
Breadcrumbs::for('admin.categories.create', function ($trail) {
    $trail->parent('admin.categories.index');
    $trail->push('Добавить категорию');
});

/*
 * Атрибуты категории
 */

// Главная / Категории / $category->name / $attribute->name
Breadcrumbs::for('admin.categories.attributes.show', function ($trail, CategoryModel $category, AttributeForCategoryModel $attribute) {
    $trail->parent('admin.dashboard');
    $trail->push('Категории', route('admin.categories.index'));
    $trail->push($category->name, route('admin.categories.show', $category));
    $trail->push('Атрибут');
    $trail->push($attribute->name);
});
// Главная / Категории / $category->name / Атрибут - $attribute->name / Редактировать
Breadcrumbs::for('admin.categories.attributes.edit', function ($trail, CategoryModel $category, AttributeForCategoryModel $attribute) {
    $trail->parent('admin.dashboard');
    $trail->push('Категории', route('admin.categories.index'));
    $trail->push($category->name, route('admin.categories.show', $category));
    $trail->push('Атрибут - ' . $attribute->name, route('admin.categories.attributes.show', [$category, $attribute]));
    $trail->push('Редактировать');
});
// Главная / Категории / $category->name / Атрибуты / Добавить атрибут
Breadcrumbs::for('admin.categories.attributes.create', function ($trail, CategoryModel $category) {
    $trail->parent('admin.dashboard');
    $trail->push('Категории', route('admin.categories.index'));
    $trail->push($category->name, route('admin.categories.show', $category));
    $trail->push('Атрибуты');
    $trail->push('Добавить атрибут');
});
