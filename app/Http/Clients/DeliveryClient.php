<?php

namespace App\Http\Clients;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DeliveryClient {
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('DELIVERY_URL')
        ]);
    }

    public function getUACities()
    {
        $result = $this->client->get(
            'api/v4/Public/GetAreasList?culture=uk-UA&fl_all=true&regionId=00000000-0000-0000-0000-000000000000&country=1')
            ->getBody()
            ->getContents();

        $response = json_decode($result, true);

        return $response;
    }

    public function getRUCities()
    {
        $result = $this->client->get(
            'api/v4/Public/GetAreasList?culture=ru-RU&fl_all=true&regionId=00000000-0000-0000-0000-000000000000&country=1')
            ->getBody()
            ->getContents();

        $response = json_decode($result, true);

        return $response;
    }
}