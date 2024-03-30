<?php

session_start();

// Redirect to login page if user is not logged in or not an admin
if (!isset($_SESSION["user"]) || $_SESSION['usertype'] != 'a') {
    header("location: ../login.php");
    exit();
}

// Include database connection
include("../connection.php");

// Delete appointment if id is provided in GET request
if ($_GET && isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];
    $sql = $database->query("DELETE FROM appointment WHERE appoid = $id;");
    header("location: appointment.php");
} else {
    header("location: appointment.php?error=invalid_id");
}

// Close database connection
$database->close();

?>
