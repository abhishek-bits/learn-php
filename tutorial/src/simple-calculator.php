<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calculator in PHP</title>
</head>

<body>

    <form action="simple-calculator.php" method="GET">
        <div>
            <label for="num1">Num 1: </label>
            <input type="number" name="num1" step="0.00000001" id="" required>
        </div>
        <div>
            <label for="num2">Num 2: </label>
            <input type="number" name="num2" step="0.00000001" id="" required>
        </div>
        <div>
            <label for="operation">Operation: </label>
            <select name="operation" id="" required>
                <option value="Add">Addition</option>
                <option value="Sub">Subtract</option>
                <option value="Mul">Multiply</option>
                <option value="Div">Division</option>
                <option value="Mod">Modulus</option>
                <option value="Exp">Exponent</option>
            </select>
        </div>
        <div>
            <input type="submit" value="Submit">
        </div>
    </form>

    <?php
    function myExp($num1, $num2)
    {
        return pow($num1, $num2);
    }

    $num1 = $_GET["num1"] ?? null;
    $num2 = $_GET["num2"] ?? null;
    $opr = $_GET["operation"] ?? null;
    $res = null;
    switch ($opr) {
        case "Add":
            $res = $num1 + $num2;
            break;
        case "Sub":
            $res = $num1 - $num2;
            break;
        case "Mul":
            $res = $num1 * $num2;
            break;
        case "Div":
            $res = $num1 / $num2;
            break;
        case "Mod":
            $res = $num1 % $num2;
            break;
        case "Exp":
            $res = myExp($num1, $num2);
            break;
    }

    if ($res) {
        echo "Result = $res";
    }
    ?>

</body>

</html>