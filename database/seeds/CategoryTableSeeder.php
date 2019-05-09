<?php

use App\Models\Category\CategoryModel;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CategoryModel::class, 10)->create()->each(function (CategoryModel $category) {
            $counts = [0, random_int(3, 7)];

            $category->children()->saveMany(factory(CategoryModel::class, $counts[array_rand($counts)])->create()->each(function (CategoryModel $category) {
                $counts = [0, random_int(3, 7)];
                $category->children()->saveMany(factory(CategoryModel::class, $counts[array_rand($counts)])->create());
            }));

        });
    }
}
