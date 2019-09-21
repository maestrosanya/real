<?php


namespace App\Http\Traits;


use App\Models\Category\CategoryModel;
use App\Models\Regions\RegionModel;

trait ResponseDataTrait
{

    public function getCategories()
    {
        return CategoryModel::get();
    }

    public function getRegions()
    {
        return RegionModel::get();
    }
}
