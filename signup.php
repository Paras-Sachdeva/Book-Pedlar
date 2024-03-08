<?php

    session_start();

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "book_pedlar";

    $conn = mysqli_connect($host, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST["signupName"];
    $password = $_POST["signupPassword"];
    $hashedPassword=password_hash($password,PASSWORD_DEFAULT);
    $email = $_POST["signupEmail"];

    $sql2 = "SELECT * from user_data where username='$username'";
    $result2 = mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2)>0){
        header("Location: signupPage.php?error=UserNameAlreadytaken");
    }

    $sql3 = "SELECT * from user_data where email='$email'";
    $result3 = mysqli_query($conn,$sql3);
    if(mysqli_num_rows($result3)>0){
        header("Location: signupPage.php?error=EmailAlreadytaken");
    }


    function validateEmail($email) {
        global $username, $conn, $hashedPassword;
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = "INSERT INTO user_data (username, password, email) VALUES ('$username', '$hashedPassword', '$email')";
            if (mysqli_query($conn,$sql) === TRUE) {
                $sql1 = "SELECT * FROM user_data WHERE username='$username'";
                $result = mysqli_query($conn,$sql1);
                $row = mysqli_fetch_assoc($result);
                $_SESSION["userid"] = $row['id'];
                header("Location: dashboard.php");
            } else {
                echo "Error";
            }
            mysqli_close($conn);
        } else {
            header("Location: signup.php?error=InvalidEmail");
        } 
    }
    validateEmail($email);