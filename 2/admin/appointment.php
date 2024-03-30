<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Appointments</title>
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

    // Redirect to login page if user is not logged in or not an admin
    if (!isset($_SESSION["user"]) || ($_SESSION["user"] == "" || $_SESSION['usertype'] != 'a')) {
        header("location: ../login.php");
        exit;
    }

    // Import database
    include("../connection.php");

    // Define error message variable
    $error = "";

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $sheduledate = $_POST["sheduledate"];
        $docid = $_POST["docid"];

        // Prepare SQL statement
        $sql = "SELECT appointment.appoid, schedule.scheduleid, schedule.title, doctor.docname, patient.pname, schedule.scheduledate, schedule.scheduletime, appointment.apponum, appointment.appodate
                FROM schedule
                INNER JOIN appointment ON schedule.scheduleid = appointment.scheduleid
                INNER JOIN patient ON patient.pid = appointment.pid
                INNER JOIN doctor ON schedule.docid = doctor.docid
                WHERE 1=1";

        // Add filters to SQL statement
        $filters = array();
        if (!empty($sheduledate)) {
            $filters[] = "schedule.scheduledate = ?";
        }
        if (!empty($docid)) {
            $filters[] = "schedule.docid = ?";
        }

        // Add filters to SQL statement
        if (!empty($filters)) {
            $sql .= " AND " . implode(" AND ", $filters);
        }

        // Prepare SQL statement for execution
        $stmt = $database->prepare($sql);

        // Bind parameters to SQL statement
        if (!empty($sheduledate)) {
            $stmt->bind_param("s", $sheduledate);
        }
        if (!empty($docid)) {
            $stmt->bind_param("i", $docid);
        }

        // Execute SQL statement
        $stmt->execute();

        // Get result
        $result = $stmt->get_result();

        // Check for errors
        if ($stmt->error) {
            $error = "Error: " . $stmt->error;
        }
    } else {
        // Get all appointments if form is not submitted
        $sql = "SELECT appointment.appoid, schedule.scheduleid, schedule.title, doctor.docname, patient.pname, schedule.scheduledate, schedule.scheduletime, appointment.apponum, appointment.appodate
                FROM schedule
                INNER JOIN appointment ON schedule.scheduleid = appointment.scheduleid
                INNER JOIN patient ON patient.pid = appointment.pid
                INNER JOIN doctor ON schedule.docid = doctor.docid
                ORDER BY schedule.scheduledate DESC";

        // Execute SQL statement
        $result = $database->query($sql);

        // Check for errors
        if (!$result) {
            $error = "Error: " . $database->error;
        }
    }
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title">Administrator</p>
                                    <p class="profile-subtitle">admin@edoc.com</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord" >
                        <a href="index.php" class="non-style-link-menu"><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-
