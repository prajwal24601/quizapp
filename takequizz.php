<!DOCTYPE html>

<?php
session_start();
$i = number_format($_SESSION['i']);
$j = number_format($_SESSION['aw']);

$eid = $_GET['eid'];
$sid = $_GET['sid'];
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

$sql = mysqli_query($conn, "SELECT usn,year From student where email='$_SESSION[logged]'");
while($row = mysqli_fetch_array($sql)){
	$usn = $row['usn'];
	$year1 = $row['year'];
}



$result = mysqli_query($conn,"SELECT * FROM exam where eid = $eid");
					while($row = mysqli_fetch_array($result))
					{
						$res1 = $row['eid'];
						$res2 = $row['sid'];
						$res3 = $row['fid'];
					}


/*if (isset($_POST["submit"])) {
	
	$eid = $_GET['eid'];
	
	
	header("location: addquizz.php?eid=$eid&syear=$syear&sid=$sid&doe=$doe");	
}*/




if (isset($_POST['submit'])){

 $i = $i + 1;
 $_SESSION["i"] = $i;
 $radioVal = $_POST["customRadio"];
 $answer = $_POST["custId"];
 if($radioVal == $answer)
 {
	 $j = $j + 1;
	 $_SESSION["aw"] = $j;
 }

}

?>
<script type="text/javascript">
var timeoutHandle;
function countdown(minutes) {
    var seconds = 60;

    function tick(qt) {
		
		a = minutes;
        var counter = document.getElementById("timer");
        var current_minutes = a - 1;
        seconds--;
        counter.innerHTML =
        current_minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
        if( seconds > 0 ) {
            timeoutHandle=setTimeout(tick, 1000);
        } else {
				
            if(mins > 1){

               // countdown(mins-1);   never reach “00″ issue solved:Contributed by Victor Streithorst
               setTimeout(function () { countdown(mins - 1); }, 1000);

            }
			
        }
    }
    tick();
}

countdown(qt);

</script>

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
    <link rel="stylesheet" href="assets/css/Brands.css">
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
</head>

<body>

	<div>
        <nav class="navbar navbar-light navbar-expand-md navigation-clean">
            <div class="container"><a class="navbar-brand" href="adminhome.php"><img src="img/logo1.jpg" width="50" height="50">Kuiz it - Loggeed in As : <?php  echo " " . $_SESSION["logged"] . "."; ?>&nbsp;&nbsp;&nbsp;USN:<?php echo"$usn"; ?>&nbsp;&nbsp;&nbsp;Subject Code: <?php echo"$sid"; ?></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">Exit Quiz</a></li>
                    </ul>
            </div>
    </div>
    </nav>
    </div>
	<div class="highlight-clean">
        <div class="container">
            <div class="intro">
                <h6 class="text-center">Exam ID:<?php echo"$eid"; ?></h6>
            </div>
        </div>
    </div>
	<form method="post" id="myForm">
	 <div class="brands"></div>

			<?php
					$result1 = mysqli_query($conn,"SELECT * FROM quiz where eid = $eid");
					$num = mysqli_num_rows ( $result1 );
					
					if ( $i < $num ){
					$result = mysqli_query($conn,"SELECT * FROM quiz where eid = $eid limit 1 offset $i");
					
					
					while($row = mysqli_fetch_array($result))
					{
						$question = $row['question'];
						$o1 = $row['o1'];
						$o2 = $row['o2'];
						$o3 = $row['o3'];
						$o4 = $row['o4'];
						$ans = $row['ans'];
						$qt = $row['qt'];
						$temp = $i + 1;	
				echo"<div class='container'>";
				echo"<div>";
					echo"<fieldset>";
					echo "<div id='timer'>$qt</div>";
						echo"<legend>$question $temp out of $num</legend> <br>";
						echo"<div class='custom-control custom-radio'><input type='radio' name='customRadio' checked='' id='customRadio1' class='custom-control-input' value='1'><label class='custom-control-label' for='customRadio1'>$o1</label></div>";
						echo"<div class='custom-control custom-radio'><input type='radio' name='customRadio' checked='' id='customRadio2' class='custom-control-input' value='2'><label class='custom-control-label' for='customRadio2'>$o2</label></div>";
						echo"<div class='custom-control custom-radio'><input type='radio' name='customRadio' checked='' id='customRadio3' class='custom-control-input' value='3'><label class='custom-control-label' for='customRadio3'>$o3</label></div>";
						echo"<div class='custom-control custom-radio'><input type='radio' name='customRadio' checked='' id='customRadio4' class='custom-control-input' value='4'><label class='custom-control-label' for='customRadio4'>$o4</label></div>";
						echo"<div class='custom-control custom-radio'><input type='radio' name='customRadio' checked='' id='customRadio5' class='custom-control-input' value='5'><label class='custom-control-label' for='customRadio5'>None</label></div>";
						echo"<input type='hidden' id='custId' name='custId' value='$ans'>";
					echo"</fieldset>";
					
					
					echo"<div class='form-group'><button class='btn btn-primary' type='submit' id='submit' name='submit'>Next</button>";
				echo"</div>";
			echo"</div>";
					echo '<script type="text/javascript">',
     'countdown('. $qt .');',
     '</script>';
					echo '<script type="text/javascript">',
     'tick("$qt");',
     '</script>';
					}	
				}
					else{
						
						   
							
							$sql = "INSERT INTO result (eid,fid, sid, syear, usn, i, j)
							VALUES ('$eid','$fid','$sid','$year1','$usn','$i','$j')";
							
							if ($conn->query($sql) === TRUE) {
							echo '<script>alert("Completed!")</script>';
	
								} else {
								echo "Error: " . $sql . "<br>" . $conn->error;
								}
							$sql1 = "INSERT INTO after (eid,usn)
							VALUES ('$eid','$usn')";
							
							if ($conn->query($sql1) === TRUE) {
							
	
								} else {
								echo "Error: " . $sql1 . "<br>" . $conn->error;
								}
							
							
							$_SESSION["i"] = 0;
							$_SESSION["aw"] = 0;
							echo " <div class='highlight-clean'>";
							echo "<div class='container'>";
							echo "<h4 class='text-center'>You have scored : $j</h4>";
							echo "<div class='buttons'><a class='btn btn-light' role='button' href='studenthome.php'>Home</a></div>";
							echo "</div>";
							echo "</div> ";
						
					}
			?>
		</form>			
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>