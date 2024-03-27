<?php
    session_start();
    
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "book_pedlar";
    $userid=$_SESSION['userid'];
     
    $conn = mysqli_connect($host, $username, $password, $database);
    if (!$conn) {
        die("Connection failed");}

    $sql1="DELETE FROM book_data WHERE userid=$userid";
    mysqli_query($conn,$sql1);
    $sql2="DELETE FROM user_chat WHERE senderid=$userid || recieverid=$userid";
    mysqli_query($conn,$sql2);
    $sql3="DELETE FROM user_notification WHERE userid=$userid || senderid=$userid";
    mysqli_query($conn,$sql3);
    $sql4="DELETE FROM user_data WHERE id=$userid";
    mysqli_query($conn,$sql4);

    $_SESSION = array();  //or session_unset();
    session_destroy();

    header("Location: index.php");  