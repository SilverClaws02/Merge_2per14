<?php
class DBController
{
    private $conn = null;
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "car";

    function __construct()
    {
        $this->connectDB();
        print('carpdo');
    }

    function connectDB()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->host};
            dbname={$this->database};charset=utf8",
            $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    function executeSelectQuery($query, $params = []) {
        try
        {
            $stmt = $this->conn->prepare($query);

            if ($params) {
                $stmt->execute($params);
            } else {
                $stmt->execute();
            }

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }

    function closeDB() {
        $this->conn = null;
    }
}

?>
