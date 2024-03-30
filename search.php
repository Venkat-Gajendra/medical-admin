<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "myhmsdb");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['search_submit'])) {
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $docname = $_SESSION['dname'];
    $query = "select * from appointmenttb where contact='$contact' and doctor='$docname';";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        echo '<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <body style="background-color:#342ac1;color:white;text-align:center;padding-top:50px;">
  <div class="container" style="text-align:left;">
  <center><h3>Search Results</h3></center><br>
  <table class="table table-hover">
  <thead>
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Contact</th>
      <th>Appointment Date</th>
      <th>Appointment Time</th>
    </tr>
  </thead>
  <tbody>
  ';
        while ($row = mysqli_fetch_array($result)) {
            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $contact = $row['contact'];
            $appdate = $row['appdate'];
            $apptime = $row['apptime'];
            echo '<tr>
      <td>' . $fname . '</td>
      <td>' . $lname . '</td>
      <td>' . $email . '</td>
      <td>' . $contact . '</td>
      <td>' . $appdate . '</td>
      <td>' . $apptime . '</td>
    </tr>';
        }
        echo '</tbody></table></div>
<div><a href="doctor-panel.php" class="btn btn-light">Go Back</a></div>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/
