<?php
require("vendor/autoload.php");

use GuzzleHttp\Client;

class Weather
{
    private $apiKey;
    private $client;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new GuzzleHttp\Client();
    }

    public function getWeather($city)
    {
        $url = "http://api.openweathermap.org/data/2.5/weather?q=" . $city . ",EG&appid=" . $this->apiKey;

        $response = $this->client->get($url);

        $data = json_decode($response->getBody(), true);

        return [
            'city' => $data['name'],
            'description' => $data['weather'][0]['description'],
            'date' => date('Y-m-d ', $data['dt']),
            'time' => date('H:i:s', $data['dt']),

            'humidity' => $data['main']['humidity'],
            'wind_speed' => $data['wind']['speed']
        ];
    }
}

$weather = new Weather('08d9cada83c4182df5d784aa76e1c99d');

if (isset($_POST['submit'])) {
    $city = $_POST['city'];

    $weatherData = $weather->getWeather($city);

    echo "<h1>Weather in " . $weatherData['city'] . ": <br/> " . $weatherData['description'] . "</h1>";
    echo "<h2>Date : " . $weatherData['date'] . "</h2>";
    echo "<h2>Time: " . $weatherData['time'] . "</h2>";

    echo "<h2>Humidity: " . $weatherData['humidity'] . "%</h2>";
    echo "<h2>Wind speed: " . $weatherData['wind_speed'] . " m/s</h2>";
}
