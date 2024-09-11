<?php
include "db.php";


if(isset($_POST['back'])){
    
    header("Location:viewstudent.php");
    exit();
}

class DeleteStudent{
private $connection;

public function __construct() {
    $db = Database::getInstance();
    $this->connection = $db->connection;
    
}

public function delete($id) {
   
$stmt = $this->connection->prepare("DELETE FROM students  WHERE id = ?");
if (!$stmt) {
    echo "Prepare failed: (" . $this->connection->errno . ") " . $this->connection->error;
}

$stmt->bind_param("i", $id);

if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
} else {
    if ($stmt->affected_rows > 0) {
        echo "Student Deleted successfully.";
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
$delete = new DeleteStudent($id);
$message=$delete->delete($id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
   
<label for="name">ID</label>
<input type="text" name="id" >

<input type="submit" value="Delete">


</form>
 <form action="" method="POST">
    <input type="submit" name="back" value="Back">

    </form>
</div>
</body>
</html>
