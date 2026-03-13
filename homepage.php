<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <style>
        footer {
            margin-top: 0;
        }
        video {
            display: block;
            width: 100%;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
    <main class="image-container">
       <video autoplay muted loop>
            <source src="STG_boost.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="center-text">
            <h1>Welcome to Our Gym</h1>
            <p>Join us for a healthier lifestyle!</p>
        </div>
    </main>
<?php include 'footer.php'; ?>
</body>
</html>
