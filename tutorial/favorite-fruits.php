<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <p>Choose your favorite fruits:</p>

    <form action="favorite-fruits.php" method="POST">
        Apple: <input type="checkbox" name="fruits[]" value="apple"><br>
        Grape: <input type="checkbox" name="fruits[]" value="grapes"><br>
        Mango: <input type="checkbox" name="fruits[]" value="mango"><br>
        <input type="submit">
    </form>

    <?php
    $fruits = $_POST["fruits"];
    echo $fruits[0];
    ?>

</body>

</html>