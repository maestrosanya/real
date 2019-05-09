<?php

use App\Models\Rerions\RegionModel;
use Faker\Generator as Faker;

$factory->define(RegionModel::class, function (Faker $faker) {

    return [
        'name' => $faker->unique()->name,
        'slug' => $faker->unique()->slug(),
        'parent_id' => null,
    ];

});
