<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');

// User Profile
Route::group(['prefix' => 'profile', 'middleware' => ['web', 'verified'], 'as' => 'profile.' ], function () {

    // Profile
    Route::get('/', 'Profile\ProfileController@index')->name('show');

    // Profile -> Adverts
    Route::resource('/adverts', 'Profile\Adverts\AdvertsController');

    // Profile -> Adverts -> Create
    Route::group(['prefix' => '/adverts/create', 'as' => 'adverts.create.'], function (){

        // Profile -> Adverts -> Create -> Category -> {category_id}
        Route::get('/category/{category_id}', 'Profile\Adverts\AdvertsController@showCategory')->name('category');
        // Profile -> Adverts -> Create -> Category -> {category_id} -> region -> {region_id}
        Route::get('/category/{category_id}/region/{region_id}', 'Profile\Adverts\AdvertsController@showRegion')->name('region');

    });

    // Ajax get Adverts
    Route::post('/adverts/ajax', 'Profile\Adverts\AjaxAdvertsController@ajaxGetAdverts')->name('adverts.ajax');

});


Route::group(['prefix' => 'admin', 'middleware' => ['web', 'verified', 'can:admin-panel'], 'namespace' => 'Admin', 'as' => 'admin.'], function () {

    Route::get('/', 'DashboardController@index')->name('dashboard');

    // Users
    Route::resource('/users', 'User\UserController');
    // Regions
    Route::resource('/regions', 'Regions\RegionsController');
    // Categories
    Route::resource('/categories', 'Category\CategoriesController');

    //Categories -> Attribute
    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {

        Route::resource('/{category}/attributes', 'AttributeForCategory\AttributeForCategoryController');

    });

});


