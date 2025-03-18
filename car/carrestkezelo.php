<?php
require_once("restKezelo.php");
require_once("carpdo.php");

class CarRestKezelo extends RestKezelo {

    function getAllCars() {
        $cars = new Car();
        $sorAdat = $cars->getAllcars();

        if (empty($sorAdat)) {
            $statusCode = 404;
            $sorAdat = array('error' => 'No cars found!');
        } else {
            $statusCode = 200;
        }

        $this->setHttpFejlec($statusCode);
        header('Content-Type: application/json; charset=UTF-8');

        $result["Cars"] = $sorAdat;

        $response = $this->encodeJson($result);
        $file_path = "Cars.json";
        $this->printfile($response, $file_path);
        echo $response;
    }

    function getCarById($carId) {
        $cars = new Car();
        $sorAdat = $cars->getcarsById($carId);

        if (empty($sorAdat)) {
            $statusCode = 404;
            $sorAdat = array('error' => 'No car found by this ID!');
        } else {
            $statusCode = 200;
        }

        $this->setHttpFejlec($statusCode);
        header('Content-Type: application/json; charset=UTF-8');

        $result["CarById"] = $sorAdat;

        $response = $this->encodeJson($result);
        $file_path = "CarById.json";
        $this->printfile($response, $file_path);
        echo $response;
    }

    function getCarsByType($carType) {
        $cars = new Car();
        $sorAdat = $cars->getcarsByType($carType);

        if (empty($sorAdat)) {
            $statusCode = 404;
            $sorAdat = array('error' => 'No cars found by this type!');
        } else {
            $statusCode = 200;
        }

        $this->setHttpFejlec($statusCode);
        header('Content-Type: application/json; charset=UTF-8');

        $result["CarsByType"] = $sorAdat;

        $response = $this->encodeJson($result);
        $file_path = "CarsByType.json";
        $this->printfile($response, $file_path);
        echo $response;
    }

    function getFault() {
        $statusCode = 400;
        $this->setHttpFejlec($statusCode);
        header('Content-Type: application/json; charset=UTF-8');

        $sorAdat = array('error' => 'Bad Request!');
        $result["fault"] = $sorAdat;

        $response = $this->encodeJson($result);
        $file_path = "Fault.json";
        $this->printfile($response, $file_path);
        echo $response;
    }

    function encodeJson($responseData) {
        return json_encode($responseData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    function printfile($responseData, $file_path) {
        file_put_contents($file_path, $responseData, LOCK_EX);
    }
}

?>
