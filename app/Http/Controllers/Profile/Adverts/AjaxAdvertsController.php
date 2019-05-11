<?php

namespace App\Http\Controllers\Profile\Adverts;


use App\Models\Rerions\RegionModel;

class AjaxAdvertsController
{
    public function ajaxGetAdverts()
    {

        $parent = request()->post('parent_id');

        $result = RegionModel::orderBy('name')->where('parent_id', '=', $parent)->get();

        return response()->json($result);
    }

}