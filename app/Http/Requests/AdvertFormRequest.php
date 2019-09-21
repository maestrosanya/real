<?php

namespace App\Http\Requests;

use App\Models\Category\CategoryModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


/**
 * @property CategoryModel $category
 */
class AdvertFormRequest extends FormRequest
{


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        //dd($this->category->allAttributes());

        $items = [];

        foreach ($this->category->allAttributes() as $attribute) {

            $attributeRules = [];

            $key = 'attribute.' . $attribute->id;

            if ($attribute->required === 1) {
                $attributeRules[] = 'required';
            } else {
                $attributeRules[] = 'nullable';
            }

            if ($attribute->isString()) {
                array_push($attributeRules,'string', 'max:255');

            } elseif ($attribute->isInteger()) {
                array_push($attributeRules,'integer', 'digits_between:0,10');


            } elseif ($attribute->isFloat()) {
                array_push($attributeRules,'numeric', 'digits_between:0,10');

            } elseif ($attribute->isSelect()) {
                $attributeRules[] = Rule::in($attribute->getVariants());
            }

            $items[$key] = $attributeRules;


        }

        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:1000'],
            'price' => ['required', 'integer', 'max:999999999'],
            'address' => ['string', 'max:255'],
            'region' => ['required', 'string', 'max:255'],
            'city_id' => ['required', 'integer'],
            'phone' => ['required', 'phone_number'],
        ];

        //dd(array_merge($items, $rules));

        return array_merge($items, $rules);
    }

    public function messages()
    {
        return [
            'phone_number' => 'Некорректный номер телефона',
            'integer' => 'Значение должно быть числом',

            'address.required' => 'Пожалуйста укажите адрес',
        ];
    }
}
