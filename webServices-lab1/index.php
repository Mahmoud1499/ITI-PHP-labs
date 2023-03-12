<?php
require_once('./back/functions.php');
require_once('./back/config.php');

$data = getDataFromJson('./src/city.list.json');
$EGYcities = getCountryCities($data, 'EG');
// echo '<pre>';
// var_dump($EGYcities);
// echo '</pre>';

// require_once('./resultCurl.php');
// require_once('./resultOOP.php');
require_once('./resultGuzzle.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather forcase</title>
</head>

<body>
    <h1>Weather Forcast</h1>
    <form method="post">
        <label for=" city">Select City:</label>
        <select name="city" id="city">
            <?php
            foreach ($EGYcities as $city) {
                echo "   <option value='$city->name'>$city->name</option>";
            }
            ?>
        </select>
        <button type="submit" name="submit">Get Weather</button>
    </form>

</body>

</html>