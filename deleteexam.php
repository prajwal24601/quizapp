<?php

session_start();


$eid = $_GET['eid'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quizapp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



 $sql = "DELETE FROM exam WHERE eid= '$eid'";
$sql2 = "DELETE FROM quiz WHERE eid= '$eid'";


if ($conn->query($sql2) === TRUE) {
    echo '<script type="text/javascript">
</script>';
} else {
    echo "Error deleting record: " . $conn->error;
}
if ($conn->query($sql) === TRUE) {
    echo '<script type="text/javascript">

          alert("Student record deleted successfully!");
			window.location.href="viewexam.php";
</script>';
} else {
    echo "Error deleting record: " . $conn->error;
}

 

?>