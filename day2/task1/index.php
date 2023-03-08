<?php
// var_dump($_SERVER['PHP_SELF']);
require_once('serverSide/config.php');
require_once('serverSide/functions.php');


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $errorsArray = validate_form();
    if (!empty($errorsArray)) {
        foreach ($errorsArray as $error) {
            echo "<h2> $error</h2>";
        }
    } else {
        echo WELCOME_MESSAGE;
        save_to_file();
        print_data();
        die();
    }
}





$parameter = isset($_GET["page"]) ? $_GET["page"] : "";
if ($parameter === "contact")
    require_once("views/contact.php");
else
    require_once("views/users.php");