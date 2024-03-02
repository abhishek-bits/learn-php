<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Input</title>
</head>

<body>

    <form action="user-input.php" method="GET">
        <div>
            <label for="userName">Name: </label>
            <input type="text" name="userName">
        </div>
        <div>
            <label for="userAge">Age:</label>
            <input type="text" name="userAge">
        </div>
        <div>
            <input type="submit" value="Submit">
        </div>
    </form>

    <div>
        <p>Your name is: <?php echo $_GET["userName"]; ?></p>
        <p>You are <?php echo $_GET["userAge"]; ?> years old.</p>
    </div>

</body>

</html>