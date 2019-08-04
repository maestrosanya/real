<?php

namespace App\Http\Controllers\Profile\Adverts;

use App\Exceptions\AdvertExeption;
use App\Http\Requests\AdvertFormRequest;
use App\Models\Advert\Advert;
use App\Models\Category\CategoryModel;
use App\Models\Rerions\RegionModel;
use App\useCases\Advert\AdvertService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdvertsController extends Controller
{

    public function ajaxRegion()
    {
        $regionName = request()->post('region_name');

        $regionsList = RegionModel::orderBy('name')->where('name', 'LIKE', "{$regionName}%")->where('parent_id', null)->limit(10)->get();

        return response()->json($regionsList);
    }

    public function ajaxCity()
    {
        $region_id = request()->post('region_id');

        $сitiesList = RegionModel::orderBy('name')->where('parent_id', '=',  $region_id)->get();

        return response()->json($сitiesList);
    }

    public function showCategory($id)
    {
        $category = CategoryModel::findOrFail($id);

        dump($category->allAttributes());

        return view('theme.first.profile.adverts.attributes.profile-adverts-create-attributes', [
            'category' => $category
        ]);
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


    public function store(AdvertFormRequest $advertFormRequest, CategoryModel $category)
    {
        try{

            $advert = new Advert(new AdvertService());

            $user_id = Auth::id();

            $result = $advert->advertService->create($advertFormRequest, $user_id, $category);

            dump($advertFormRequest->all());

        } catch (AdvertExeption $e){
            return back()->with('error', $e->getMessage());
        }
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
