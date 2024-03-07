<?php

class ProductController
{
    // We'll use Dependency Injection to inject
    // the Repository class for the Product
    public function __construct(private ProductRepository $productRepository)
    {
    }

    // We can process a request based on:
    // 1. HTTP Method.
    // 2. id (which is nullable)
    public function processRequest(string $method, ?string $id): void
    {
        // var_dump($method, $id);

        if ($id) {
            // If id is present in the URI then this is
            // basically a single resource request.
            $this->processResourceRequest($method, $id);
        } else {
            // If id is not present in the URI then this is
            // a request for a group of resources.
            $this->processCollectionRequest($method);
        }
    }

    private function processResourceRequest(string $method, string $id): void
    {
        $product = $this->productRepository->get($id);

        if (!$product) {
            http_response_code(404);
            echo json_encode([
                "message" => "Product not found."
            ]);
            return;
        }

        switch ($method) {
            case "GET":
                http_response_code(200);
                echo json_encode($product);
                break;

            case "PATCH":
                $data = (array) json_decode(
                    file_get_contents("php://input"),
                    true
                );

                $errors = $this->getValidationErrors($data, false);

                if (!empty($errors)) {
                    // Set the HTTP Response code (422 means unprocessable entity).
                    http_response_code(422);
                    // Show the validation errors to the client.
                    echo json_encode(["errors" => $errors]);
                    // Break out of the case block.
                    break;
                }

                $rows = $this->productRepository->update($product, $data);

                // Set the correct HTTP Response Code
                http_response_code(200);

                echo json_encode([
                    "message" => "Product $id updated.",
                    "rows" =>  $rows
                ]);

                break;

            case "DELETE":
                $rows = $this->productRepository->delete($id);

                http_response_code(200);

                echo json_encode([
                    "message" => "Product $id deleted.",
                    "rows" =>  $rows
                ]);

                break;

            default:
                http_response_code(405);
                header("Allow: GET, PATCH, DELETE");
                break;
        }
    }

    private function processCollectionRequest(string $method): void
    {
        switch ($method) {
            case "GET":
                echo json_encode($this->productRepository->findAll());
                break;

            case "POST":
                /*
                 * In PHP, we can get JSON data from the request
                 * directly from the PHP input stream.
                 */
                $data = file_get_contents("php://input");

                /*
                 * But in PHP, we require an associate array to
                 * read the key->value pairs thus we decode the json.
                 */

                // $data = json_decode($data, true);

                /* Now, the problem here is that:
                 *
                 * If we don't provide any data in the payload of the POST request,
                 * then the json_decode() will return NULL, we can make the API 
                 * more robust and handle this possibility, we do as follows:
                 * 
                 * Solution: To cast the value returned by json_decode() to an array
                 * 1. If the value returned by json_decode() is already an array,
                 * then nothing happens.
                 * 2. If the value returned by json_decode() is NULL then it will be
                 * converted to an empty array.
                 */

                $data = (array) json_decode($data, true);

                // var_dump($data);

                /*
                 * NOTE:
                 * If the $data is an empty error, then we must not
                 * give a call to the repository create method.
                 */
                $errors = $this->getValidationErrors($data);

                if (!empty($errors)) {
                    // Set the HTTP Response code (422 means unprocessable entity).
                    http_response_code(422);
                    // Show the validation errors to the client.
                    echo json_encode(["errors" => $errors]);
                    // Break out of the case block.
                    break;
                }

                $id = $this->productRepository->create($data);

                // Set the correct HTTP Response Code
                http_response_code(201);

                echo json_encode([
                    "message" => "Product created.",
                    "id" =>  $id
                ]);

                break;

            default:
                // Other HTTP Methods are not allowed.
                http_response_code(405);
                // We'll also specify the methods allowed in this end-point.
                // We'll set this in the header of the API response payload.
                header("Allow: GET, POST");
                break;
        }
    }

    private function getValidationErrors(array $data, bool $is_new = true): array
    {
        $errors = [];

        // Ref: https://www.php.net/manual/en/function.empty.php
        // empty($var) is consice equivalent to !isset($var) || $var == false
        if ($is_new && empty($data["name"])) {
            $errors[] = "Name is Required";
        }
        if (array_key_exists("size", $data)) {
            // filter_var() helps parsing the given data into the required format (here integer)
            // Suppose if "size": "12345" then, this validation is success because when the value
            // is parsed to integer it gives 12345 which is an integer value.
            // But if "size": "abcdef" then, this validation is failure because it is not possible
            // to parse this value to integer type; thus filter_val will return false.
            if (filter_var($data["size"], FILTER_VALIDATE_INT) == false) {
                $errors[] = "Size should be integer";
            }
        }

        return $errors;
    }
}
