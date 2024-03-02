<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Tutorial</title>
</head>
<body>
    
    <?php 
        echo("Hello World!");

        echo "<h1>Abhishek's Site!</h1>";
        echo "<hr>";
        echo "<p>This is my site.</p>";

        $characterName = "John";
        $characterAge = 28;
        echo "<ul>";
        echo "<li>There was a man named $characterName.</li>";
        echo "<li>He was $characterAge years old.</li>";
        $characterName = "Mike";
        echo "<li>He didn't like the name $characterName.</li>";
        echo "<li>He didn't like being $characterAge.</li>";
        echo "</ul>";
    ?>

</body>
</html>