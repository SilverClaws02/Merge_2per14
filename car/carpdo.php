<?php
require("dbvezerlopdo.php");

class Car {
    private $db;

    public function __construct() {
        $this->db = new DBController();  
    }

    public function getAllcars(): array {
        $query = "SELECT c_id, c_desc, path FROM tbl_car"; 
        return $this->db->executeSelectQuery($query); 
    }
    public function getcarsById($carId): array {
        $query = "SELECT c_id, c_desc, path FROM tbl_car WHERE c_id = ?";
        return $this->db->executeSelectQuery($query, [$carId]); 
    }

    public function getcarsByType($ct_desc): array {
        $query = "SELECT c_id, c_desc, path, car_type.ct_desc
                  FROM tbl_car
                  INNER JOIN car_type ON car_type.ct_id = tbl_car.c_id
                  WHERE car_type.ct_desc = ?";
        return $this->db->executeSelectQuery($query, [$ct_desc]); 
    }
}
?>
