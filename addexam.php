<!DOCTYPE html>
<html>
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


if (isset($_POST['submit'])){
	
if($_POST['eid'] == "" || $_POST['ename'] == "" || $_POST['faculty'] == "NONE" || $_POST['subject'] == "SELECT"){
	
	echo '<script type="text/javascript">

          window.onload = function () { alert("Fields cannot be left blank!"); }

</script>';
}
	
else {
	
$sql = mysqli_query($conn, "SELECT fid From faculty where name='$_POST[faculty]'");
while($row = mysqli_fetch_array($sql)){
	$res1 = $row['fid'];
}

$sql1 = mysqli_query($conn, "SELECT scode From subject where sname='$_POST[subject]'");
while($row = mysqli_fetch_array($sql1)){
	$res2 = $row['scode'];
}

$sql = "INSERT INTO exam (eid,ename,fid, syear, sid, dateofexam,flag)
VALUES ('$_POST[eid]','$_POST[ename]','$res1','$_POST[year]','$res2','$_POST[date1]','$0')";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Exam Added")</script>';
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}
}


?>
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
    <link rel="stylesheet" href="assets/css/styles.css">
	<link rel="stylesheet" href="assets/css/Footer-Clean.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
</head>

<body>
    <div>
        <nav class="navbar navbar-light navbar-expand-md navigation-clean">
            <div class="container"><a class="navbar-brand" href="adminhome.php"><img src="img/logo1.jpg" width="50" height="50">Kuiz it - Loggeed in As : <?php  echo " " . $_SESSION["logged"] . "."; ?></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link" href="fac.php">Faculty</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="stu.php">Student</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="exm.php">Exam</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="sub.php">Subject</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">Logout</a></li>
                    </ul>
            </div>
    </div>
    </nav>
    </div>
    <div class="highlight-clean" style="height: 48px;">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Add Exam</h2>
            </div>
            <div class="buttons"></div>
        </div>
    </div>
    <div class="contact-clean">
        <form method="post">
            <div class="form-group"><input class="form-control" type="text" name="eid" placeholder="Exam ID"></div>
            <div class="form-group"><input class="form-control" type="text" name="ename" placeholder="Exam Name"></div>
			
			<div class="form-group">
                <div class="dropdown">
				
				
						Select Subject &nbsp&nbsp&nbsp
					<select name="subject">
						<option value="pick">SELECT</option>
							<?php
							
							$sql = mysqli_query($conn, "SELECT sname From subject");
							$row = mysqli_num_rows($sql);
							while ($row = mysqli_fetch_array($sql)){
							echo "<option value='". $row['sname'] ."'>" .$row['sname'] ."</option>" ;
							}
							?>
  
					</select>
				
				</div>
            </div>
			
            <div class="form-group">
                <div class="dropdown">
				
				
						Choose Faculty &nbsp&nbsp&nbsp
					<select name="faculty">
						<option value="pick1">NONE</option>
							<?php
							$sql = mysqli_query($conn, "SELECT name From faculty");
							$row = mysqli_num_rows($sql);
							while ($row = mysqli_fetch_array($sql)){
							echo "<option value='". $row['name'] ."'>" .$row['name'] ."</option>" ;
							}
							?>
  
					</select>
				
				</div>
	
            </div>
            <div class="form-group">
                <div class="dropdown">
				
				
						Select Year of Students &nbsp&nbsp&nbsp
					<select name="year">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
  
					</select>
				
				</div>
            </div>
          
            <div class="form-group"><input class="form-control" type="date" name="date1"></div>
            <div class="form-group"><button class="btn btn-primary" type="submit" name="submit" style="background-color: #da0505;color: #ffffff;font-family: Bitter, serif;font-size: 20px;">Set Exam</button></div>
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