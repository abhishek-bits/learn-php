<?php

include "./db-connect.php";

$id = $_GET['id'];

if (isset($id)) {

    $sql =
        "DELETE FROM 
            `php_crud` 
        WHERE 
            `id`=$id";

    $db = new DBConnect();
    $conn = $db->getConnection();

    $result = mysqli_query($conn, $sql);

    if ($result) {
        // echo "Data deleted successfully.";

        // On successfull deletion, redirect to specific page.
        header('location:user-list.php');
    } else {
        die(mysqli_error($conn));
    }
}
