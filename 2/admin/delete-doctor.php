<?php

session_start();

// Redirect to login page if user is not logged in or not an admin
if (!isset($_SESSION["user"]) || $_SESSION['usertype'] != 'a') {
    header("location: ../login.php");
    exit();
}

// Include database connection
include("../connection.php");

// Delete doctor if id is provided in GET request
if (isset($_GET["id"]) && filter_var($_GET["id"], FILTER_VALIDATE_INT)) {
    $id = $_GET["id"];
    $emailQuery = $database->query("select docemail from doctor where docid=$id;");
    $emailResult = $emailQuery->fetch_assoc();
    $email = $emailResult["docemail"];

    // Delete doctor from doctor table
    $deleteDoctorQuery = $database->query("delete from doctor where docemail='$email';");

    // Delete user from webuser table
    $deleteUserQuery = $database->query("delete from webuser where email='$email';");

    // Redirect to doctors page
    header("location: doctors.php");
    exit();
}

// Redirect to doctors page if no id is provided in GET request
header("location: doctors.php");
exit();

?>
