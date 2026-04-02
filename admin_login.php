<?php
session_start();
include 'db.php';

// If already logged in, redirect straight to panel (use header for guards to prevent loops)
if(isset($_SESSION['adminLoggedIn']) && $_SESSION['adminLoggedIn'] === true){
    header("Location: admin_panel.php");
    exit;
}

$error_message = '';

// Handle Login Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM admin_users WHERE username = '$username'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Use secure password verification against hashed DB password
        if (password_verify($password, $row['password'])) {
            $_SESSION['adminLoggedIn'] = true;
            $_SESSION['adminUser'] = $username;
            echo "<script>alert('Admin login successful!'); window.location.href='admin_panel.php';</script>";
            exit;
        } else {
            $error_message = "Invalid password. Try 'admin123'.";
            echo "<script>alert('$error_message');</script>";
        }
    } else {
        $error_message = "Invalid username. Default is 'admin'.";
        echo "<script>alert('$error_message');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - FITNESS CLUB</title>
    <link rel="stylesheet" href="style.css?v=7">

    <style>
        body { font: 16px Arial, sans-serif; }
        b.error { color: red; font-size: 14px; display: none; }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="blog-content">
        <h1>ADMIN LOGIN</h1>
        <p class="blog-text">Gym Management Portal</p>
    </div>

    <center>
        <div class="registration-form"><br>
            <form method="POST" action="admin_login.php" id="adminForm">
                <h1>Admin Login Form</h1><br>

                <input name="username" id="username" class="input" type="text" placeholder="Enter Admin Username" autocomplete="username"  autofocus><br>
                <b id="userError" class="error"></b><br>

                <input name="password" id="password" class="input" type="password" placeholder="Enter Password" autocomplete="current-password" ><br>
                <b id="passError" class="error"></b><br>

                <button type="submit" class="reg">Login to Dashboard</button><br><br>
            </form>
        </div><br><br>
    </center>

<script>
document.getElementById('adminForm').addEventListener('submit', function(event) {
    let isValid = true;
    
    // User Validation
    const user = document.getElementById('username').value.trim();
    const userError = document.getElementById('userError');

    if (user === "") {
        userError.style.display = "block";
        userError.innerHTML = "Username is required";
        isValid = false;
    } else {
        userError.style.display = "none";
    }

    // Password Validation
    const password = document.getElementById('password').value;
    const passwordError = document.getElementById('passError');

    if (password === "") {
        passwordError.style.display = "block";
        passwordError.innerHTML = "Password is required";
        isValid = false;
    } else {
        passwordError.style.display = "none";
    }

    if (!isValid) {
        event.preventDefault(); // Pause PHP POST if JS validation fails
    }
});
</script>

    <?php include 'footer.php'; ?>
</body>
</html>
