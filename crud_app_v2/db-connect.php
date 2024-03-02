<?php

/**
 * Singleton class DBConnect to support single point of DB operations accross application.
 */
class DBConnect
{
    private string $host = "localhost";
    private string $user = "root";
    private string $pass = "1234";
    private string $db = "test";

    private PDO $pdoConn;

    // We'll use the nullable operator '?' 
    // to set the $obj varaible initially to null.
    private static ?DBConnect $obj = null;

    private function __construct()
    {
        try {
            $this->pdoConn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
            $this->pdoConn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (PDOException $e) {
            echo "Connection Failed: " . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (!self::$obj) {
            self::$obj = new DBConnect();
        }
        return self::$obj;
    }

    /**
     * Returns the connection object.
     */
    function getConnection(): PDO
    {
        return $this->pdoConn;
    }
}
