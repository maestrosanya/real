<?php


namespace App\Services\Adverts\Search;


use Elasticsearch\Client;

class AdvertsSearch
{

    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function search($category, $region, $request)
    {
        return $this->client->search([
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'from' => 0,
                'size' => 10,
                'query' => [
                    'bool' => [
                        'must' => [
                          //  ['term' => ['value.attribute' => 4]],
                            ['term' => ['region_id' => $region]]
                        ]
                    ]
                ]
            ]
        ]);
    }
}
