<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Clients\DeliveryClient;

class CitiesController extends Controller
{
    public function updateCities(DeliveryClient $deliveryClient)
    {
        $cities = [
            'citiesUa' => $deliveryClient->getUaCities()['data'],
            'citiesRu' => $deliveryClient->getRuCities()['data']
        ];

        foreach($cities['citiesUa'] as $cityUa)
        {
            $cityRuKey = array_search($cityUa['id'], array_column($cities['citiesRu'], 'id'));
                    $names[] = [
                        'ua' => $cityUa['name'],
                        'ru' => $cities['citiesRu'][$cityRuKey]['name'],
                        'region' => [
                            'ua' => $cityUa['regionName'],
                            'ru' => $cities['citiesRu'][$cityRuKey]['regionName']]
                    ];
        }

        foreach($names as $name)
        {
            $dataRegion = json_encode($name['region']);
            $region = Region::where('name', $dataRegion)->first();
            if(empty($region))
            {
                $region = new Region;
                $region->name = $dataRegion;
                $region->save();
            }
            unset($name['region']);
            $dataCities = json_encode($name);
            $city = new City;
            $city->name = $dataCities;
            $city->regionId = $region->id;
            $city->save();
        }

        return response()->json([
            'status' => 200
        ]);
    }

    public function getCities()
    {
        $data = [];
        $lang = getCurrentLocale();
        $regions = Region::get();
        foreach ($regions as $region)
        {
            $dataRegion = json_decode($region['name'], true);

            $cityData = $region->cities->map(function ($item) use ($lang) {
                $langCities = json_decode($item['name'], true);
                return [
                    'id' => $item['id'],
                    'city' => $langCities[$lang]
                ];
            });

            $data[] = [
                $dataRegion[$lang],
                $cityData
            ];
        }

        return response()->json($data);
    }

    public function getCitiesByLang()
    {

    }
}
