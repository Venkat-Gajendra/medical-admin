<?php

// Start the session and destroy all session variables
session_start();
session_destroy();

// Unset all session cookies
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}

// Redirect the user to the login page
header('Location: login.php?action=logout');
exit;

?>
