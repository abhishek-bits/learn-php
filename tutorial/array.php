<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    $friends = array("Kevin", "Karen", "Oscar", "Jim");
    echo $friends[0];
    echo $friends[1];
    $friends[1] = "Dwight";
    echo $friends[1];
    $friends[1] = 400; // works
    echo $friends[1];

    // Adding a new item at an index
    $friends[5] = "Angela";
    echo $friends[5]; // works

    echo count($friends); // number of items in the array.
    ?>

</body>

</html>