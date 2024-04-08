<?php
    $jsNotifyMeObj= json_decode($_POST['jsNotifyMeObj']);

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "book_pedlar";
    
    $conn = mysqli_connect($host, $username, $password, $database);
            
    if (!$conn) {
        die("Connection failed");}

    $sql="INSERT INTO book_notification (userid, bookname, author, publisher, priceRange, bookcondition, genre) VALUES ($jsNotifyMeObj->userid, '$jsNotifyMeObj->bookName', '$jsNotifyMeObj->authorName', '$jsNotifyMeObj->publisher', '$jsNotifyMeObj->priceRange', '$jsNotifyMeObj->bookCondition', '$jsNotifyMeObj->genre')";
    mysqli_query($conn,$sql);
