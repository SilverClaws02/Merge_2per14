<?php
class DBVezerlo {
    private $conn = null;
    private $host = "localhost"; 
    private $user = "root"; 
    private $password = ""; 
    private $database = "car";

    public function __construct() {
        $this->conn = $this->connectDB();
    }

    private function connectDB(): mysqli | bool {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $conn;
    }

    public function executeSelectQuery($query, $params = []): array {
        $stmt = mysqli_prepare($this->conn, $query);
        
        if (!empty($params)) {
            $types = str_repeat('s', count($params)); 
            mysqli_stmt_bind_param($stmt, $types, ...$params);
        }
        
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $resultset = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }

        mysqli_stmt_close($stmt);

        return !empty($resultset) ? $resultset : [];
    }

    public function closeDB(): void {
        if ($this->conn) {
            mysqli_close($this->conn);
            $this->conn = null;
        }
    }
}
?>
