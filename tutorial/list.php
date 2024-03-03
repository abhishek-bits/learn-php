<?php

/*
 * In PHP, list() is not a method, it is basically a language construct.
 */

/* 1.
 * Using list to initialize several variables each taking 
 * its separate value from array indexes.
 */

$prices = [100, 0.1];

list($buy_price, $tax) = $prices;

var_dump($buy_price, $tax);

echo "<br>";

/* 2.
 * Using list to skip an item (or some items) of an array
 * and assign the others to specific variable.
 */

$prices = [500, 0.1, 0.05];

list($buy_price,, $discount) = $prices; // skipped second item

echo "Buy price is $buy_price with discount of $discount.<br>";

/* 3.
 * Using nested list to assign value to varibles from
 * a multi-dimensional array.
 */
$elements = ['body', ['white', 'blue']];

list($element, list($bg_color, $color)) = $elements;

echo "$element: {<br>&nbsp;&nbsp;background-color: $bg_color,<br>&nbsp;&nbsp;color: $color<br>};<br>";

/* 4.
 * Using list construct to assign elements of an
 * associative array to variables.
 */
$person = [
    'first_name' => 'John',
    'last_name' => 'Doe',
    'age' => 25
];

list(
    'first_name' => $first_name,
    'last_name' => $last_name,
    'age' => $age
) = $person;

var_dump($first_name, $last_name, $age);
