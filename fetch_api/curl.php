<?php

// $curlHandle = curl_init("https://jsonplaceholder.typicode.com/albums/1");

try {
    $curlHandle = curl_init();

    if ($curlHandle == false) {
        throw new Exception('failed to initialize');
    }

    // Better to explicitly set URL
    curl_setopt($curlHandle, CURLOPT_URL, "https://jsonplaceholder.typicode.com/albums/1");

    $response = curl_exec($curlHandle);

    if ($response == false) {
        throw new Exception(curl_error($curlHandle), curl_errno($curlHandle));
    }

    // Check HTTP return code
    $httpReturnCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);

    var_dump($httpReturnCode);

    var_dump($response);

    curl_close($curlHandle);
} catch (Exception $e) {
    trigger_error(sprintf(
        'Curl failed with error #%d: %s',
        $e->getCode(),
        $e->getMessage()
    ), E_USER_ERROR);
} finally {
    // Close curl handle unless it failed to initialize
    if (is_resource($curlHandle)) {
        curl_close($curlHandle);
    }
}
