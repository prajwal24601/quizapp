<!DOCTYPE html>

<?php
session_start();

if (isset($_POST['submit'])){
	
if($_POST['sid'] == "" || $_POST['sname'] == "" || $_POST['semail'] == "" || $_POST['spwd'] == ""){
	
	echo '<script type="text/javascript">

          window.onload = function () { alert("Fields cannot be left blank!"); }

</script>';
}
	
else {
	
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

$sql = "INSERT INTO student (usn,name,year, email, pwd, access)
VALUES ('$_POST[sid]','$_POST[sname]','$_POST[year]','$_POST[semail]','$_POST[spwd]','2')";


$sql2 = "INSERT INTO login (email, pwd, access)
VALUES ('$_POST[semail]','$_POST[spwd]','2')";

if ($conn->query($sql2) === TRUE) {
   
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Student Added")</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}



$conn->close();
}
}




$output = '';
if(isset($_POST["import"]))
{
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
	
 $fileName = explode(".", $_FILES['excel']['name']);
 $extension = end($fileName);
 
 $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
 if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
 {
  $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
  include("PHPExcel/Classes\PHPExcel\IOFactory.php"); // Add PHPExcel Library in this code
  $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file

  $output .= "<label class='text-success'>Data Inserted</label><br /><table class='table table-bordered'>";
  
  
  $usn = "";
  $name = "";
  $year = 0;
  $email = "";
  $pwd = "";
  
  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
  {
   $highestRow = $worksheet->getHighestRow();
   for($row=1; $row<=$highestRow; $row++)
   {
    $output .= "<tr>";
    $usn = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
    $name = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
	 $year = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
	  $email = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
	   $pwd = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
	   $access = 2;
    $query = "INSERT INTO student(usn, name,year,email,pwd,access) VALUES ('".$usn."', '".$name."', '".$year."', '".$email."', '".$pwd."', '".$access."')";
    mysqli_query($conn, $query);
	
	$query2 = "INSERT INTO login(email,pwd,access) VALUES ('".$email."', '".$pwd."', '".$access."')";
    mysqli_query($conn, $query2);
	 
    $output .= '<td>'.$name.'</td>';
    $output .= '<td>'.$email.'</td>';
    $output .= '</tr>';
   }
  } 
  echo '<script>alert("Students in the Sheet Added Successfully")</script>';
  $output .= '</table>';

 }
 else
 {
  $output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
 }
}


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
                <h2 class="text-center">Add New Student</h2>
            </div>
            <div class="buttons"></div>
        </div>
    </div>
    <div class="contact-clean">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group"><input class="form-control" type="text" name="sid" placeholder="Student USN"></div>
            <div class="form-group"><input class="form-control" type="text" name="sname" placeholder="Name"></div>
            <div class="form-group">
                <div class="dropdown">
				
				
						Student Year &nbsp&nbsp&nbsp
					<select name="year">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
  
					</select>
				
				</div>
            </div>
            <div class="form-group"><input class="form-control is-invalid" type="email" name="semail" placeholder="Email"></div>
            <div class="form-group"><input class="form-control" type="password" name="spwd" placeholder="Password"></div>
			<div class="form-group"><button class="btn btn-primary" type="submit" id="submit" name="submit">ADD Student</button></div><br>
			
            <div class="form-group"><input type="file" name="excel" accept=".xls,.xlsx">  &nbsp <button class="btn btn-primary" type="submit" name="import" >Import</button></div>
            
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