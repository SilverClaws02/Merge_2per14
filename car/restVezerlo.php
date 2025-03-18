<?php
require_once("CarRestKezelo.php");

$view = $_GET["view"] ?? "";

$carrest = new CarRestKezelo();

switch ($view) {
    case "all":
        $carrest->getAllCars();
        break;
    case "single":
        if (!empty($_GET["id"])) {
            $carrest->getCarById($_GET["id"]);
        } else {
            $carrest->getFault();
        }
        break;
    case "tipus":
        if (!empty($_GET["tid"])) {
            $carrest->getCarsByType($_GET["tid"]);
        } else {
            $carrest->getFault(); 
        }
        break;
    default:
        $carrest->getFault(); 
}
?>
