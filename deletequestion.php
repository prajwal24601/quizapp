<?php

session_start();


$qid = $_GET['qid'];

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



 $sql = "DELETE FROM quiz WHERE qid= '$qid'";

if ($conn->query($sql) === TRUE) {
    echo '<script type="text/javascript">

          alert("Student record deleted successfully!");
			window.location.href="addquizz.php";
</script>';
} else {
    echo "Error deleting record: " . $conn->error;
}

 

?>