<?php


namespace App\useCases\Advert;


use App\Models\Advert\Advert;
use App\Models\Category\CategoryModel;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class AdvertService
{
    public function create(FormRequest $request, $userID, $categoryId)
    {
        $user = User::findOrFail($userID);

        $category = CategoryModel::findOrFail($categoryId);


        DB::transaction(function () use ($request, $user, $category){

            $advert = new Advert();

            $advert->title = $request['title'];
            $advert->content = $request['content'];
            $advert->price = $request['price'];
            $advert->address = $request['address'];
            $advert->phone = $request['phone'];
            $advert->status = $request['status'];

        });
    }
}