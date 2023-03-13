<?php
require('MySQLHandler.php');
require('config.php');

$handler = new MySQLHandler('products');
// $products = $handler->get_data();
// var_dump($products);

$method = $_SERVER['REQUEST_METHOD'];
// var_dump($method);

$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', $url);
// var_dump($parts);

// $resource = isset($parts[3]) ? $parts[3] : null;
// $resourceId = isset($parts[4]) ? $parts[4] : null;

// var_dump($resource);
// var_dump($resourceId);

switch ($method) {
    case "GET":
        GetData($handler);
        break;
    case "POST":
        saveData($handler);
        break;
    case "PUT":
        UpdateData($handler);
        break;
    case "DELETE":
        deleteData($handler);
        break;
    default:
        MethodNotAllowed();
}


function MethodNotAllowed()
{
    header('content-Type:application/json');
    http_response_code(405);
    echo json_encode(array('message' => 'Method not allowed'));
}

function GetData($handler)
{
    // var_dump($_GET);
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        header('content-Type:application/json');
        http_response_code(200);
        $products = $handler->get_record_by_id($id);
        echo json_encode($products);

        if (!$products) {
            header('content-Type:application/json');
            http_response_code(400);
            echo json_encode(array('errorr' => "Resource dosn't exist , ID : $id Not found in DB"));
        }

        var_dump($products);
        // and display the result
    } else {
        header('content-Type:application/json');
        http_response_code(200);
        $products = $handler->get_data();
        echo json_encode($products);
    }
}

function saveData($handler)
{
    $data = json_decode(file_get_contents('php://input'), true);
    // var_dump($data);
    $newData = array(
        'id' => $data['id'],
        'name' => $data['name'],
        'price' => $data['price'],
        'units_in_stock' => $data['units_in_stock']
    );
    // var_dump($newData);

    if (!$handler->save($newData)) {
        http_response_code(405);
        echo json_encode(array('Erorr' => 'can not create '));
    } else {
        http_response_code(201);
        echo json_encode(array('message' => 'Product created successfully'));
    }
}
function UpdateData($handler)
{
    $data = json_decode(file_get_contents('php://input'), true);
    // var_dump($data);
    $id = $data['id'];


    if ($handler->search('id', $id)) {
        $oldData = $handler->search('id', $id);

        // var_dump($oldData);
        $newData = array(
            'id' => $oldData[0]['id'],
            'name' => $data['name'],
            'price' => $data['price'],
            'units_in_stock' => $data['units_in_stock']
        );
        // var_dump($newData);
        if (!$oldData) {
            http_response_code(405);
            echo json_encode(array('Erorr' => 'Can not update '));
        } else {
            $handler->update($newData, $id);
            http_response_code(201);
            echo json_encode(array('message' => 'Product updated successfully'));
        }
    } else {
        header('content-Type:application/json');
        http_response_code(400);
        echo json_encode(array('errorr' => "Resource dosn't exist , ID : $id Not found in DB"));
    }
}

function deleteData($handler)
{
    $data = json_decode(file_get_contents('php://input'), true);
    // var_dump($data);
    $id = $data['id'];


    if ($handler->search('id', $id)) {
        $oldData = $handler->search('id', $id);

        if (!$oldData) {
            http_response_code(405);
            echo json_encode(array('Erorr' => 'Can not Delete '));
        } else {
            $handler->delete($id);
            http_response_code(201);
            echo json_encode(array('message' => 'Product deleted successfully'));
        }
    } else {
        header('content-Type:application/json');
        http_response_code(400);
        echo json_encode(array('errorr' => "Resource dosn't exist , ID : $id Not found in DB"));
    }
}
