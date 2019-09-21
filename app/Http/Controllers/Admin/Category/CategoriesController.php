<?php

namespace App\Http\Controllers\Admin\Category;

use App\Models\Category\CategoryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $categories = CategoryModel::where('parent_id', null)->get();
        $categories = CategoryModel::defaultOrder()->withDepth()->orderBy('id')->get();




        return view('admin.tables.categories.categories_index', [
            'categories' => $categories,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = CategoryModel::orderBy('name')->withDepth()->get();

        return view('admin.tables.categories.categories_create', [
            'parents' => $parents
        ]);
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
            'name' => ['required','string','max:255', 'unique:categories,name'],
            'slug' => ['required','string','max:255', 'unique:categories,slug'],
            'parent' => ['required','integer'],
        ]);

        $category = CategoryModel::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent,
        ]);

        return redirect()->route('admin.categories.show', $category)->with('status', 'Категория успешно создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryModel $category)
    {

        $var = $category->parentAttributes();
        dump($var);

        return view('admin.tables.categories.categories_show', [
            'category' =>$category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryModel $category)
    {
        $parents = CategoryModel::defaultOrder()->where('id', '!=', $category->id)->withDepth()->get();

        return view('admin.tables.categories.categories_edit', [
            'category' => $category,
            'parents' => $parents
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryModel $category)
    {
        $dataValid = $this->validate($request, [
            'name' => ['required','string','max:255', Rule::unique('categories')->ignore($category->id)],
            'slug' => ['required','string','max:255', Rule::unique('categories')->ignore($category->id)],
            'parent' => ['required','integer'],
        ]);

        $data = $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent,
        ]);

        return redirect()->route('admin.categories.show', $category)->with('status', 'Категория успешно изменена');
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
