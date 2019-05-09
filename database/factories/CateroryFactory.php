<?php

use App\Models\Category\CategoryModel;
use Faker\Generator as Faker;

$factory->define(CategoryModel::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'slug' => $faker->unique()->slug(2),
        'parent_id' => null,
    ];
});
