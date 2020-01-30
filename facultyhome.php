<!DOCTYPE html>

<?php
session_start();
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

$sql = mysqli_query($conn, "SELECT fid From faculty where email='$_SESSION[logged]'");
while($row = mysqli_fetch_array($sql)){
	$facid = $row['fid'];
}

/*if (isset($_POST["submit"])) {
	
	$eid = $_GET['eid'];
	
	
	header("location: addquizz.php?eid=$eid&syear=$syear&sid=$sid&doe=$doe");	
}*/


?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>kuizapp</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Header-Blue.css">
    <link rel="stylesheet" href="assets/css/Header-Dark.css">
    <link rel="stylesheet" href="assets/css/Highlight-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css"><link rel="stylesheet" href="assets/css/Footer-Clean.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
</head>

<body>
    <div>
        <nav class="navbar navbar-light navbar-expand-md navigation-clean">
            <div class="container"><a class="navbar-brand" href="adminhome.php"><img src="img/logo1.jpg" width="50" height="50">Kuiz it - Loggeed in As : <?php  echo " " . $_SESSION["logged"] . "."; ?></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">Logout</a></li>
                    </ul>
            </div>
    </div>
    </nav>
    </div>
    <div class="highlight-clean" style="height: 48px;">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Set of Quizzes</h2>
            </div>
            <div class="buttons"></div>
        </div>
    </div>
    <div class="container">
	<form method="post">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Exam ID&nbsp;</th>
                        <th>Name</th>
                        <th>Year Of Students</th>
                        <th>Subject ID</th>
						<th>Date of Quizz</th>
						<th>Add questions</th>
						<th>View Result</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
					$result = mysqli_query($conn,"SELECT * FROM exam where fid = $facid");
					while($row = mysqli_fetch_array($result))
					{
						echo "<tr>";
						echo "<td>" . $row['eid'] . "</td>";
						echo "<td>" . $row['ename'] . "</td>";
						echo "<td>" . $row['syear'] . "</td>";
						echo "<td>" . $row['sid'] . "</td>";
						echo "<td>" . $row['dateofexam'] . "</td>";
						echo "<td>";
						$res1 = $row['flag'];
						$res2 = $row['eid'];
						$res3 = $row['syear'];
						$res4 = $row['sid'];
						$res5 = $row['dateofexam'];
						
						
				
							echo "<div class='btn-group' role='group'>";
							echo "<a href='addquizz.php?eid=$res2&syear=$res3&sid=$res4&doe=$res5'>Set Questions</a>";
							//echo "<button class='btn btn-primary' type='submit' name = 'submit'>Set up Questions";
							echo "</button>";
							echo "</div>";
						
						echo"</td>"; 
						echo "<td>";
					
	
							echo "<div class='btn-group' role='group'>";
							echo "<a href='viewresult.php?eid=$res2'>View Result</a>";
							//echo "<button class='btn btn-primary' type='submit' name = 'submit'>Set up Questions";
							echo "</button>";
							echo "</div>";

						echo"</td>"; 
						echo "</tr>";
					}
					

				?>
                </tbody>
            </table>
        </div>
		</form>
    </div>
	<br>
	<br>
	<br><br><br><br><br><br><br><br>
	<div class="footer-clean">
        <footer>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Team</h3>
                        <ul>
                            <li><a href="#">Prajwal M P</a></li>
                            <li><a href="#">Prajna S Rao</a></li>                      
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Technologies Used</h3>
                        <ul>
                            <li><a href="#">PHP</a></li>
                            <li><a href="#">Bootstrap Studio</a></li>
                            <li><a href="#">MySql</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Contact Us</h3>
                        <ul>
                            <li><a href="#">Email : pmp24601@gmail.com</a></li>
                            <li><a href="#">9900806532</a></li>
                            <li><a href="#">8095457450</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 item social"><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a>
                        <p class="copyright">KUIZ IT © 2019</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>