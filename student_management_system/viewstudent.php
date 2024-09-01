<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location:index.php");
    exit();
}


if(isset($_POST['back'])){
    
    header("Location:dashboard.php");
    exit();
}

include "db.php";

$sql="SELECT * FROM Students";
$result= $connection->query($sql);

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

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        
    </tr>
 
    <?php while($row=$result->fetch_assoc()){?>
<tr>
<td> <?php echo htmlspecialchars($row['id']) ?> </td>
<td> <?php echo htmlspecialchars($row['name']) ?> </td>
<td> <?php echo htmlspecialchars($row['email']) ?> </td>



</tr>

<?php  } ?>

</table>
<a href="edit_student.php">Edit</a>
<a href="delete_student.php">Delete</a>

<form action="" method="POST">
    <input type="submit" name="back" value="Back">

    </form>
</div>
</body>
</html>