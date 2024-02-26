<?php

/*
 * Just calling file_get_contents like this with a URL,
 * will send a GET request to the API.
 */
// $data = file_get_contents(
//     "https://jsonplaceholder.typicode.com/albums/1",
//     false
// );

/*
 * If we need to modify the method e.g. change the method,
 * add some headers or put some data in the body, 
 * we can achieve this by creating a stream.
 * This is done using steam_context_create() function.
 */

// json_encode will return a JSON for the given param.
$payload = json_encode(["title" => "Updated title"]);

// here we are adding the data to be sent to the API.
$options = [
    "http" => [
        "method" => "PATCH",
        "header" => "Content-type: application/json; charset=UTF-8",
        "content" => $payload
    ]
];

// create the stream of this data
$context = stream_context_create($options);

$data = file_get_contents(
    "https://jsonplaceholder.typicode.com/albums/1",
    false,
    $context
);

var_dump($data);

// The variable $http_response_header is created automatically
// when we call the file_get_contents() method.
// It contains all the API Response data like
// the Response code and associated headers.
print_r($http_response_header);
