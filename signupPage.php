<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Pedlar- Login/Register</title>
    <link rel="icon" href="Images/Icon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #333333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .content {
            display: none;
            height: auto;
        }

        .loader{
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            /* display: flex;
            flex-direction: column;
            align-items: center; */
            /* background: rgba(255, 255, 255, 0.9);  */
            padding: 20px;
            border-radius: 50%;
            z-index: 99; 
 
        }

        .loader img{
            width: 100px;
            height: 100px;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 400px;
            max-width: 90%;
            padding: 20px;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #666;
        }

        input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        .switch-form {
            text-align: center;
            margin-top: 10px;
        }

        .switch-form a {
            color: #007BFF;
            text-decoration: none;
            cursor: pointer;
        }

        .switch-form a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php
        require("./Components/loader.php");  //Loader Component
    ?>
    <div class="content">
        <div class="container">
            <h2>Welcome to Book Pedlar</h2>
            <form id="signupForm" class="form-group" action="signup.php" method="POST">
                <label for="signupName">User Name:</label>
                <input type="text" id="signupName" name="signupName" required>

                <label for="signupEmail">Email:</label>
                <input type="email" id="signupEmail" name="signupEmail" required>

                <label for="signupPassword">Password:</label>
                <div class="password-container" style="display:flex;">
                    <input type="password" id="signupPassword" name="signupPassword" required>
                    <i class="fa-solid fa-eye-slash" id="closed-eye-signup" style="margin-left:0.7rem;padding-top:0.6rem;cursor:pointer;"></i>
                    <i class="fa-solid fa-eye" id="open-eye-signup" style="margin-left:0.85rem;padding-top:0.6rem;display:none;cursor:pointer;"></i>
                </div>

                <button type="submit">Sign Up</button>
            </form>

            <div class="switch-form">
                <p>Already have an account? <a href="#" onclick="switchForm('loginForm')">Login here</a>.</p>
            </div>

            <form id="loginForm" class="form-group" action="login.php" method="POST" style="display: none;">
                <label for="loginUserName">User Name:</label>
                <input type="text" id="loginUserName" name="loginUserName" required>

                <label for="loginPassword">Password:</label>
                <div class="password-container" style="display:flex;">
                    <input type="password" id="loginPassword" name="loginPassword" required>
                    <i class="fa-solid fa-eye-slash" id="closed-eye-login" style="margin-left:0.7rem;padding-top:0.6rem;cursor:pointer;"></i>
                    <i class="fa-solid fa-eye" id="open-eye-login" style="margin-left:0.85rem;padding-top:0.6rem;display:none;cursor:pointer;"></i>
                </div>

                <button type="submit">Login</button>
            </form>

            <div class="switch-form">
                <p>Don't have an account? <a href="#" onclick="switchForm('signupForm')">Sign up here</a>.</p>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Switch between login and sign up forms
        function switchForm(formId) {
            document.getElementById('loginForm').style.display = formId === 'loginForm' ? 'block' : 'none';
            document.getElementById('signupForm').style.display = formId === 'signupForm' ? 'block' : 'none';
        }

        // Form Validations
        const urlParams = new URLSearchParams(window.location.search);
        const error = urlParams.get('error');
        if (error == 'InvalidEmail') {
            alert('Invalid email entered. Please provide a valid email address.');
        }
        if (error == 'UserNameAlreadytaken') {
            alert('User Name Already Taken');
        }
        if (error == 'EmailAlreadytaken') {
            alert('Email Already Exists');
        }
        if (error == 'InvalidPassword') {
            alert('Incorrect Password');
        }
        if (error == 'InvalidUsername') {
            alert('Incorrect User Name');
        }

        // Eye Toggle Password
        let eyeCloseLogin=document.getElementById("closed-eye-login");
        let eyeCloseSignup=document.getElementById("closed-eye-signup");
        let eyeOpenLogin=document.getElementById("open-eye-login");
        let eyeOpenSignup=document.getElementById("open-eye-signup");
        let passwordBoxLogin=document.getElementById("loginPassword");
        let passwordBoxSignup=document.getElementById("signupPassword");
        eyeOpenLogin.addEventListener("click",function(){
            eyeOpenLogin.style.display="none";
            eyeCloseLogin.style.display="block";
            passwordBoxLogin.type="text";
        });
        eyeCloseLogin.addEventListener("click",function(){
            eyeCloseLogin.style.display="none";
            eyeOpenLogin.style.display="block";
            passwordBoxLogin.type="password";
        });
        eyeOpenSignup.addEventListener("click",function(){
            eyeOpenSignup.style.display="none";
            eyeCloseSignup.style.display="block";
            passwordBoxSignup.type="text";
        });
        eyeCloseSignup.addEventListener("click",function(){
            eyeOpenSignup.style.display="none";
            eyeCloseSignup.style.display="block";
            passwordBoxSignup.type="text";
        });
    </script>
    <script src="JS/script.js"></script>      
</body>
</html>