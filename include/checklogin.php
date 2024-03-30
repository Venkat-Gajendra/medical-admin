<?php
// check_login.php

// Start the session before checking the login status
session_start();

function check_login()
{
    // Check if the user is not logged in
    if (!isset($_SESSION['login']) || empty($_SESSION['login'])) {
        // Redirect to the login page
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = "./user-login.php";
        header("Location: http://$host$uri/$extra");
        exit;
    }
}

// Use the function to check the login status
check_login();

// Continue with the rest of your code here
?>
