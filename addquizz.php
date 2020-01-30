<?php

session_start();

$eid = $_GET['eid'];
$syear = $_GET['syear'];
$sid = $_GET['sid'];
$doe = $_GET['doe'];
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
	
if($_POST['question'] == "" || $_POST['o1'] == "" || $_POST['o2'] == "" || $_POST['o3'] == "" || $_POST['o4'] == ""){
	
	echo '<script type="text/javascript">

          window.onload = function () { alert("Fields cannot be left blank!"); }

</script>';
}
	
else {
	
$sql = "INSERT INTO quiz (eid,syear,sid, doe, question, o1, o2, o3, o4, ans, qt)
VALUES ('$eid','$syear','$sid','$doe','$_POST[question]','$_POST[o1]','$_POST[o2]','$_POST[o3]','$_POST[o4]','$_POST[year]','$_POST[min]')";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Question Added")</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}
}

if (isset($_POST['back'])){
	header("location: facultyhome.php");
	
	
}



if(isset($_POST['delete'])){


    $quizid = $_POST['quizid'];

$sql = "DELETE FROM quiz WHERE qid= '$quizid'";

if ($conn->query($sql) === TRUE) {
    echo '<script type="text/javascript">

          alert("Record deleted successfully!");
		
</script>';
} else {
    echo "Error deleting record: " . $conn->error;
}
}








$output = '';
if(isset($_POST["import"]))
{
	
	
 $fileName = explode(".", $_FILES['excel']['name']);
 $extension = end($fileName);
 
 $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
 if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
 {
  $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
  include("PHPExcel/Classes\PHPExcel\IOFactory.php"); // Add PHPExcel Library in this code
  $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file

  $output .= "<label class='text-success'>Data Inserted</label><br /><table class='table table-bordered'>";
  
  
  
  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
  {
   $highestRow = $worksheet->getHighestRow();
   for($row=1; $row<=$highestRow; $row++)
   {
    $output .= "<tr>";
    $question = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
    $o1 = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
	$o2 = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
	$o3 = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
	$o4 = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
	$ans = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
	$qt = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
	 
    $query = "INSERT INTO quiz(eid,syear,sid,doe,question,o1,o2,o3,o4,ans,qt) VALUES ('".$eid."', '".$syear."', '".$sid."', '".$doe."', '".$question."', '".$o1."', '".$o2."', '".$o3."', '".$o4."', '".$ans."', '".$qt."')";
    mysqli_query($conn, $query);
	 
   
    $output .= '</tr>';
   }
  } 
  echo '<script>alert("Questions in the Sheet Added Successfully")</script>';
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
                      
                        <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">Logout</a></li>
                    </ul>
            </div>
    </div>
    </nav>
    </div>
    <div class="highlight-clean" style="height: 48px;">
        <div class="container">
            <div class="intro">
			 <h6 class="text-center">Exam ID: <?php echo"$eid"; ?>&nbsp;&nbsp;Student Year:<?php echo"$syear"; ?>&nbsp;&nbsp;SubjectID: <?php echo"$sid"; ?><br> Date: <?php echo"$doe"; ?></h6>
                <h4 class="text-center">Set New Question</h4>
            </div>
            <div class="buttons"></div>
        </div>
    </div>
    <div class="contact-clean">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group"><input class="form-control" type="textarea" name="question" placeholder="Enter the Question Here"></div>
            <div class="form-group"><input class="form-control" type="text" name="o1" placeholder="Option 1"></div>
			<div class="form-group"><input class="form-control" type="text" name="o2" placeholder="Option 2"></div>
			<div class="form-group"><input class="form-control" type="text" name="o3" placeholder="Option 3"></div>
			<div class="form-group"><input class="form-control" type="text" name="o4" placeholder="Option 4"></div>
            <div class="form-group">
                <div class="dropdown">
				
				
						Choose Answer in option &nbsp&nbsp&nbsp
					<select name="year">
						<option value="1">Option 1</option>
						<option value="2">Option 2</option>
						<option value="3">Option 3</option>
						<option value="4">Option 4</option>
  
					</select>
				
				</div>
            </div>
			<div class="form-group">
                <div class="dropdown">
				
				
						Select Time Between Questions (In minutes) &nbsp&nbsp&nbsp
					<select name="min">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
  
					</select>
				
				</div>
            </div>
            
			<div class="form-group"><button class="btn btn-primary" type="submit" id="submit" name="submit">ADD Question</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" type="submit" id="submit" name="back">Back</button></div><br>
          
            <div class="form-group"><input type="file" name="excel" id="excel" accept=".xls,.xlsx">  &nbsp <button class="btn btn-primary" type="submit" name="import" id="import" >Import Questions</button></div>
        </form>
    </div>
	
	
	
	
	<div class="highlight-clean" style="height: 48px;">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Questions</h2>
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
                        <th>Question .No</th>
                        <th>Question</th>
                        <th>Delete Question</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
					$i = 1;
					$result = mysqli_query($conn,"SELECT * FROM quiz where eid = $eid");
					while($row = mysqli_fetch_array($result))
					{
						echo "<tr>";
						echo "<td>" . $i . "</td>";
						echo "<td>" . $row['question'] . "</td>";
						echo "<td>";
						$res1 = $row['qid'];
						$res2 = $row['eid'];
	
							
						 
						echo"</td>"; 
						echo "<td>";
	
							echo "<div class='btn-group' role='group'>";
							echo "<input type='hidden' name='quizid' value='$res1'  />";
							echo "<button class='btn btn-primary' type='submit' id='delete' name='delete'>Delete";
							echo "</button>";
							echo "</div>";
						
						 
						echo"</td>"; 
						echo "</tr>";
						$i = $i + 1;
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