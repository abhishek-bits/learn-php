<?php

class ErrorHandler
{
    /*
     * This method is added to catch custom errors.
     * NOTE: arguments should match as the ones mentioned in:
     * https://www.php.net/manual/en/function.set-error-handler.php
     */
    public static function handle(
        int $errno,
        string $errstr,
        string $errfile,
        int $errline
    ): bool {
        // Here, we can simply throw a new exception
        // of the ErrorException class which was designed to
        // handle errors as exceptions.
        throw new ErrorException(
            $errstr,
            0,          // We don't consider the code yet.
            $errno,
            $errfile,
            $errline
        );
    }
}
