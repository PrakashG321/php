<?php

$server="localhost";
$username="root";
$password="";
$db_name="student_management_system";

$connection = new mysqli($server,$username,$password,$db_name);

if($connection->connect_error){
    die("failed to connect");
}






    
      
      
?>