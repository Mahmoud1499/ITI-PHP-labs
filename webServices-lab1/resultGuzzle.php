<?php
require("vendor/autoload.php");

use GuzzleHttp\Client;

if (isset($_POST['submit'])) {
    $city = $_POST['city'];

    $url = "http://api.openweathermap.org/data/2.5/weather?q=" . $city . ",EG&appid=7adfdf73fdb1fc315564ae84916d6f33";

    $client = new Client();

    $response = $client->get($url);


    $data = json_decode($response->getBody(), true);
    //var_dump($data);
    echo "<h1>Weather status in " . $data['name'] . ": <br/>" . $data['weather'][0]['description'] . "</h1>";
    echo "<h2>Date : " . date('Y-m-d H:i:s', $data['dt']) . "</h2>";
    echo "<h2>Time : " . date(' H:i:s', $data['dt']) . "</h2>";

    echo "<h2>Humidity: " . $data['main']['humidity'] . "%</h2>";
    echo "<h2>Wind speed: " . $data['wind']['speed'] . " m/s</h2>";
}
