<?php

namespace App\Http\Controllers\Admin\Regions;

use App\Models\Regions\CityModel;
use App\Models\Regions\RegionModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $parent = null;

        if (!empty($parent_id = $request->get('parent_id'))) {
            $parent = RegionModel::findOrFail($parent_id);
        }

        $data = [
            'parent' => $parent
        ];

        return view('admin.tables.regions.cities_create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataValid = $this->validate($request, [
            'name' => ['required','string','max:255'],
            'slug' => ['required','string','max:255','alpha_dash', 'unique:cities,slug'],
            'parent_id' => ['required','integer'],
        ]);

        $city = CityModel::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id == 0 ? null : $request->parent_id
        ]);


        return redirect()->route('admin.cities.show', $city);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CityModel $city)
    {
        $city = CityModel::findOrFail($city->id);


        return view('admin.tables.regions.cities_show')->with(['city' => $city]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CityModel $city)
    {
        $regions = RegionModel::all();

        return view('admin.tables.regions.cities_edit')->with(['city' => $city, 'regions' => $regions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CityModel $city)
    {
        $dataValid = $this->validate($request, [
            'name' => ['required','string','max:255'],
            'slug' => ['required','string','max:255','slug', 'unique:cities,slug,' . $city->id],
            'parent_id' => ['required','integer'],
        ]);

        $result = $city->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id == 0 ? null : $request->parent_id
        ]);

        return redirect()->route('admin.cities.show', $city->id)->with(['success' => 'Успешно']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CityModel $city)
    {
        $parent_region = $city->region;

        $city->delete();

        if ($parent_region) {
            return redirect()->route('admin.regions.show', $parent_region);
        }

        return redirect()->route('admin.regions.index');
    }
}
