<?php

namespace App\Http\Controllers;

use App\Console\Commands\Search\ElastiStart;
use App\Http\Traits\ResponseDataTrait;
use App\Models\Advert\Advert;
use App\Models\Regions\CityModel;
use App\Models\Regions\RegionModel;
use Elasticsearch\Client;
use Illuminate\Http\Request;

class HomeController extends SiteController
{
    use ResponseDataTrait;

    public $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($city_slug = null)
    {
        $advert = Advert::find(4);

        $country = RegionModel::getCountry();

       // $city = CityModel::where('slug', $city_slug)->firstOrFail();


        dump($this->client->search([
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'from' => 0,
                'size' => 10,
                'query' => [
                    'bool' => [
                        'must' => array_merge(
                            [
                                ['term' => ['value.attribute' => 4]]
                            ],
                            array_filter( [true ? ['term' => ['city_id' => 3]] : false])
                        )





                    ]
                ]
            ]
        ]));




        return $this->renderView('home', [
            'categories' =>  $this->getCategories(),
            'regions' =>  $this->getRegions(),
            'country' => $country
        ]);
    }
}
