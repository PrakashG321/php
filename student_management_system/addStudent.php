<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location:index.php");
    exit();
}

if(isset($_POST['back'])){
    
    header("Location:viewstudent.php");
    exit();
}


include "db.php";


if($_SERVER["REQUEST_METHOD"]=="POST"){
 $name=htmlspecialchars($_POST['name']);
 $email=htmlspecialchars($_POST['email']);
 
 

 $stmt= $connection->prepare("INSERT INTO students (name, email) VALUES (?,?)");

 if($stmt){

    $stmt->bind_param('ss',$name,$email);

    if($stmt->execute()){
        echo "student added succesfully";
        header("Location:viewstudent.php");
     }else{
        echo "student not added ".$sql.$connection->error;
     }

 }
}


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
    <form action="" method="POST">

<label for="name">Name</label>
<input type="text" name="name">

<label for="email">Email</label>
<input type="email" name="email">

<input type="submit" value="Add Student">



    </form>
    <form action="" method="POST">
    <input type="submit" name="back" value="Back">

    </form>
    </div>
</body>
</html>

