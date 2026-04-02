<!DOCTYPE html>
<html>
<head>
    <title>Login - FITNESS CLUB</title>
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css?v=7">
    
    <style>
        b.error {
            color: red;
            font-size: 14px;
            display: none;
        }
        body {
            font: 16px Arial, sans-serif;
        }
    </style>
</head>
<body>
    <?php include 'header.php';?>

    <div class="blog-content">
        <h1>LOGIN</h1>
        <p class="blog-text">Welcome back to our gym</p>
    </div>

    <center>
        <div class="registration-form"><br>
            <form id="loginForm">
                <h1>Login Form</h1><br>

                <input id="email" class="input" type="text" placeholder="Enter your Email"><br>

                <b id="emailError" class="error"></b><br>

                <input class="input" type="password" id="password" placeholder="Enter your Password"><br>
                <b id="passwordError" class="error"></b><br>

                <button type="submit" class="reg">Login</button><br><br>
            </form>
        </div><br><br>
    </center>

<script>
document.getElementById('loginForm').addEventListener('submit', function(event){
    event.preventDefault();
    let isValid = true;
    
    const email = document.getElementById('email').value.trim();
    const email_regex = /^[a-z0-9]+@[a-z0-9]+\.[a-z]{2,}$/;
    const emailError = document.getElementById('emailError');

    if (email === "") {
        emailError.style.display = "block";
        emailError.innerHTML = "Email is required";
        isValid = false;
    } else if (!email_regex.test(email)) {
        emailError.style.display = "block";
        emailError.innerHTML = "Invalid email format";
        isValid = false;
    } else {
        emailError.style.display = "none";
    }

    const password = document.getElementById('password').value;
    const passwordError = document.getElementById('passwordError');

    if (password === "") 
    {
        passwordError.style.display = "block";
        passwordError.innerHTML = "Password is required";
        isValid = false;
    } else if (password.length < 6) {
        passwordError.style.display = "block";
        passwordError.innerHTML = "Password must be at least 6 characters";
        isValid = false;
    } 
    
    else {
        passwordError.style.display = "none";
}

    if (isValid) {
        alert('Login successful!');
        localStorage.setItem('isLoggedIn', 'true');
        document.getElementById('loginForm').reset();
        window.location.href = "homepage.php";
    }
});
</script>

    <?php include 'footer.php'; ?>
</body>
</html>
