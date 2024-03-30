<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Patients</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>
<body>
    <?php
    // learn from w3schools.com
    session_start();

    if (!isset($_SESSION["user"]) || $_SESSION["user"] == "" || $_SESSION['usertype'] != 'a') {
        header("location: ../login.php");
    }

    //import database
    include("../connection.php");

    // initialize variables
    $searchTerm = "";
    $sqlMain = "select * from patient order by pid desc";

    // check if search button is clicked
    if (isset($_POST["searchButton"])) {
        $searchTerm = $_POST["search"];

        // fix case sensitivity
        $searchTerm = strtolower($searchTerm);

        $sqlMain = "select * from patient where lower(pemail) like '%$search%' or lower(pname) like '%$search%' order by pid desc";
    }
    ?>
    <div class="container">
        <!-- menu code here -->
        <div class="dash-body">
            <!-- header code here -->
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <!-- table rows here -->
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Patients (<?php echo $database->query("select * from patient")->num_rows; ?>)</p>
                    </td>
                </tr>
                <!-- search result table here -->
                <tr>
                    <td colspan="4">
                        <center>
                            <div class="abc scroll">
                                <table width="93%" class="sub-table scrolldown" style="border-spacing:0;">
                                    <!-- table head here -->
                                    <tbody>
                                        <!-- search result rows here -->
                                        <?php
                                        $result = $database->query($sqlMain);

                                        if ($result->num_rows == 0) {
                                            echo '<tr>
                                            <td colspan="4">
                                            <br><br><br><br>
                                            <center>
                                            <img src="../img/notfound.svg" width="25%">
                                            
                                            <br>
                                            <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                            <a class="non-style-link" href="patient.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Patients &nbsp;</font></button>
                                            </a>
                                            </center>
                                            <br><br><br><br>
                                            </td>
                                            </tr>';
                                        } else {
                                            while ($row = $result->fetch_assoc()) {
                                                $pid = $row["pid"];
                                                $name = $row["pname"];
                                                $email = $row["pemail"];
                                                $nic = $row["pnic"];
                                                $dob = $row["pdob"];
                                                $tel = $row["ptel"];

                                                echo '<tr>
                                                <td> &nbsp;' . substr($name, 0, 35) . '</td>
                                                <td>' . substr($nic, 0, 12) . '</td>
                                                <td>' . substr($tel, 0, 10) . '</td>
                                                <td>' . substr($email, 0, 20) . '</td>
                                                <td>' . substr($dob, 0, 10) . '</td>
                                                <td >
                                                <div style="display:flex;justify-content: center;">
                                                 <a href="?action=view&id=' . $pid . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-
