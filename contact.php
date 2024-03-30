<?php

// Database connection
$con = mysqli_connect("localhost", "root", "", "myhmsdb");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Check if form is submitted
if (isset($_POST['btnSubmit'])) {

    // Sanitize input data
    $name = filter_var($_POST['txtName'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['txtEmail'], FILTER_SANITIZE_EMAIL);
    $contact = filter_var($_POST['txtPhone'], FILTER_SANITIZE_NUMBER_INT);
    $message = filter_var($_POST['txtMsg'], FILTER_SANITIZE_STRING);

    // Prepare and bind the query
    $stmt = $con->prepare("INSERT INTO contact (name, email, contact, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $email, $contact, $message);

    // Execute the query
    if ($stmt->execute()) {
        echo '<script type="text/javascript">';
        echo 'alert("Message sent successfully!");';
        echo 'window.location.href = "contact.html";';
        echo '</script>';
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
mysqli_close($con);

?>
