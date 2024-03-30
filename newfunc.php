<?php
// session_start();
$con=mysqli_connect("localhost","root","","myhmsdb");
// if(isset($_POST['submit'])){
//  $username=$_POST['username'];
//  $password=$_POST['password'];
//  $query="select * from logintb where username='$username' and password='$password';";
//  $result=mysqli_query($con,$query);
//  if(mysqli_num_rows($result)==1)
//  {
//   $_SESSION['username']=$username;
//   $_SESSION['pid']=
//   header("Location:admin-panel.php");
//  }
//  else
//   header("Location:error.php");
// }
if(isset($_POST['update_data']))
{
 $contact=$_POST['contact'];
 $status=$_POST['status'];
 $query="update appointmenttb set payment='$status' where contact='$contact';";
 $result=mysqli_query($con,$query);
 if($result)
  header("Location:updated.php");
}
require_once 'vendor/autoload.php'; 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
if(isset($_POST['excel_genrate']))
{
   // Connect to the database
   $con = mysqli_connect("localhost", "root", "", "myhmsdb");

   // Check connection
   if (mysqli_connect_errno()) {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
       exit();
   }

   // Prepare the query using a prepared statement
   $query = "SELECT * FROM patreg";
   $stmt = mysqli_prepare($con, $query);
   mysqli_stmt_execute($stmt);
   $result = mysqli_stmt_get_result($stmt);

  //  // Create a new Excel file
  //  $excel = new Spreadsheet();
   
  //  // Add a new sheet
  //  $sheet = $excel->getActiveSheet();

  //  // Write the data to the sheet
  //  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  //      $sheet->fromArray($row, null, 'A1');
  //  }

  //  // Save the Excel file
  //  $writer = new Xlsx($excel);
  //  $writer->save("patreg.xlsx");

  //  // Send the Excel file back to the browser
  //  header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
  //  header("Content-Disposition: attachment; filename=\"patreg.xlsx\"");
  //  readfile("patreg.xlsx");
  //  exit;
  $file = fopen("patreg.csv", "w");


  
    // Write the headers to the CSV file
    $headers = ["pid"	,"fname",	"lname"	,"gender",	    "email"	,    "contact"	,    "password",	    "cpassword",	    "dob"];    fputcsv($file, $headers);

    // Write the data to the CSV file
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        fputcsv($file, $row);
    }

    // Close the CSV file
    fclose($file);

    // Send the CSV file back to the browser
    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=\"patreg.csv\"");
    readfile("patreg.csv");
    exit;
  
}

// function display_docs()
// {
//  global $con;
//  $query="select * from doctb";
//  $result=mysqli_query($con,$query);
//  while($row=mysqli_fetch_array($result))
//  {
//   $username=$row['username'];
//   $price=$row['docFees'];
//   echo '<option value="' .$username. '" data-value="'.$price.'">'.$username.'</option>';
//  }
// }


function display_specs() {
  global $con;
  $query="select distinct(spec) from doctb";
  $result=mysqli_query($con,$query);
  while($row=mysqli_fetch_array($result))
  {
    $spec=$row['spec'];
    echo '<option data-value="'.$spec.'">'.$spec.'</option>';
  }
}

function display_docs()
{
 global $con;
 $query = "select * from doctb";
 $result = mysqli_query($con,$query);
 while( $row = mysqli_fetch_array($result) )
 {
  $username = $row['username'];
  $price = $row['docFees'];
  $spec = $row['spec'];
  echo '<option value="' .$username. '" data-value="'.$price.'" data-spec="'.$spec.'">'.$username.'</option>';
 }
}

// function display_specs() {
//   global $con;
//   $query = "select distinct(spec) from doctb";
//   $result = mysqli_query($con,$query);
//   while($row = mysqli_fetch_array($result))
//   {
//     $spec = $row['spec'];
//     $username = $row['username'];
//     echo '<option value = "' .$spec. '">'.$spec.'</option>';
//   }
// }


if(isset($_POST['doc_sub']))
{
 $username=$_POST['username'];
 $query="insert into doctb(username)values('$username')";
 $result=mysqli_query($con,$query);
 if($result)
  header("Location:adddoc.php");
}

?>