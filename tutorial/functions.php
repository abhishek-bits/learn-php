<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="functions.php" method="POST">
        <label for="userName">Your Name: </label>
        <input type="text" name="userName">
        <input type="submit" value="Submit">
    </form>

    <?php
    function sayHi($userName)
    {
        echo "Hello $userName";
    }

    $userName = $_POST["userName"] ?? null;

    if ($userName) {
        sayHi($userName);
    }


    ?>
</body>

</html>