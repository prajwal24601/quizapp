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

$sql = mysqli_query($conn, "SELECT usn,year From student where email='$_SESSION[logged]'");
while($row = mysqli_fetch_array($sql)){
	$usn = $row['usn'];
	$year1 = $row['year'];
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
                <h2 class="text-center">List Of Exams Assigned</h2>
            </div>
            <div class="buttons"></div>
        </div>
    </div>
	

	<?php
					$result = mysqli_query($conn,"SELECT * FROM exam where syear = $year1");
					while($row = mysqli_fetch_array($result))
					{
						$res1 = $row['eid'];
						$res2 = $row['sid'];
						$res3 = $row['dateofexam'];
						$res5 = $row['fid'];
						$result1 = mysqli_query($conn,"SELECT * FROM subject where scode = '$res2'");
						while($row1 = mysqli_fetch_array($result1))
						{
							$res4 = $row1['sname'];
						}
						$ff = 0;
						
						$result4 = mysqli_query($conn,"SELECT * FROM after where eid = '$res1' and usn = '$usn'");
						while($row2 = mysqli_fetch_array($result4))
						{
							$res8 = $row2['eid'];
							$res9 = $row2['usn'];
							
							if ( $res8 === $res1 && $res9 === $usn){
								
								$ff = 1;
							}
							
						}
						
						echo " <div class='highlight-clean'>";
						echo "<div class='container'>";
								echo "	<div class='intro'>";
										echo "<h4 class='text-center'>Exam ID : $res1</h4>";
										echo "<p class='text-center'>Subject Code : $res2</p>";
										echo "<p class='text-center'>Subject Name : $res4</p>";
										
									echo "</div>";
									if($ff === 1){
										echo "<div class='buttons'><a class='btn btn-light' role='button'>You have already taken this quiz</a></div>";
									}
									else{
									 $_SESSION["i"] = 0;
									 $_SESSION["aw"] = 0;
								  echo "<div class='buttons'><a class='btn btn-light' role='button' href='takequizz.php?eid=$res1&sid=$res2&fid=$res5'>Take up the Quizz!</a></div>";
									}
								echo "</div>";
							   echo "</div> ";
					}
	?>
	
	
	
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