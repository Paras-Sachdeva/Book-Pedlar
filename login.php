<?php
    session_start();

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "book_pedlar";
    
    $conn = mysqli_connect($host, $username, $password, $database);
    if (!$conn) {
        die("Connection failed");
    }
    
    $username = $_POST["loginUserName"];
    $password = $_POST["loginPassword"];

    $sql = "SELECT * FROM user_data WHERE username='$username'";
    $result = mysqli_query($conn,$sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row["password"];
        if (password_verify($password, $hashedPassword)) {
            // Login successful
            $_SESSION["userid"] = $row['id'];  //Session variable userid created
            header("Location: dashboard.php");  //Redirect to dashboard.php
        } else {
            header("Location: loginPage.php?error=InvalidPassword");
        }
    } else {
        header("Location: loginPage.php?error=InvalidUsername");
    }
    
    mysqli_close($conn);
