<?php


namespace App\Services\Adverts\Search;


use App\Models\Advert\Advert;
use Elasticsearch\Client;

class AdvertElasticService
{

    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index(Advert $advert)
    {
        // Attributes array
        $attributes = array_map(function ($value){

            return [
                'attribute' => $value['attribute_id'],
                'value_string' => $value['value'],
                'value_int' => $value['value'],
            ];

        }, $advert->attributes->toArray());


        $this->client->index([
            'index' => 'adverts',
            'type' => 'advert',
            'id' => $advert->id,
            'body' => [
                'id' => $advert->id,
                'title' => $advert->title,
                'content' => $advert->content,
                'published_at' => $advert->published_at,
                'price' => $advert->price,
                'status' => $advert->status,
                'category_id' => $advert->category_id,
                'city_id' => $advert->city_id,
                'value' => $attributes,
            ]

        ]);
    }

    public function delete(Advert $advert)
    {
        $this->client->delete([
            'index' => 'adverts',
            'type' => 'advert',
            'id' => $advert->id,
        ]);
    }
}
