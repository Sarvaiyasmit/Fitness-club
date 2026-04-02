<?php
// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$dbname = "gym_db";

// 1. Connect to MySQL server (without database selected yet)
$conn = new mysqli($host, $username, $password);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// 2. Create the database "gym_db" if it doesn't already exist
$sql = "CREATE DATABASE IF NOT EXISTS gym_db";
if ($conn->query($sql) === TRUE) {
    // Now select the database to use for subsequent queries
    $conn->select_db($dbname);
} else {
    die("Error creating database: " . $conn->error);
}

// 3. Auto-setup  Database Tables
$tables = [
    // Admin array
    "CREATE TABLE IF NOT EXISTS admin_users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    // Members array
    "CREATE TABLE IF NOT EXISTS members (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        phone VARCHAR(20),
        age INT,
        gender VARCHAR(10),
        joined TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        status VARCHAR(20) DEFAULT 'active'
    )",
    // Contact Messages array
    "CREATE TABLE IF NOT EXISTS messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        sender VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        subject VARCHAR(200),
        message TEXT,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        status VARCHAR(20) DEFAULT 'unread'
    )"
];

// Execute all table creation queries
foreach ($tables as $tableSql) {
    if ($conn->query($tableSql) !== TRUE) {
        die("Error creating table: " . $conn->error);
    }
}

// 4. Secure Default Admin setup
// If there is no admin user yet, create a default one inside the database
$admin_check = $conn->query("SELECT * FROM admin_users WHERE username = 'admin'");
if ($admin_check->num_rows == 0) {
    // We use PHP password_hash for security
    $hashed_password = password_hash('admin123', PASSWORD_DEFAULT);
    $conn->query("INSERT INTO admin_users (username, password) VALUES ('admin', '$hashed_password')");
}
?>
