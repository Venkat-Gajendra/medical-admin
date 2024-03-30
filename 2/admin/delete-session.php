<?php
session_start();

// Redirect to login page if user is not logged in or not an admin
if (!isset($_SESSION["user"]) || $_SESSION['usertype'] != 'a') {
    header("location: ../login.php");
    exit();
}

// Include database connection
include("../connection.php");

// Delete schedule if id is provided
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];
    $sql = $database->query("DELETE FROM schedule WHERE scheduleid=$id;");
    header("location: schedule.php");
} else {
    header("location: schedule.php?error=invalidid");
}

// Close database connection
$database->close();
?>
