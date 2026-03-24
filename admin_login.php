<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - FITNESS CLUB</title>
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">

    <style>
        b.error {
            color: red;
            font-size: 14px;
            display: none;
        }
        script {
            font: 16px Arial, sans-serif;
        }
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
            <form id="adminLoginForm">
                <h1>Admin Login Form</h1><br>

                <div id="errorMsg" style="color: red; margin-bottom: 15px; display: none;">
                    <b><span id="errorText">Invalid credentials. Please try again.</span></b>
                </div>

                <input id="adminUser" class="input" type="text" placeholder="Enter Admin Username" autocomplete="username"><br>
                <b id="userError" class="error"></b><br>

                <input class="input" type="password" id="adminPass" placeholder="Enter Password" autocomplete="current-password"><br>
                <b id="passError" class="error"></b><br>

                <button type="button" class="reg" id="loginBtn" onclick="doLogin()">Login to Dashboard</button><br><br>
            </form>
        </div><br><br>
    </center>

<script>
    // Auto-focus username field
    document.getElementById('adminUser').focus();

    // Allow Enter key to submit
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') doLogin();
    });

    function doLogin() {
        const user = document.getElementById('adminUser').value.trim();
        const pass = document.getElementById('adminPass').value;
        const errorMsg = document.getElementById('errorMsg');
        const errorText = document.getElementById('errorText');
        const userError = document.getElementById('userError');
        const passError = document.getElementById('passError');

        let isValid = true;

        if (user === "") {
            userError.style.display = "block";
            userError.innerHTML = "Username is required";
            isValid = false;
        } else {
            userError.style.display = "none";
        }

        if (pass === "") {
            passError.style.display = "block";
            passError.innerHTML = "Password is required";
            isValid = false;
        } else {
            passError.style.display = "none";
        }

        if (!isValid) return;

        // Credentials: admin / admin123
        if (user === 'admin' && pass === 'admin123') {
            localStorage.setItem('adminLoggedIn', 'true');
            localStorage.setItem('adminUser', user);
            const btn = document.getElementById('loginBtn');
            btn.textContent = 'Redirecting...';
            errorMsg.style.display = 'none';
            setTimeout(() => { window.location.href = 'admin_panel.php'; }, 800);
        } else {
            errorText.textContent = 'Invalid username or password. Try: admin / admin123';
            errorMsg.style.display = 'block';
            document.getElementById('adminPass').value = '';
            document.getElementById('adminPass').focus();
        }
    }
</script>

    <?php include 'footer.php'; ?>
</body>
</html>
