<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
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

        function hasHonors()
        {
            return $this->gpa >= 3.5 ? true : false;
        }

        function getName()
        {
            return $this->name;
        }
        function setName(string $name)
        {
            $this->name = $name;
        }
        function getMajor()
        {
            return $this->major;
        }
        function setMajor(string $major)
        {
            $this->major = $major;
        }
        function getGpa()
        {
            return $this->gpa;
        }
        function setGpa(float $gpa)
        {
            // Setters help avoid any invalid update to the property.
            if ($gpa < 0.0 || $gpa > 4.0) {
                return;
            }
            $this->gpa = $gpa;
        }
    }

    $student1 = new Student("Abhishek", "Computer Science", 2.8);
    $student2 = new Student("Arushi", "Computer Science", 3.6);

    echo $student1->hasHonors() ? "Yes" : "No";
    echo $student2->hasHonors() ? "Yes" : "No";

    echo $student1->getGpa();

    $student1->setGpa(5.6);

    echo $student1->getGpa();

    $student1->setGpa(3.1);

    echo $student1->getGpa();

    ?>

</body>

</html>