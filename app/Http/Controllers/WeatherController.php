<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function showWeather(Request $request)
    {


      $weatherData = array();

      $imageUrl = 'http://openweathermap.org/img/w/';
      $apiKey = '61f18264b1a8919cea3d08556ebe74f8';
      $apiUrl = 'https://api.openweathermap.org/data/2.5/weather?q=' . $request->city . '&appid=' . $apiKey;

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $apiUrl);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      $urlContent = curl_exec($ch);
      curl_close($ch);

      $jsonData = json_decode($urlContent, true);

      $responseCode = $jsonData['cod'];

      if($responseCode == 200)
      {
        $weatherData['description'] = $jsonData['weather'][0]['description'];
        $weatherData['icon'] = $imageUrl . $jsonData['weather'][0]['icon'] . '.png';
        return view('weather', ['city' => $request->city, 'weatherData' => $weatherData]);
      }else{
        return 'City <strong>' . $request->city . '</strong> not found';
      }
    }
}
