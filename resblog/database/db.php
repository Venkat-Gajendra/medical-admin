<?php
// Define database credentials as constants to prevent accidental modification and improve security
define('DB_USERNAME', 'your_database_username');
define('DB_PASSWORD', 'your_database_password');
define('DB_HOST', 'localhost');
define('DB_NAME', 'blog_admin_db');

// Create a new PDO object with error mode set to exceptions
try {
    $pdo_conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $pdo_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle exceptions by logging the error and displaying a user-friendly message
    error_log($e->getMessage());
    echo "Error: Connection failed";
    exit();
}
?>
