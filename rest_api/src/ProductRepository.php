<?php

/**
 * Singleton class support single point of DB operations accross application.
 */
class ProductRepository
{
    private string $host = "localhost";
    private string $user = "root";
    private string $pass = "1234";
    private string $db = "test";

    private PDO $conn;

    // We'll use the nullable operator '?' 
    // to set the $obj varaible initially to null.
    private static ?ProductRepository $obj = null;

    // private constructor prevents direct initialization
    private function __construct()
    {
        echo 'Connecting...';
        $this->conn = new PDO(
            "mysql:host=$this->host;dbname=$this->db",
            $this->user,
            $this->pass,
            // By default PDO would parse the data into string
            // We can fix this by updating below flags.
            // [
            //     PDO::ATTR_EMULATE_PREPARES => false,
            //     PDO::ATTR_STRINGIFY_FETCHES => false
            // ]
        );
    }

    // private clone method prevents cloning
    private function __clone()
    {
    }

    public static function getInstance(): ProductRepository
    {
        if (!self::$obj) {
            self::$obj = new ProductRepository();
        }
        return self::$obj;
    }

    public function findAll(): array
    {
        $sql = "SELECT * FROM `product`";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        $data = [];

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

            // If we want the boolean values to be literals
            // instead of 0s or 1s, we can do as follows:
            $row["is_available"] = (bool) $row["is_available"];

            $data[] = $row;
        }

        return $data;
    }
}
