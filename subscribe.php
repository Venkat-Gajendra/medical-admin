<!DOCTYPE html>
<html>
<head>
    <title>Viewer Page</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">  
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <style>
    h3{
        font-size:43px;
        position:relative;
        bottom: 5px;
        top:5rem;
        
    }
    p{        
        bottom: 5px;
        font-size:43px;
        position:relative;
        top:5rem;
    }
    #vidplayer{
        height:27rem;
        width:48rem;
        margin:auto;
        display:block;
        top:97px;
        position: relative;
        border: 2px solid black;
    }
    </style>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <a class="navbar-brand" href="#"><i class="fa fa-user-plus" aria-hidden="true"></i> Best of id's </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav mr-auto">
       <li class="nav-item">
        <a class="nav-link" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
    </ul>
  </div>
</nav>
      <!-- ----------------------------------------------------------------- -->

<?php
session_start();
include('func.php');
$pid= $_SESSION['pid'];
$con=mysqli_connect("localhost","root","","myhmsdb");
$result = mysqli_query($con,"SELECT * FROM subpid where pid ='$pid';");
// $num_rows = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result) ;

if ( !$row['status'] ) { 
  header('Location: subtous.php'); 
  exit();
} 

$row = mysqli_fetch_assoc($result) ;

$email = $_SESSION['email'];
$result = mysqli_query($con,"SELECT * FROM vidlib ;");
while ($row = mysqli_fetch_assoc($result)) {
    // Do something with $row
    $vid=$row["vid"];
    $title=$row["title"];
    $Text=$row["context"];
    $url=$row["url"];
    echo"<div class='container'>
    <h3>$title</h3>
    <br/>
    <p>$Text</p><br/>

    <video id='vidplayer' controls>
        <source src='$url' type='video/mp4'></source>
        Your browser does not support the video tag.
    </video>
    </div>
    ";
}

?>

    
</body>
</html>