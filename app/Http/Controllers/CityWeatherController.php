<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CityWeatherController extends Controller
{
    public function citiesWeather()
    {
        $cities = Http::get('https://sandbox.musement.com/api/v3/cities')->json();
        $weathers = array();
        foreach ($cities as $city) {
            $lat = $city['latitude'];
            $long = $city['longitude'];
            $cityWeather = Http::get("http://api.weatherapi.com/v1/forecast.json?key=93815ad740e745fbb59173355211403&q=$lat,$long")->json();

            $weathers[] = array(
                'cityName' => $city['name'],
                'weatherCondition' => $cityWeather['forecast']['forecastday'][0]['day']['condition']['text']
            );
        }
        return view('cities_weather', compact('weathers'));

    }
}
