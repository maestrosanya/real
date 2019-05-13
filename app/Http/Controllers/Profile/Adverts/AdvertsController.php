<?php

namespace App\Http\Controllers\Profile\Adverts;

use App\Models\Category\CategoryModel;
use App\Models\Rerions\RegionModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdvertsController extends Controller
{

    public function showCategory($id)
    {
        $category = CategoryModel::findOrFail($id);
        echo $category->name;
    }


    public function index()
    {
        return view('theme.first.profile.adverts.profile-adverts');
    }


    public function create()
    {
        $categories = CategoryModel::where('parent_id', null)->orderBy('name')->get();

        $data = [
            'categories' => $categories
        ];

        return view('theme.first.profile.adverts.profile-adverts-create')->with($data);
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Продаю корову';
        return view('theme.first.profile.adverts.profile-adverts-show', ['title' => $title]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('theme.first.profile.adverts.profile-adverts-update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
