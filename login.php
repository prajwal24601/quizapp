<!DOCTYPE html>


<?php
   
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
   
   if (isset($_POST["submit"])) {
      // username and password sent from form 
	  
	  
	  
	    $email = $_POST["email"];
		$pass = $_POST["password"];

	  
      
		$sql = mysqli_query($conn, "SELECT * From login where email='$_POST[email]'");
		while($row = mysqli_fetch_array($sql)){
		$res1 = $row['email'];
		$res2 = $row['pwd'];
		$res3 = $row['access'];
		
		}

		if($res1==$email && $res2==$pass){
			if($res3 == 3){
				
			session_start();
			$_SESSION["logged"] = $email;
			header("location: fac.php");
			}
			if($res3 == 1){
				
			session_start();
			$_SESSION["logged"] = $email;
			header("location: facultyhome.php");
			}
			if($res3 == 2){
				
			session_start();
			$_SESSION["logged"] = $email;
			header("location: studenthome.php");
			}
			
		}	
		else
			echo"Sorry, your credentials are not valid, Please try again.";
	  
	  
	  
      
     /* $email = mysqli_real_escape_string($conn,$_POST['email']);
      $pwd = mysqli_real_escape_string($conn,$_POST['password']); 
	  
      
      $sql = "SELECT email FROM login WHERE email = '$email' and pwd = '$pwd'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	  
	  
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
	  
         session_register("email");
         $_SESSION['login_user'] = $email;
         
         header("location: adminhome.php");
		
      }else {
         $error = "Your Login Name or Password is invalid";
      }*/
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
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div class="login-clean">
        <form method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-navigate"></i></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="submit">Log In</button></div><a href="index.php" class="forgot">Back....</a></form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>