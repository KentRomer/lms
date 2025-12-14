<?php
$host = getenv('MYSQLHOST') ?: 'mysql.railway.internal';
$port = getenv('MYSQLPORT') ?: '3306';
$user = getenv('MYSQLUSER') ?: 'root';
$password = getenv('MYSQLPASSWORD');
$database = getenv('MYSQLDATABASE') ?: 'railway';

// Log connection attempt
error_log("Attempting MySQL connection to: $host:$port");

try {
    $conn = new mysqli($host, $user, $password, $database, $port);
    
    if ($conn->connect_error) {
        error_log("MySQL Connection Error: " . $conn->connect_error);
        die("Database connection failed. Please try again later.");
    }
    
    $conn->set_charset("utf8mb4");
    error_log("MySQL connected successfully");
    
} catch (Exception $e) {
    error_log("MySQL Exception: " . $e->getMessage());
    die("Database error");
}
?>