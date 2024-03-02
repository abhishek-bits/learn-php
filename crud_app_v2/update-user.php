<?php

include "./db-connect.php";

$id = $_GET["id"];

$name = null;
$phone = null;
$mobile = null;
$password = null;

if (isset($id)) {
    // Fetch the user with this id from the database.
    $sql =
        "SELECT 
            * 
        FROM 
            `php_crud` 
        WHERE 
            `id` = :id";

    $db = DBConnect::getInstance();
    $pdoConn = $db->getConnection();

    $stmt = $pdoConn->prepare($sql);

    $result = $stmt->execute([
        ':id' => $id
    ]);

    if ($result) {
        // Fetch a single row in PDO
        $row = $stmt->fetch();

        $name = $row["name"];
        $email = $row["email"];
        $mobile = $row["mobile"];
        $password = $row["password"];
    } else {
        // Show error notification

        // Redirect on error.
        header('location:user-list.php');
        die();
    }
}

if (isset($_POST["update"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $password = $_POST["password"];

    $sql =
        "UPDATE 
            `php_crud` 
        SET 
            `name`=:name, 
            `email`=:email, 
            `mobile`=:mobile, 
            `password`=:password 
        WHERE 
            `id`=:id";

    $db = DBConnect::getInstance();
    $pdoConn = $db->getConnection();

    $stmt = $pdoConn->prepare($sql);

    $result = $stmt->execute([
        ':id' => $id,
        ':name' => $name,
        ':email' => $email,
        ':mobile' => $mobile,
        ':password' => $password
    ]);

    if ($result) {
        // Show success notification
    } else {
        // Show error notification
    }

    header('location:user-list.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Update User</title>
</head>

<body>

    <div class="container my-5"> <!-- my-5 class will add a top and bottom margin of 5 -->
        <form method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name" autocomplete="off" required value=<?php echo $name; ?>>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" autocomplete="off" required value=<?php echo $email; ?>>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter your mobile" autocomplete="off" required value=<?php echo $mobile; ?>>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required value=<?php echo $password ?>>
            </div>
            <!-- 
                Using the name attribute of the button tag
                we can check whether the button is clicked or not
                from our PHP code.
            -->
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
    </div>

</body>

</html>