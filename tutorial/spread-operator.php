<?php

/* 1. 
 * PHP spread operator is a language construct,
 * hence it is more efficient than the array_merge() method.
 */
$arr1 = [1, 2, 3];
$arr2 = ["abc", "def"];
$all = [...$arr1, ...$arr2];

var_dump($all);

echo '<br>';

/* 2.
 * PHP spread operator can also be used for functions
 * that return an array.
 */
function get_random_numbers(): array
{
    for ($i = 1; $i <= 5; $i++) {
        $random_numbers[] = rand(1, 100);
    }
    return $random_numbers;
}
$random_numbers = [...get_random_numbers()];
var_dump($random_numbers);

echo '<br>';

/* 3.
 * PHP spread operator can be used in generator functions.
 */
function is_prime($num): bool
{
    for ($i = 2; $i * $i <= $num; $i++) {
        if ($num % $i == 0) {
            return false;
        }
    }
    return true;
}
// Generator function for Prime numbers
// NOTE: Generator function uses 'yield' method
function gen_prime_number()
{
    for ($i = 1; $i < 100; $i++) {
        if (is_prime($i)) {
            yield $i; // yield will create an associate array.
        }
    }
}
// Using generator functions is acually a memory efficient
// and time efficient approach as here as soon as the first
// entry is created using yield, it is immediately read
// by the caller unlike traditional method based approach
// where we wait for the complete data to be available 
// before we can pass it to other parts of the program.
echo 'List of first 100 prime numbers: ';
foreach (gen_prime_number() as $key => $val) {
    echo $val . ' ';
}

echo '<br>';

/* 4. 
 * Using PHP spread operator over an object that implements Traversable.
 */
class RGB implements IteratorAggregate
{
    private $colors = ['red', 'green', 'blue'];

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->colors);
    }
}
$rgb = new RGB();

$colors = [...$rgb];

foreach ($rgb as $key => $val) {
    echo $val . ' ';
}

echo '<br>';

/* 5.
 * Spread operators and the named arguments in PHP.
 */
function format_name(string $first, string $middle, string $last): string
{
    return $middle ? "$first $middle $last" : "$first $last";
}
$names = [
    'first' => 'Abhishek',
    'middle' => 'Mamta',
    'last' => 'Sharma'
];
echo format_name(...$names);
