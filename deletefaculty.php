<?php

session_start();


$fid = $_GET['fid'];

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



 $sql = "DELETE FROM faculty WHERE fid= $fid";
$sql1 = "DELETE FROM exam WHERE fid= '$fid'";


if ($conn->query($sql1) === TRUE) {
    echo '<script type="text/javascript">
</script>';
} else {
    echo "Error deleting record: " . $conn->error;
}
if ($conn->query($sql) === TRUE) {
    echo '<script type="text/javascript">

          alert("Faculty record deleted successfully!");
			window.location.href="viewfaculty.php";
</script>';
} else {
    echo "Error deleting record: " . $conn->error;
}



?>