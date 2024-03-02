<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    // Including PHP files is extrememly powerful tool.
    // It gives us the flexibility to intialize the variable
    // at one place and pass the same variable to multiple
    // PHP files.

    $title = "My First Post";
    $author = "Abhishek";
    $wordCount = 400;

    include "article-header.php";

    // We can also use the same functionality other way round.
    // We can have a PHP file that can act as utility or helper.
    // We can simply include and call those pre-written functionalities.

    include "useful-tools.php";

    sayHi("Abhishek");

    ?>

</body>

</html>