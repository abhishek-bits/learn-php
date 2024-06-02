# Learning Notes

- The root folder will be `C:/Users/Abhishek Sharma`
- Variables in PHP are referred using the prefix sign `$`.

## Commands

| Command                 | Description                                                                           |
| ----------------------- | ------------------------------------------------------------------------------------- |
| `php -v`                | Check the current version of PHP.                                                     |
| `php -S localhost:4000` | Create a Web Server. This command should be run globally to have access to all files. |

## Data Types

### Strings

- Common functions include `strToUpper()`, `strToLower()`, `substr()`, `str_replace()`, etc.
- Strings in PHP are mutable. Indexed reference can be used to update characters.
- [PHP String Functions](https://www.php.net/manual/en/language.types.string.php)

### Numbers

- Either **Integer** or **Floating**.
- Common functions include `abs()`, `pow()`, `sqrt()`, `min()`, `max()`, `round()`, `ceil()`, `floor()`, etc.
- [PHP Math Functions](https://www.php.net/manual/en/ref.math.php)

### Boolean

- Either `true` or `false`.

**NOTE**: PHP does not print boolean type.

## Getting User Input

- For `GET` methods: `$_GET[<key>]`
- For `POST` methods: `$_POST[<key>]`

## Arrays

Syntax:

```php
$friends = array("Tim", "Pat", "Bunny");
```

- HTML form data for checkboxes, multi-selection can be stored in array.

## Associative Arrays

These are simply used to support key -> value pairs.

Syntax:

```php
$grades = array("Tim"=>"A+", "Pat"=>"B", "Bunny"=>"C+");
```

## Functions

Functions in PHP are declared using the keyword `function`.

Syntax:

```php
function sayHi($name, $age) {
    echo "Hello $name, your age is $age.<br>";
}
```

## `if`-`elseif`-`else`

```php
if(condition) {

} elseif(condition) {

} else {

}
```

## Include HTML

Let us say we want to include header and footer accross all of our pages. We can do as follows:

```php
<body>

    <?php include "header.html" ?>

    <p>Hello World!</p>

    <?php include "footer.html" ?>

</body>
```

## Include PHP

```php
<?php
    // Including PHP files is extrememly powerful tool.
    // It gives us the flexibility to intialize the variable
    // at one place and pass the same variable to multiple
    // PHP files.

    $title = "My First Post";
    $author = "Abhishek";
    $wordCount = 400;

    include "article-header.php";

    // We can also use the same functionality other way round.
    // We can have a PHP file that can act as utility or helper.
    // We can simply include and call those pre-written functionalities.

    include "useful-tools.php";

    sayHi("Abhishek");
?>
```

## Access Modifiers

- Public
- Private

## Declaring a constructor for a class

```php
class Student
{
    private string $name;
    private string $major;
    private float $gpa;

    function __construct(string $name, string $major, float $gpa)
    {
        $this->name = $name;
        $this->major = $major;
        $this->gpa = $gpa;
    }
}
```

## MySQL Connectivity

### Using `mysqli` extension

#### Prerequisite

| Step | Description                                                          |
| ---- | -------------------------------------------------------------------- |
| 1    | In the PHP directory, find `php.ini-development` file.               |
| 2    | Rename this file to `php.ini` and open in notepad.                   |
| 3    | Search for `extension_dir = "ext"` (for windows) and uncomment this. |
| 4    | Search for `extension=mysqli` and uncomment this.                    |
| 5    | Restart the PHP server.                                              |

**NOTE**: Uncommenting here means removing the first semicolon ';' in the same line.

#### Connecting to MySQL DB:

```php
$conn = new mysqli(<HOST_NAME>, <USER_NAME>, <PASSWORD>, <DATABASE>);
```

#### Fetching a SQL query result:

In case of an Insertion / Updation / Deletion query:

```php
$result = mysqli_query($conn, $sql);

if ($result) {
    // On successfull insertion / updation, redirect to specific page.
    header('location:user-list.php');
} else {
    // Show the error, what went wrong.
    die(mysqli_error($conn));
}
```

In case of a Select Query:

```php
$result = mysqli_query($conn, $sql);

if (!$result) {
    die(mysqli_error($conn));
}

// ...

if ($users) {
    // Loop over users result-set
    while ($row = mysqli_fetch_assoc($users)) {

        $id = $row['id'];
        $name = $row['name'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $password = $row['password'];

        // Code to populate this date in HTML.

    }
}
```

### Using `pdo_mysql` extension

#### Prerequisite

| Step | Description                                                          |
| ---- | -------------------------------------------------------------------- |
| 1    | In the PHP directory, find `php.ini-development` file.               |
| 2    | Rename this file to `php.ini` and open in notepad.                   |
| 3    | Search for `extension_dir = "ext"` (for windows) and uncomment this. |
| 4    | Search for `extension=pdo_mysql` and uncomment this.                 |
| 5    | Restart the PHP server.                                              |

#### Connecting to MySQL DB:

```php
try {
    $this->pdoConn = new PDO(
        "mysql:host=$this->host;dbname=$this->db",
        $this->user,
        $this->pass
    );
    $this->pdoConn->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
} catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}
```

#### Fetching a SQL query result:

In case of an Insertion / Updation / Deletion query:

```php
$db = DBConnect::getInstance();
$pdoConn = $db->getConnection();

$stmt = $pdoConn->prepare($sql);

$result = $stmt->execute([
    ':id' => $id
]);
```

In case of a Select Query:

```php
$db = DBConnect::getInstance();
$pdoConn = $db->getConnection();

$stmt = $pdoConn->prepare($sql);

$result = $stmt->execute();

if(!$result) {
    die();
}

// ...

if ($result) {
    // Loop over users result-set
     foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

        $id = $row['id'];
        $name = $row['name'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $password = $row['password'];

        // Code to populate this date in HTML.

    }
}
```

## Fetch API Response

Ref: [YouTube Tutorial](https://www.youtube.com/watch?v=wMyP-q3nPd4)

### Prerequisite

Open up `php.ini` file (as explained above) and uncomment the below:

- `extension=php_openssl`
- `extension=php_curl.dll`

For `cURL` approach:

- Download `cacert.pem` file from [curl.se](https://curl.se/docs/caextract.html) and place it in `/extras/ssl/` path within PHP installation folder.
- Copy this path for `cacert.pem` file and set the below keys in `php.ini` file:
  - `curl.cainfo`
  - `openssl.cafile`
- Uncomment the above keys in `php.ini` file.
- Restart the PHP server.

### Various approach to call API

#### `file-get-contents`

- By default it gives a GET request to the URL specified but we can modify the HTTP Method, Request headers and Request Body (payload) by using `stream_context_create()` method.
- The value returned by `file-get-contents()` method is the **body** of the API response.
- Simple to use (Part of Core-PHP so it doesn't require any extension).

**Disadvantages**:

1. In case the API is invalid or endpoint is not working, the `file_get_contents()` method will simply return false.However, the API Response will contain useful information which it does not provide that can otherwise help us debug the issue. If the Reponse code is not in the 200 range, then there is no way to achieve the response body.

2. Here, in order to add multiple request headers, we will have to concatenate all the header parameters separated by EOL characters like shown below. This is error-prone and is difficult to debug:

```php
$options = [
    "http" => [
        "method" => "PATCH",
        "header" => "Content-type: application/json; charset=UTF-8\r\n" .
                    "Accept-language: en",
        "content" => $payload
    ]
]
```

3. Using `file_get_contents()` methods to retrieve URLs requires the `allow_url_fopen` setting to be enabled on cheap shared hosting so on servers like that it wouldn't work.

#### `cURL`

- `cURL` is a PHP extension but there is no server which doesn't have this extension pre-installed.
- It is the most common method used when calling the API from PHP.

First we need to initialize the curl session using `curl_init()` function. This returns a handle to the cURL session.

We can either pass the URL we want to request as a parameter:

```php
$curlHandle = curl_init("https://jsonplaceholder.typicode.com/albums/1");
```

OR, we can also send it as an option. To set an option, we call the `curl_setopt()` function.

Ref: [curl-setopt](https://www.php.net/manual/en/function.curl-setopt.php)

```php
$curlHandle = curl_init();

curl_setopt($curlHandle, CURLOPT_URL, "https://jsonplaceholder.typicode.com/albums/1");
```

Now, we want the response to be returned as string instead of being output directly. We do this by using `CURLOPT_RETURNTRANSFER` option:

```php
curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
```

To execute this request, we now call the `curl_exec()` function by passing in the handle.

```php
$response = curl_exec($curlHandle);
```

Finally, we call the `curl_close()` method to close the handle.

```php
curl_close($curlHandle);
```

When using _cURL_ to set multiple options, there is an alternative way to set them which avoids calling `curl_setopt` multiple times. This is done using `curl_setopt_array()` method as shown:

```php
curl_setopt_array(
    $curlHandle,
    [
        CURLOPT_URL => "https://jsonplaceholder.typicode.com/albums/1",
        CURLOPT_RETURNTRANSFER => true
    ]
);
```

We can also change the Request headers in a similar manner. Let us now try to make a PATCH request to update the data similarly as we did before.

```php
$payload = json_encode([
    "title" => "Updated title"
]);
```

Notice here that now, we don't have to set any EOL characters to separate out the request headers.

```php
$headers = [
    "Content-type: application/json; charset=UTF-8",
    "Accept-language: en"
]
```

Each header is simply a string element of the `$headers` array.

```php
curl_setopt_array(
    $curlHandle,
    [
        CURLOPT_URL => "https://jsonplaceholder.typicode.com/albums/1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "PATCH", // sets the HTTP Request method.
        CURLOPT_POSTFIELDS => $payload, // sets the request body.
        CURLOPT_HTTPHEADER => $headers, // sets the Headers for this API request.
        CURLOPT_HEADER => true // if this is set to true then, all the response headers will be included in the response body.
    ]
);
```

**NOTE**: `POST` metho is set by default if we add a request body to the API request.

To get details about the response, we use the `curl_getinfo() ` function.

Ref: [curl-getinfo](https://www.php.net/manual/en/function.curl-getinfo.php)

For example, to check the response status code, we pass in the `CURLINFO_HTTP_CODE` option:

```php
$status_code = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
```

**Advantage**:

- Unlike `file_get_contents()` method, here, if the API is invalid or endpoint is down, then we will still see all the required data in the response body.

### Guzzle

- It is a popular PHP HTTP Client.
- It provides an easy-to-read object-oriented code.
- "Object-Oriented" alternative to `cURL` for accessing APIs.

To use this, first we need to install various package classes:

Ref: [Guzzle Installation](https://docs.guzzlephp.org/en/stable/overview.html#installation)

Now, to use Guzzle, we need to require various package classes.

```php
require __DIR__ . "/vendor/autoload.php";
```

Next, we need to create a Guzzle client object which is in the `GuzzleHttp` namespace.

```php
$client = new GuzzleHttp\Client();
```

Next, lets make a request to the API.

```php
$response = $client->request(
    "GET",
    "https://jsonplaceholder.typicode.com/albums/1"
);
```

To get the response-body we call the `getBody()` method of the `$response` object. Since, this method returns an object so we'll parse it to string.

```php
var_dump((string) $response->getBody());
```

Now, let's see how we can make the `PATCH` request with the Request Headers and Request Body:

First, we'll create the payload variable.

```php
$payload = json_encode([
    "title" => "Updated title.";
]);
```

Next, an array of headers. Unlike `cURL` headers in Guzzle are defined in an `associative-array` where, the key is a header-name and the value is the header-value as shown:

```php
$headers = [
    "Content-type" => "application/json; charset=UTF-8"
];
```

Next, we make changes to our request packet. Here, we instead call the `patch()` method whose first param is the URL and the second param is an `associative-array` containing the headers as the _headers_ key and request-body as the _body_ key.

```php
$response = $client->patch(
    "https://jsonplaceholder.typicode.com/albums/1",
    [
        "headers" => $headers,
        "body" => $payload
    ]
);
```

Again, to get the details of the request object, we call the `getStatusCode()` method of the `$response` object.

```php
var_dump($response->getStatusCode());
```

Response Headers can also be retrieved in a similar way.

We can either retrieve all response headers at once using `getHeaders()` method of the `$response` object:

```php
var_dump($response->getHeaders());
```

OR, we can retrieve a specific header using `getHeader()` method:

```php
var_dump($response->getHeader("Content-type"));
```

**Advantage**:

- Having request and response objects along with **clearly named methods** like these makes the code much more readable that `cURL` equivalent.
- Simple to use yet powerful providing methods for all aspects of the Request and Response.

**NOTE**: Using the `file_get_contents()` function, cURL and Guzzle, all use HTTP requests to access an API directly.

## Create RESTful API

Create a file `.htdocs` in the same working directory and add the following content:

```
RewriteEngine On
RewriteRule . index.php
```

The second line says that, no matter what URL is hit (specified by '.'), it will always load index.php script.

**NOTE**: These rules are only valid for apache and compatible web servers.

Create a directory `/src` where we shall keep all our source files.
