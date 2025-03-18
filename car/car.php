<?php
require("dbvezerlo.php");

class Car {
    private $cars = [];

    public function __construct() {
    }

    public function getAllcars(): array {
        $query = "SELECT c_id, c_desc, path FROM tbl_car";
        $dbvez = new DBVezerlo();
        $this->cars = $dbvez->executeSelectQuery($query); 
        $dbvez->closeDB();
        return $this->cars;
    }

    public function getcarsById($carId): array {
        $query = "SELECT c_id, c_desc, path FROM tbl_car WHERE c_id = " . $carId;
        $dbvez = new DBVezerlo();
        $this->cars = $dbvez->executeSelectQuery($query); 
        $dbvez->closeDB();
        return $this->cars;
    }

    public function getcarsByType($ct_desc): array {
        $query = "SELECT c_id, c_desc, path, car_type.ct_desc 
                  FROM tbl_car
                  INNER JOIN car_type ON car_type.ct_id = tbl_car.c_id 
                  WHERE car_type.ct_desc = '" . $ct_desc . "'"; 
        $dbvez = new DBVezerlo();
        $this->cars = $dbvez->executeSelectQuery($query); 
        $dbvez->closeDB();
        return $this->cars;
    }
}
?>
