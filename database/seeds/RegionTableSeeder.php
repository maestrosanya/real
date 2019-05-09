<?php

use App\Models\Rerions\RegionModel;
use Illuminate\Database\Seeder;

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(RegionModel::class, 10)->create()->each(function (RegionModel $category) {
            $counts = [0, random_int(3, 7)];

            $category->children()->saveMany(factory(RegionModel::class, $counts[array_rand($counts)])->create()->each(function (RegionModel $category) {
                $counts = [0, random_int(3, 7)];
                $category->children()->saveMany(factory(RegionModel::class, $counts[array_rand($counts)])->create());
            }));

        });
    }
}
