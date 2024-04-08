<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Upload Video</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
<script src="js/jquery.min.js"></script>
<style>
    h1{

    }
</style>
</head>
<body>
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    error_reporting(E_ERROR | E_PARSE);
    
    $con=mysqli_connect("localhost","root","","myhmsdb");
    if(!isset($_SESSION['se']) || $_SESSION['se'] !== 1){
      session_destroy();
      header("Location: logout1.php");
      exit;
    }
    ?>
    <!-- NAVBAR -->
    <div class="container">
        <h1>Add Subscribers</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-1">
                <label for="mobile" class="form-label">Mobile NO</label>
                <input type="text" class="form-control" id="mobile" name="mobile" required>
                <button type="submit" name="add" value="add" class="btn btn-primary">
                    Add
                </button>
                <button type="submit" name="remove" value="remove" class="btn btn-primary">
                    Remove
                </button>
            </div>
        </form>
    </div>
    <?php
    include "func.php";
    $con=mysqli_connect("localhost","root","","myhmsdb");

    // Add subscriber
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
        $mobile = $_POST["mobile"];
        
        $result = mysqli_query($con, "SELECT pid FROM patreg WHERE contact=$mobile");
        // $result = mysqli_query($con, "SELECT pid FROM patreg WHERE mobile='$mobile'");
// if (!$result) {
//     die('Invalid query: ' . mysqli_error($con));
// }
        $row = mysqli_fetch_assoc($result);
        $pid = $row['pid'];
        // Check whether this user already exists in the database
        $res = mysqli_query($con, "SELECT * FROM subpid WHERE pid='$pid'");
        $count = mysqli_num_rows($res);
        if (!$count) {
            // Insert data into the database
            $sql = "INSERT INTO subpid(pid, status) VALUES('$pid', 1)";
            $retval = mysqli_query($con, $sql);
            if (!$retval) {
                die('Could not enter data: ' . mysqli_error($con));
            }
            echo "<script>alert(\"Subscribed\")</script>";
        } else {
            echo "<script>alert(\"User Already Subscribed.\")</script>";
        }
    }

    // Remove subscriber
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["remove"])) {
        $mobile = $_POST["mobile"];
        $result = mysqli_query($con, "SELECT pid FROM patreg WHERE contact='$mobile'");
        $row = mysqli_fetch_assoc($result);
        $pid = $row['pid'];
        $sql = "DELETE FROM subpid WHERE pid='$pid'";
        if (mysqli_query($con, $sql)) {
            echo "Subscriber removed successfully";
        } else {
            echo "Error removing subscriber: " . mysqli_error($con);
        }
    }
    ?>
</body>
</html>
