<?php
    $jsNotifyMeObj= json_decode($_POST['jsNotifyMeObj']);

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "book_pedlar";
    
    $conn = mysqli_connect($host, $username, $password, $database);
            
    if (!$conn) {
        die("Connection failed");}

    $sql1="SELECT * FROM book_notification WHERE (userid=$jsNotifyMeObj->userid AND bookname='$jsNotifyMeObj->bookName' AND author='$jsNotifyMeObj->authorName' AND publisher='$jsNotifyMeObj->publisher' AND priceRange='$jsNotifyMeObj->priceRange' AND bookcondition='$jsNotifyMeObj->bookCondition' AND genre='$jsNotifyMeObj->genre')";
    $result1=mysqli_query($conn, $sql1);
    
    if(mysqli_num_rows($result1)==0){
        $sql2="INSERT INTO book_notification (userid, bookname, author, publisher, priceRange, bookcondition, genre) VALUES ($jsNotifyMeObj->userid, '$jsNotifyMeObj->bookName', '$jsNotifyMeObj->authorName', '$jsNotifyMeObj->publisher', '$jsNotifyMeObj->priceRange', '$jsNotifyMeObj->bookCondition', '$jsNotifyMeObj->genre')";
        mysqli_query($conn,$sql2);
    }
