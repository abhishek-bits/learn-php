<?php

include "./db-connect.php";

$sql =
    "SELECT 
        * 
    FROM 
        `php_crud`";

$db = new DBConnect();
$conn = $db->getConnection();

$users = mysqli_query($conn, $sql);

if (!$users) {
    die(mysqli_error($conn));
}

$conn = $db->closeConnection();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Users List</title>
</head>

<body>
    <div class="container">
        <button class="btn btn-primary my-5"><a href="add-user.php" class="text-light" style="text-decoration: none;">Add User</a></button>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Password</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($users) {
                    // Loop over users result-set
                    while ($row = mysqli_fetch_assoc($users)) {

                        $id = $row['id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $mobile = $row['mobile'];
                        $password = $row['password'];

                        echo
                        '<tr>
                            <th scope="row">' . $id . '</th>
                            <td>' . $name . '</td>
                            <td>' . $email . '</td>
                            <td>' . $mobile . '</td>
                            <td>' . $password . '</td>
                            <td>
                                <button class="btn btn-warning">
                                    <a 
                                        href="update-user.php?id=' . $id . '" 
                                        class="text-light" 
                                        style="text-decoration:none;">
                                        Update
                                    </a>
                                </button>
                                &nbsp;
                                <button class="btn btn-danger">
                                    <a 
                                        href="delete-user.php?id=' . $id . '" 
                                        class="text-light" 
                                        style="text-decoration:none;">
                                        Delete
                                    </a>
                                </button>
                            </td>
                        </tr>';
                    }
                }
                ?>

            </tbody>
        </table>

    </div>
</body>

</html>