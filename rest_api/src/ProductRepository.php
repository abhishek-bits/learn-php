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

    public function create(array $data): string
    {
        $sql = "INSERT INTO `product`(`name`, `size`, `is_available`) 
                VALUES (:name, :size, :is_available)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":name", $data["name"], PDO::PARAM_STR);
        $stmt->bindValue(":size", $data["size"], PDO::PARAM_INT);
        $stmt->bindValue(":is_available", (bool) $data["is_available"] ?? false, PDO::PARAM_BOOL);

        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    public function get(int $id): array | false
    {
        $sql = "SELECT * FROM `product`
                WHERE `id` = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data !== false) {
            $data["is_available"] = (bool) $data["is_available"];
        }

        return $data;
    }

    public function update(array $old, array $new): int
    {
        $sql = "UPDATE `product`
                SET `name` = :name, `size` = :size, `is_available` = :is_available
                WHERE `id` = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":name", $new["name"] ?? $old["name"], PDO::PARAM_STR);
        $stmt->bindValue(":size", $new["size"] ?? $old["size"], PDO::PARAM_INT);
        $stmt->bindValue(":is_available", $new["is_available"] ?? $old["is_available"], PDO::PARAM_BOOL);

        $stmt->bindValue("id", $old["id"], PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function delete($id): int
    {
        $sql = "DELETE FROM `product`
                WHERE `id` = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }
}
