<?php

include "db.php";


session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
$username=$_POST["username"];
$password=$_POST["password"];



$stmt = $connection->prepare("SELECT * FROM users WHERE username = ?");

if(!$stmt){
    die($connection->errno);
}
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $hashedPassword = $user['password'];

        // Verify password
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['username'] = $username;
            echo "Here is your dashboard";
            header("Location:dashboard.php");
        } else {
            echo "Sorry, password dont match";
        }
    } else {
        echo "Sorry, you were not able to access it";
    }

    $stmt->close();
    $connection->close();




}







?>