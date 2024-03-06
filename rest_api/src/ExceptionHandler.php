<?php

class ExceptionHandler
{
    public static function handleException(Throwable $exception): void
    {
        // First, set the HTTP Status Code.
        http_response_code(500);
        // Next, convert the file to JSON.
        echo json_encode([
            "code" => $exception->getCode(),        // error-code
            "message" => $exception->getMessage(),  // error-message
            "file" => $exception->getFile(),        // file name where this exception occurred.
            "line" => $exception->getLine()         // line number in that file that created this exception.
        ]);
    }
}
