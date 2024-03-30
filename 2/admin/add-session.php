<?php

session_start();

if (!isset($_SESSION["user"]) || trim($_SESSION["user"]) == "" || $_SESSION['usertype'] != 'a') {
    header("location: ../login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // import database
    include("../connection.php");

    $title = $_POST["title"];
    $docid = $_POST["docid"];
    $nop = $_POST["nop"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    $sql = "insert into schedule (docid, title, scheduledate, scheduletime, nop) values (?, ?, ?, ?, ?)";
    $stmt = $database->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("issis", $docid, $title, $date, $time, $nop);
        $result = $stmt->execute();
        $stmt->close();
    } else {
        // handle error
        echo "Error: " . $database->error;
    }

    if ($result) {
        header("location: schedule.php?action=session-added&title=" . urlencode(htmlspecialchars($title)));
    } else {
        // handle error
    }
    exit;
}

?>
