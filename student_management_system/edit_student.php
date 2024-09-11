<?php
include "db.php";

if(isset($_POST['back'])){
    
    header("Location:viewstudent.php");
    exit();
}

class UpdateStudent{
    private $connection;

public function __construct() {
    $db = Database::getInstance();
    $this->connection = $db->connection;
    
}

public function update($id,$name,$email) {
   
    $stmt = $this->connection->prepare("UPDATE students SET name = ?, email = ? WHERE id = ?");
    if (!$stmt) {
        echo "Prepare failed: (" . $this->connection->errno . ") " . $this->connection->error;
    }

    $stmt->bind_param("ssi", $name, $email, $id);

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    } else {
        if ($stmt->affected_rows > 0) {
            echo "Student updated successfully.";
            header("Location:viewstudent.php");
        } else {
            echo "No changes made to the student record.";
        }
    }

    $stmt->close();
    $this->connection->close();
    exit(); // Stop further execution
}
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $update= new UpdateStudent($id,$name,$email);
    $message=$update->update($id,$name,$email);


   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
</head>
<link rel="stylesheet" href="style.css">
<body>
<div class="container">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
   
<label for="name">ID</label>
<input type="text" name="id" >
    
    <label for="name">Name</label>
    <input type="text" name="name" >
    
    <label for="email">Email</label>
    <input type="email" name="email" >

    <input type="submit" value="Update">

   
</form>
 <form action="" method="POST">
    <input type="submit" name="back" value="Back">

    </form>
</div>
</body>
</html>
