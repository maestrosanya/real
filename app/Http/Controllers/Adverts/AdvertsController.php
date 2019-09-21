<?php

namespace App\Http\Controllers\Adverts;

use App\Http\Controllers\SiteController;
use App\Http\Traits\ResponseDataTrait;
use App\Models\Category\CategoryModel;
use App\Models\Regions\RegionModel;
use App\Services\Adverts\Search\AdvertsSearch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdvertsController extends SiteController
{
    use ResponseDataTrait;

    protected $advertSearch;

    public function __construct(AdvertsSearch $advertSearch)
    {
        $this->advertSearch = $advertSearch;
    }

    public function requestDataHandler(Request $request)
    {
        $data = [];

        $request->category ? $data['category'] = CategoryModel::findOrFail($request->category) : [];

        $request->region ? $data['region'] = RegionModel::findOrFail($request->region) : [];

       // dd($data);


        return redirect()->route('adverts_handler', $data);
    }

    public function index(Request $request, $regionSlug, CategoryModel $category)
    {

        //dd($regionSlug);

        $region = RegionModel::where('slug', $regionSlug)->firstOrFail();



        dump($region, $category);

        $result = $this->advertSearch->search($category, $region->id, $request);

        dump($result);

        $request->flashOnly(['category', 'region', 'search_string']);


        return $this->renderView('adverts.adverts', [
            'categories' => $this->getCategories(),
            'regions' => $this->getRegions()
        ]);
    }
}
