<?php

include "./db-connect.php";

$id = $_GET['id'];

if (isset($id)) {

    $sql =
        "DELETE FROM 
            `php_crud` 
        WHERE 
            `id`=:id";

    $db = DBConnect::getInstance();
    $pdoConn = $db->getConnection();

    $stmt = $pdoConn->prepare($sql);

    $result = $stmt->execute([
        ':id' => $id
    ]);

    if ($result) {
        // Show success notification
    } else {
        // Show error notification
    }

    header('location:user-list.php');
}
