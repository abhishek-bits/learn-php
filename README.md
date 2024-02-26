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

### Prerequisite

| Step | Description                                                          |
| ---- | -------------------------------------------------------------------- |
| 1    | In the PHP directory, find `php.ini-development` file.               |
| 2    | Rename this file to `php.ini` and open in notepad.                   |
| 3    | Search for `extension_dir = "ext"` (for windows) and uncomment this. |
| 4    | Search for `extension=mysqli` and uncomment this.                    |
| 5    | Restart the PHP server.                                              |

**NOTE**: Uncommenting here means removing the first semicolon ';' in the same line.

### Connecting to MySQL DB:

```php
$conn = new mysqli(<HOST_NAME>, <USER_NAME>, <PASSWORD>, <DATABASE>);
```

### Fetching a SQL query result:

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
