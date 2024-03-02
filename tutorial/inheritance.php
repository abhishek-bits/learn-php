<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    class Chef
    {
        function makeBurger()
        {
            echo "Burger cooking...<br>";
        }
        function makeSpecialBurger()
        {
            echo "Special burger cooking...<br>";
        }
    }

    class ItalianChef extends Chef
    {
        function makePasta()
        {
            echo "Pasta cooking...<br>";
        }
        // Overriding special burger functionality
        function makeSpecialBurger()
        {
            echo "Special Italian burger cooking...<br>";
        }
    }

    $chef = new Chef();
    $italianChef = new ItalianChef();

    $chef->makeBurger();
    $italianChef->makeBurger();

    $chef->makeSpecialBurger();
    $italianChef->makeSpecialBurger();

    $italianChef->makePasta();

    ?>
</body>

</html>