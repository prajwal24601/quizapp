<?php

session_start();


$scode = $_GET['scode'];

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



 $sql = "DELETE FROM subject WHERE scode= '$scode'";
$sql1 = "DELETE FROM exam WHERE sid= '$scode'";
$sql2 = "DELETE FROM quiz WHERE sid= '$scode'";


if ($conn->query($sql2) === TRUE) {
    echo '<script type="text/javascript">
</script>';
} else {
    echo "Error deleting record: " . $conn->error;
}

if ($conn->query($sql1) === TRUE) {
    echo '<script type="text/javascript">
</script>';
} else {
    echo "Error deleting record: " . $conn->error;
}

if ($conn->query($sql) === TRUE) {
    echo '<script type="text/javascript">

          alert("Subject deleted successfully!");
			window.location.href="viewsubject.php";
</script>';
} else {
    echo "Error deleting record: " . $conn->error;
}

 

?>