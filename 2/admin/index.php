<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="styles.css">
    <title>Dashboard</title>
</head>
<body>
    <?php
    session_start();
    require_once("../connection.php");

    if (!isset($_SESSION["user"]) || $_SESSION["usertype"] != 'a') {
        header("location: ../login.php");
    }
    ?>
    <div class="container">
        <?php include("menu.php"); ?>
        <div class="dash-body">
            <!-- Content goes here -->
        </div>
    </div>
</body>
</html>


<div class="menu">
    <table class="menu-container" border="0">
        <tr>
            <td style="padding:10px" colspan="2">
                <table border="0" class="profile-container">
                    <tr>
                        <td width="30%" style="padding-left:20px">
                            <img src="../img/user.png" alt="User Image" width="100%" style="border-radius:50%">
                        </td>
                        <td style="padding:0px;margin:0px;">
                            <p class="profile-title">Administrator</p>
                            <p class="profile-subtitle">admin@edoc.com</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="../logout.php"><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- Add menu rows here -->
    </table>
</div>


.menu-text {
    text-decoration: none;
    color: inherit;
}

.menu-active .menu-text,
.menu-icon-dashbord-active .menu-text {
    color: var(--primarycolor);
}

.menu-active,
.menu-icon-dashbord-active {
    background-color: var(--primarylight);
}

.menu-icon-dashbord::before,
.menu-icon-doctor::before,
.menu-icon-schedule::before,
.menu-icon-appoinment::before,
.menu-icon-patient::before {
    content: "";
    display: inline-block;
    width: 20px;
    height: 20px;
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
}

.menu-icon-dashbord::before {
    background-image: url('../img/icons/dashboard.svg');
}

.menu-icon-doctor::before {
    background-image: url('../img/icons/doctors.svg');
}

.menu-icon-schedule::before {
    background-image: url('../img/icons/schedule.svg');
}

.menu-icon-appoinment::before {
    background-image: url('../img/icons/appoinment.svg');
}

.menu-icon-patient::before {
    background-image: url('../img/icons/patient.svg');
}

/* Add more icons as needed */


<?php
$today = date('Y-m-d');

$patient_query = $database->query("select * from patient;");
$doctor_query = $database->query("select * from doctor;");
$appointment_query = $database->query("select * from appointment where appodate>='$today';");
$schedule_query = $database->query("select * from schedule where scheduledate='$today';");

$upcoming_appointments_query = $database->query("select appointment.appoid,schedule.scheduleid,schedule.title,doctor.docname,patient.pname,schedule.scheduledate,schedule.scheduletime,appointment.apponum,appointment.appodate from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid  where schedule.scheduledate>='$today'  and schedule.scheduledate<='" . date("Y-m-d", strtotime("+1 week")) . "' order by schedule.scheduledate desc");

$upcoming_sessions_query = $database->query("select schedule.scheduleid,schedule.title,doctor.docname,schedule.scheduledate,schedule.scheduletime,schedule.nop from schedule inner join doctor on schedule.docid=doctor.docid  where schedule.scheduledate>='$today' and schedule.scheduledate<='" . date("Y-m-d", strtotime("+1 week")) . "' order by schedule
