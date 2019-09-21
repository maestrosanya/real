<?php

namespace App\Http\Controllers\Adverts;


use App\Models\Category\CategoryModel;

class AjaxAdvertsController
{
    public function ajaxGetAdverts()
    {

        $parent = request()->post('parent_id');

        $result = CategoryModel::orderBy('name')->where('parent_id', '=', $parent)->get();

        return response()->json($result);
    }

}
