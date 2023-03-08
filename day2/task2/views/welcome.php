<?php

// var_dump($_SESSION);

if (isset($_SESSION["name"])) {
    $name = $_SESSION["name"];
    echo "<h1> Welcome  $name </h1>";
} else {
    echo "You Must login to see this page";
}
