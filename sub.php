<!DOCTYPE html>
<?php

session_start();

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
    <div class="highlight-clean">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Subject</h2>
                <p class="text-center">Add new Subjects or View, Update and Delete Subjects&nbsp;</p>
            </div>
            <div class="buttons"><a class="btn btn-primary" role="button" href="addsubject.php">Add New Subject</a><a class="btn btn-light" role="button" href='viewsubject.php'>View subject</a></div>
        </div>
    </div>
	<br>
	<br>
	<br><br><br>
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