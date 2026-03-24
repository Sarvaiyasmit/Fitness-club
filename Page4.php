<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
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
        <h1>REGISTRATION</h1>
        <p class="blog-text">Best experience for joining our gym</p>
    </div>

    <center>
        <div class="registration-form"><br>
            <form id="myForm">
                <h1>Registration Form</h1><br>

                <input class="input" id="name" type="text" placeholder="Enter your name"><br>
                <b id="nameError" class="error"></b><br>

                <input id="email" class="input" type="text" placeholder="Enter your Email"><br>
                <b id="emailError" class="error"></b><br>

                <input class="input" type="number" id="number" placeholder="Enter your Number"><br>
                <b id="num_error" class="error"></b><br>

                <input class="input" type="number" id="age" placeholder="Enter your Age"><br>
                <b id="age_error" class="error"></b><br>

                Gender<br>
                <div class="gender-group">
                    <label><input type="radio" name="gender" value="male"> Male</label>
                    <label><input type="radio" name="gender" value="female"> Female</label>
                </div>
                <b id="gender_error" class="error"></b><br>

                <button type="submit" class="reg">Register</button><br><br>
            </form>
        </div><br><br>
    </center>

<script>

document.getElementById('myForm').addEventListener('submit', function(event){
    event.preventDefault();
    let isValid = true;

    
    const name = document.getElementById('name').value.trim();
    const name_regex = /^[A-Za-z\s]+$/;
    const nameError = document.getElementById('nameError');

    if (name === "") {
        nameError.style.display = "block";
        nameError.innerHTML = "Name is required";
        isValid = false;
    } else if (name.length < 2) {
        nameError.style.display = "block";
        nameError.innerHTML = "Name must be at least 2 characters.";
        isValid = false;
    } else if (name.length > 7) {
        nameError.style.display = "block";
        nameError.innerHTML = "Name must be less than 7 characters.";
        isValid = false;
    } else if (!name_regex.test(name)) {
        nameError.style.display = "block";
        nameError.innerHTML = "Name can contain only letters and spaces.";
        isValid = false;
    } else {
        nameError.style.display = "none";
    }

    
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

    
    const num = document.getElementById('number').value;
    const numError = document.getElementById('num_error');

    if (num == "") {
        numError.style.display = "block";
        numError.innerHTML = "Number is required";
        isValid = false;
    } else if (num.length < 10) {
        numError.style.display = "block";
        numError.innerHTML = "Number must be 10 digits";
        isValid = false;
    } else if (num.length > 10) {
        numError.style.display = "block";
        numError.innerHTML = "Number must not exceed 10 digits";
        isValid = false;
    } else {
        numError.style.display = "none";
    }


    const age = document.getElementById('age').value;
    const ageError = document.getElementById('age_error');

    if (age === "") {
        ageError.style.display = "block";
        ageError.innerHTML = "Age is required";
        isValid = false;
    } else if (age < 10) {
        ageError.style.display = "block";
        ageError.innerHTML = "Age must be at least 10 years";
        isValid = false;
    } else if (age > 100) {
        ageError.style.display = "block";
        ageError.innerHTML = "Age must be below 100 years";
        isValid = false;
    } else {
        ageError.style.display = "none";
    }

    

    const gender = document.querySelector('input[name="gender"]:checked');
    const genderError = document.getElementById('gender_error');

    if (!gender) {
        genderError.style.display = "block";
        genderError.innerHTML = "Please select your gender";
        isValid = false;
    } else {
        genderError.style.display = "none";
    }

    
    if (isValid) {
        alert('Form submitted successfully!');
        document.getElementById('myForm').reset();
    }
});
</script>

    <?php include 'footer.php'; ?>
    
</body>
</html>
