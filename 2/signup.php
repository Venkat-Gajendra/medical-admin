<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
        
    <title>Sign Up</title>
    
</head>
<body>
<?php

//learn from w3schools.com
//Unset all the server side variables
// Database connection parameters
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "edoc";

// Create a connection
$database = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);

}
if ($_POST) {
    // Validate and sanitize user inputs
    $email = filter_var($_POST['address'], FILTER_SANITIZE_EMAIL);
    $fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
    $lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
    $password = $_POST['password']; // Hash the password for security
    $nic = filter_var($_POST['nic'], FILTER_SANITIZE_STRING);
    $dob = $_POST['dob']; // No need to sanitize since it's a date field
    $ptel = $_POST['ptel']; // Assuming this is the telephone number field

    $fullname = $fname . ' ' . $lname;

    // Prepare and execute the SQL query
    $stmt = $database->prepare("INSERT INTO patient (pemail, pname, ppassword, pnic, pdob, ptel) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $email, $fullname, $password, $nic, $dob, $ptel);
    $stmt->execute();
    $usertype = "p";
    $stmt = $database->prepare("INSERT INTO webuser (email, usertype) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $usertype);
    $stmt->execute();
    
    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        // Data inserted successfully
        $_SESSION["personal"] = array(
            'email' => $email,
            'fname' => $fname,
            'lname' => $lname,
            'nic' => $nic,
            'dob' => $dob,
            'ptel' => $ptel
        );

        // Redirect to the next step
        header("location: thankyou.php");
    } else {
        // Error occurred while inserting data
        echo "Error: " . $database->error;
    }

    // Close the statement
    $stmt->close();
}


// -----------------------------------------------------------------------
// // session_start();

// // $_SESSION["user"]="root";
// // $_SESSION["usertype"]="";

// // Set the new timezone
// date_default_timezone_set('Asia/Kolkata');
// $date = date('Y-m-d');

// $_SESSION["date"]=$date;



// if($_POST){

    

//     $_SESSION["personal"]=array(
//         'fname'=>$_POST['fname'],
//         'lname'=>$_POST['lname'],
//         'address'=>$_POST['address'],
//         'nic'=>$_POST['nic'],
//         'dob'=>$_POST['dob']
//     );


//     print_r($_SESSION["personal"]);
//     header("location: create-account.php");




// }
//--------------------------------------------------------------------------
?>


    <center>
    <div class="container">
        <table border="0">
            <tr>
                <td colspan="2">
                    <p class="header-text">Let's Get Started</p>
                    <p class="sub-text">Add Your Personal Details to Continue</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td" colspan="2">
                    <label for="name" class="form-label">Name: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="text" name="fname" class="input-text" placeholder="First Name" required>
                </td>
                <td class="label-td">
                    <input type="text" name="lname" class="input-text" placeholder="Last Name" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="address" class="form-label" >E-mail Address: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="email" name="address" class="input-text" placeholder="E-mail Address" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="nic" class="form-label">NIC: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" name="nic" class="input-text" placeholder="NIC Number" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="dob" class="form-label">Date of Birth: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="date" name="dob" class="input-text" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                </td>
            </tr>
            <tr>
    <td class="label-td" colspan="2">
        <label for="ptel" class="form-label">Telephone Number: </label>
    </td>
</tr>
<tr>
    <td class="label-td" colspan="2">
        <input type="text" name="ptel" class="input-text" placeholder="Telephone Number" required>
    </td>
</tr>
<tr>
    <td class="label-td" colspan="2">
        <label for="password" class="form-label">Password: </label>
    </td>
</tr>
<tr>
    <td class="label-td" colspan="2">
        <input type="password" name="password" class="input-text" placeholder="Password" required>
    </td>
</tr>

            <tr>
                <td>
                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >
                </td>
                <td>
                    <input type="submit" value="Next" class="login-btn btn-primary btn">
                </td>

            </tr>
            
            <tr>
                <td colspan="2">
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                    <a href="login.php" class="hover-link1 non-style-link">Login</a>
                    <br><br><br>
                </td>
            </tr>

                    </form>
            </tr>
        </table>

    </div>
</center>
</body>
</html>