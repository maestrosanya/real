<?php

namespace App\Http\Controllers\Admin\AttributeForCategory;

use App\Models\Attribute\AttributeForCategoryModel;
use App\Models\Category\CategoryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class AttributeForCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryModel $category, AttributeForCategoryModel $attribute)
    {
        return view('admin.tables.categories.attributes.attributes_create', [
            'category' => $category,
            'attribute_types' => $attribute::getTypes(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CategoryModel $category)
    {
        $dataValid = $this->validate($request, [
            'name' => ['required','string'],
            'type' => ['required','string', Rule::in(AttributeForCategoryModel::getTypes())],
            'sort' => ['required','integer'],
            'required' => ['required','integer', Rule::in( ['0', '1'])],
            'variants_attr' => ['required','array'],
            'variants_attr.*' => ['required','string','max:255'],
        ]);

        $attribute = $category->attributes()->create([
            'name' => $request->name,
            'type' => $request->type,
            'sort' => $request->sort,
            'required' => $request->required,
            'category_id' => $category->id,
            'variants' => json_encode($request->variants_attr),
        ]);

        return redirect()->route('admin.categories.attributes.show', [$category, $attribute])->with(['status' => 'Атрибут успешно добавлен']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryModel $category, AttributeForCategoryModel $attribute)
    {
        return view('admin.tables.categories.attributes.attributes_show', [
            'attribute' => $attribute,
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryModel $category, AttributeForCategoryModel $attribute)
    {

        return view('admin.tables.categories.attributes.attributes_edit', [
            'attribute' => $attribute,
            'category' => $category,
            'attribute_types' => $attribute->getTypes(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryModel $category, AttributeForCategoryModel $attribute)
    {
        $dataValid = $this->validate($request, [
            'name' => ['required','string'],
            'type' => ['required','string', Rule::in(AttributeForCategoryModel::getTypes())],
            'sort' => ['required','integer'],
            'required' => ['required','integer', Rule::in( ['0', '1'])],
            'variants_attr' => ['required','array'],
            'variants_attr.*' => ['required','string','max:255'],
        ]);

        $result = $category->attributes()->findOrFail($attribute->id)->update([
            'name' => $request->name,
            'type' => $request->type,
            'sort' => $request->sort,
            'required' => $request->required,
            'category_id' => $category->id,
            'variants' => json_encode($request->variants_attr),
        ]);


        return redirect()->route('admin.categories.attributes.show', [$category, $attribute])->with(['status' => 'Атрибут успешно изменён']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryModel $category, AttributeForCategoryModel $attribute)
    {
        $category->attributes()->findOrFail($attribute->id)->delete();

        return redirect()->route('admin.categories.show', $category)->with([
            'status' => 'Атрибут ' . $attribute->name . ' успешно удалён'
        ]);
    }
}
