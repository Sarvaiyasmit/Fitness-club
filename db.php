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
    )",
    // Blog Posts array
    "CREATE TABLE IF NOT EXISTS blog_posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        category VARCHAR(50) NOT NULL,
        title VARCHAR(200) NOT NULL,
        description TEXT NOT NULL,
        image VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    // Services array
    "CREATE TABLE IF NOT EXISTS services (
        id INT AUTO_INCREMENT PRIMARY KEY,
        icon VARCHAR(50) NOT NULL,
        name VARCHAR(200) NOT NULL,
        description TEXT NOT NULL,
        price VARCHAR(100) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
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

// 5. Seed default Blog Posts if empty
$blog_check = $conn->query("SELECT COUNT(*) AS count FROM blog_posts");
$blog_row = $blog_check->fetch_assoc();
if ($blog_row['count'] == 0) {
    $seeded_blogs = [
        "('Khabib', 'New UFC Training Is Also In Our Gym', 'Experience the legendary UFC training methodology. Our certified trainers bring world-class MMA techniques to your workout routine.', 'images/khabib.webp')",
        "('Yoga', 'Beautiful Yoga Room Is In Our Gym', 'Discover our newly designed yoga studio featuring natural light, premium mats, and tranquil ambiance for your daily practice.', 'images/yoga room.webp')",
        "('Ground', 'Just New Ground Added For Running', 'We\'ve added a brand-new outdoor running track to complement your cardio training. Perfect for sprints, laps, and group runs.', 'images/ground.avif')"
    ];
    foreach ($seeded_blogs as $blog) {
        $conn->query("INSERT INTO blog_posts (category, title, description, image) VALUES $blog");
    }
}

// 6. Seed default Services if empty
$service_check = $conn->query("SELECT COUNT(*) AS count FROM services");
$service_row = $service_check->fetch_assoc();
if ($service_row['count'] == 0) {
    $seeded_services = [
        "('🏃', 'Personal Training', 'One-on-one training sessions tailored to you.', '$60/hour')",
        "('🧘', 'Group Classes', 'Yoga, Pilates, Zumba, and High-Energy Spinning.', '$15/class')",
        "('🏋️', 'Weight Training', 'Full access to dynamic free weights and professional equipment.', 'Included in membership')",
        "('🚴', 'Cardio Area', 'Premium treadmills, bikes, and elliptical machines.', 'Included in membership')",
        "('🏊', 'Swimming Pool', 'Enjoy our temperature-controlled 25-meter indoor pool.', 'Included in membership')",
        "('🥗', 'Nutrition Counseling', 'Personalized meal plans and diet tracking with expert coaches.', '$40/session')"
    ];
    foreach ($seeded_services as $srv) {
        $conn->query("INSERT INTO services (icon, name, description, price) VALUES $srv");
    }
}

// 7. Fix any NULL column values that cause "Undefined array key" warnings
//    These UPDATE queries are safe no-ops if all values are already set.
$conn->query("UPDATE services SET icon='🏋️' WHERE icon IS NULL OR icon=''");
$conn->query("UPDATE services SET name='(Untitled)' WHERE name IS NULL OR name=''");
$conn->query("UPDATE services SET description='' WHERE description IS NULL");
$conn->query("UPDATE services SET price='N/A' WHERE price IS NULL OR price=''");

$conn->query("UPDATE blog_posts SET category='General' WHERE category IS NULL OR category=''");
$conn->query("UPDATE blog_posts SET title='(Untitled)' WHERE title IS NULL OR title=''");
$conn->query("UPDATE blog_posts SET description='' WHERE description IS NULL");
$conn->query("UPDATE blog_posts SET image='images/ground.avif' WHERE image IS NULL OR image=''");
?>
