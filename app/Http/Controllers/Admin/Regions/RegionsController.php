<?php

namespace App\Http\Controllers\Admin\Regions;

use App\Models\Rerions\RegionModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class RegionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = RegionModel::where('parent_id', null)->paginate(15);

        $data = [
            'regions' => $regions,
        ];

        return view('admin.tables.regions.regions_index')->with($data);
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

        return view('admin.tables.regions.regions_create')->with($data);
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
            'slug' => ['required','string','max:255','alpha_dash', 'unique:regions,slug'],
            'parent_id' => ['required','integer'],
        ]);

        $region = RegionModel::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id == 0 ? null : $request->parent_id
        ]);


        return redirect()->route('admin.regions.show', $region);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(RegionModel $region)
    {
        $region = RegionModel::find($region->id);

        $sub_regions = $region->children;

        $data = [
            'region' => $region,
            'sub_regions' => $sub_regions,
        ];

        return view('admin.tables.regions.regions_show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(RegionModel $region)
    {
        $data = [
            'region' => $region
        ];

        return view('admin.tables.regions.regions_edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegionModel $region)
    {
        $dataValid = $this->validate($request, [
            'name' => ['required','string','max:255'],
            'slug' => ['required','string','max:255','slug', 'unique:regions,slug'],
            'parent_id' => ['required','integer', Rule::unique('regions')->ignore($region->id)],
        ]);

        $result = $region->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id == 0 ? null : $request->parent_id
        ]);

        if ($region->parent_id !== null) {
            return redirect()->route('admin.regions.show', $region->parent_id);
        }

        return redirect()->route('admin.regions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegionModel $region)
    {
        $parent = $region->parent;

        $region->delete();

        if ($parent) {
            return redirect()->route('admin.regions.show', $parent);
        }

        return redirect()->route('admin.regions.index');
    }
}
