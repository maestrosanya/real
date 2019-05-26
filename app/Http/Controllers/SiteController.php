<?php

namespace App\Http\Controllers;


class SiteController extends Controller
{
    public function renderView($view)
    {
        return view( 'theme.first.' . $view);
    }
}