<?php
function getDataFromJson($fileName)
{

    if (file_exists($fileName)) {

        $data = file_get_contents($fileName); //data read from json file
        // print_r($data);
        $data = json_decode($data);  //decode a data
        // print_r($data); //array format data printing

    }
    return $data;
}

function getCountryCities($data, $country)
{
    $cities = [];
    // var_dump($data[0]->country);
    for ($i = 0; $i <= count($data); $i++)
        if (!empty($data[$i]->country) && $data[$i]->country == $country) {
            array_push($cities, $data[$i]);
        }


    return $cities;
}
