<?php

include "./db-connect.php";

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $password = $_POST["password"];

    $sql =
        "INSERT INTO 
            `php_crud` (
                `name`, 
                `email`, 
                `mobile`, 
                `password`
            )
        VALUES(
            :name, 
            :email, 
            :mobile, 
            :password
        )";

    $db = DBConnect::getInstance();
    $pdoConn = $db->getConnection();

    $stmt = $pdoConn->prepare($sql);

    $result = $stmt->execute([
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

    <title>Add User</title>
</head>

<body>

    <div class="container my-5"> <!-- my-5 class will add a top and bottom margin of 5 -->
        <form method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter your mobile" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
            </div>
            <!-- 
                Using the name attribute of the button tag
                we can check whether the button is clicked or not
                from our PHP code.
            -->
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>