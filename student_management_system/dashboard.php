<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location:index.php");
    exit();
}

if(isset($_POST['logout'])){
    session_destroy();
    header("Location:index.php");
    exit();
}

include "db.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

    <div class="container">
    
    <a href="viewstudent.php">View Student</a>
    <a href="addStudent.php">Add Student</a>

    
    <form action="" method="POST">
    <input type="submit" name="logout" value="logout">

    </form>

    </div>
</body>
</html>