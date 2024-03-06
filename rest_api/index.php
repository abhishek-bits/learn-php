<?php

/* NOTE:-
 * index.php is the default file in the PHP directory
 * Hence, we do not have to specify in the URL
 */

// As, we are using type-declarations,
// we need to enable strict_types at the top of the script.
// declare(strict_type=1);

// This method is used to provide import for all our files
// from a single directory 'src'
spl_autoload_register(function ($class) {
    require __DIR__ . "/src/$class.php";
});

// This method is used to set the exception handler.
set_exception_handler("ExceptionHandler::handleException");

// This is required to set the Content-type header to JSON
// which by default is set to text.
header("Content-type: application/json; charset=UTF-8");

// Print the URL that client requested.
// var_dump($_SERVER["REQUEST_URI"]); // /php/rest_api/index.php OR /php/rest_api

// explode method is used to split a string
// by a given string.
$parts = explode("/", $_SERVER["REQUEST_URI"]);

// print_r($parts);

// Now, we shall route our requests based on
// the REST standard rules.
if ($parts[3] != "products") {
    http_response_code(404);
    return;
}

$id = $parts[4] ?? null;

// var_dump($id);

$productRepository = ProductRepository::getInstance();

$controller = new ProductController($productRepository);

$controller->processRequest(
    $_SERVER["REQUEST_METHOD"],
    $id,
);
