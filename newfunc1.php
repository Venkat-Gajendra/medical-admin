<?php
if(isset($_POST['genrate_appointment']))
{
   // Connect to the database
   $con = mysqli_connect("localhost", "root", "", "myhmsdb");

   // Check connection
   if (mysqli_connect_errno()) {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
       exit();
   }

   // Prepare the query using a prepared statement
   $query = "SELECT fname,lname,gender,email,contact,doctor,docFees,appdate,apptime FROM appointmenttb ORDER BY appdate DESC;";
   $stmt = mysqli_prepare($con, $query);
   mysqli_stmt_execute($stmt);
   $result = mysqli_stmt_get_result($stmt);
  $file = fopen("appointments.csv", "w");
    // Write the headers to the CSV file
    $headers = ["fname","lname","gender","email","contact","doctor","docFees","appdate","apptime"];    fputcsv($file, $headers);
    // Write the data to the CSV file
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        fputcsv($file, $row);
    }
    // Close the CSV file
    fclose($file);
    // Send the CSV file back to the browser
    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=\"appointments.csv\"");
    readfile("appointments.csv");
    exit;
  
}
?>