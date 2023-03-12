<?php
if (isset($_POST['submit'])) {
    //var_dump($_GET);
    //var_dump($_POST);
    $city = $_POST['city'];

    $url = "http://api.openweathermap.org/data/2.5/weather?q=" . $city . ",EG&appid=08d9cada83c4182df5d784aa76e1c99d";
    // var_dump($url);

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);

    //var_dump($response);

    curl_close($curl);

    $data = json_decode($response, true);
    // var_dump($data);
    // var_dump($data);
    echo "<h1>Weather status in " . $data['name'] . ": <br/>" . $data['weather'][0]['description'] . "</h1>";
    echo "<h2>Date : " . date('Y-m-d H:i:s', $data['dt']) . "</h2>";
    echo "<h2>Time : " . date(' H:i:s', $data['dt']) . "</h2>";

    echo "<h2>Humidity: " . $data['main']['humidity'] . "%</h2>";
    echo "<h2>Wind speed: " . $data['wind']['speed'] . " m/s</h2>";
}
