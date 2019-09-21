<?php

namespace App\Http\Controllers;


use App\Models\Category\CategoryModel;
use App\Models\Regions\RegionModel;

class SiteController extends Controller
{

    public function renderView($view, $data = [])
    {
        return view( 'theme.first.' . $view, $data);
    }


}
