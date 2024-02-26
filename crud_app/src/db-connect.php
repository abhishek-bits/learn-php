<?php

class DBConnect
{
    private string $host = "localhost";
    private string $user = "root";
    private string $pass = "1234";
    private string $db = "test";

    private mysqli $conn;

    function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
    }

    /**
     * Returns the connection object.
     */
    function getConnection(): mysqli
    {
        if ($this->conn) {
            // echo "Connection successful!";
            return $this->conn;
        } else {
            // Show the error that occurred and terminate.
            die(mysqli_error($this->conn));
        }
    }

    /**
     * Closes the open connection
     */
    function closeConnection(): void
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
