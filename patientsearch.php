<!DOCTYPE html>
 <?php #include("func.php");?>
<html>
<head>
	<title>Patient Details</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
<?php
include("newfunc.php");
if(isset($_POST['patient_search_submit']))
{
	$contact=$_POST['patient_contact'];
	$query = "select * from patreg where contact= '$contact'";
  $result = mysqli_query($con,$query);
  $row=mysqli_fetch_array($result);
  if($row['lname']=="" & $row['email']=="" & $row['contact']=="" & $row['password']==""){
    echo "<script> alert('No entries found! Please enter valid details'); 
          window.location.href = 'admin-panel1.php#list-doc';</script>";
  }
  else {
    echo "<div class='container-fluid' style='margin-top:50px;'>
	<div class='card'>
	<div class='card-body' style='background-color:#342ac1;color:#ffffff;'>
<table class='table table-hover'>
  <thead>
    <tr>
      <th scope='col'>First Name</th>
      <th scope='col'>Last Name</th>
      <th scope='col'>Email</th>
      <th scope='col'>Contact</th>
      <th scope='col'>Password</th>
    </tr>
  </thead>
  <tbody>";

	
		    $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $contact = $row['contact'];
        $password = $row['password'];
        echo "<tr>
          <td>$fname</td>
          <td>$lname</td>
          <td>$email</td>
          <td>$contact</td>
          <td>$password</td>
        </tr>";
    
	echo "</tbody></table><center><a href='admin-panel1.php' class='btn btn-light'>Back to dashboard</a></div></center></div></div></div>";
}
  }
//   require_once 'vendor/autoload.php'; 
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// if(isset($_POST['excel_genrate']))
// {
//    // Connect to the database
//    $con = mysqli_connect("localhost", "root", "", "myhmsdb");

//    // Check connection
//    if (mysqli_connect_errno()) {
//        echo "Failed to connect to MySQL: " . mysqli_connect_error();
//        exit();
//    }

//    // Prepare the query using a prepared statement
//    $query = "SELECT * FROM patreg";
//    $stmt = mysqli_prepare($con, $query);
//    mysqli_stmt_execute($stmt);
//    $result = mysqli_stmt_get_result($stmt);

//    // Create a new Excel file
//    $excel = new Spreadsheet();
   
//    // Add a new sheet
//    $sheet = $excel->getActiveSheet();

//    // Write the data to the sheet
//    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
//        $sheet->fromArray($row, null, 'A1');
//    }

//    // Save the Excel file
//    $writer = new Xlsx($excel);
//    $writer->save("patreg.xlsx");

//    // Send the Excel file back to the browser
//    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
//    header("Content-Disposition: attachment; filename=\"patreg.xlsx\"");
//    readfile("patreg.xlsx");
//    exit;
  
// }   
// if(isset($_POST['genrate_appointment']))
// {
//    // Connect to the database
//    $con = mysqli_connect("localhost", "root", "", "myhmsdb");

//    // Check connection
//    if (mysqli_connect_errno()) {
//        echo "Failed to connect to MySQL: " . mysqli_connect_error();
//        exit();
//    }

//    // Prepare the query using a prepared statement
//    $query = "SELECT fname,lname,gender,email,contact,doctor,docFees,appdate,apptime FROM appointmenttb ORDER BY appdate DESC;";
//    $stmt = mysqli_prepare($con, $query);
//    mysqli_stmt_execute($stmt);
//    $result = mysqli_stmt_get_result($stmt);

//    // Create a new Excel file
//    $excel = new Spreadsheet();
   
//    // Add a new sheet
//    $sheet = $excel->getActiveSheet();

//    // Write the data to the sheet
//    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
//        $sheet->fromArray($row, null, 'A1');
//    }

//    // Save the Excel file
//    $writer = new Xlsx($excel);
//    $writer->save("appointments.xlsx");

//    // Send the Excel file back to the browser
//    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
//    header("Content-Disposition: attachment; filename=\"patreg.xlsx\"");
//    readfile("patreg.xlsx");
//    exit;
  
// }   
?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> 
</body>
</html>