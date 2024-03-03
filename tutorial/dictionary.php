<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="dictionary.php" method="POST">
        <input type="text" name="studentName">
        <input type="submit" value="Submit">
    </form>

    <?php

    // Keys in a dictionary should always be unique.

    // Let us store grades of student for a specific subject.
    $grades = array("Jim" => "A+", "Pam" => "B-", "Oscar" => "C+");
    // echo $grades["Jim"];

    // Updates in dictioary are possible.
    $grades["Jim"] = "A-";

    // echo $grades["Jim"];

    $studentName = $_POST["studentName"] ?? null;
    if (isset($studentName)) {
        echo $grades[$studentName];
    }

    // Checking if a key exists in the array or not
    var_dump(array_key_exists('Jim', $grades));
    var_dump(array_key_exists('Pam', $grades));
    var_dump(array_key_exists('Bot', $grades));

    ?>

</body>

</html>