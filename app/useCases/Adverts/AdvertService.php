<?php


namespace App\useCases\Adverts;


use App\Http\Requests\AdvertFormRequest;
use App\Models\Advert\Advert;
use App\Models\Advert\AdvertAttribute;
use App\Models\Category\CategoryModel;
use App\User;
use Illuminate\Support\Facades\DB;

class AdvertService
{
    public function createAdvert(AdvertFormRequest $request, $userID, $categoryId)
    {



        return DB::transaction(function () use ($request, $userID, $categoryId){

            $advert = Advert::make([
                'title' => $request['title'],
                'content' => $request['content'],
                'price' => $request['price'],
                'region_id' => $request['city_id'],
                'address' => $request['address'],
                'phone' => $request['phone'],
                'status' => Advert::STATUS_DRAFT,

                'category_id' => $categoryId->id,
                'user_id' => $userID

            ]);

            $advert->saveOrFail();


            if ($request->attribute) {
                foreach ($request->attribute as $key => $value) {

                    if ($value !== null) {
                        AdvertAttribute::create([
                            'advert_id' => $advert->id,
                            'attribute_id' => $key,
                            'value' => $value,
                        ]);
                    }


                }
            }




            return $advert;

        });
    }
}
