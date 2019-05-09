<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\SiteController;

class ProfileController extends SiteController
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return $this->renderView('profile.home');
    }
}