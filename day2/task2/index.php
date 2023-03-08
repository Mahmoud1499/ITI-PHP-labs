<?php
session_start();


if (isset($_POST["name"])) {
    $_SESSION["name"] = $_POST["name"];
}

$parameter = isset($_GET["page"]) ? $_GET["page"] : "";
if ($parameter === "login")
    require_once("views/login.php");
else
    require_once("views/welcome.php");
