<?php
    $jsObject= json_decode($_POST['jsObject']);
    print_r($jsObject);

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "book_pedlar";
    
    $conn = mysqli_connect($host, $username, $password, $database); 
    if (!$conn) {
        die("Connection failed");
    }

    $sql="INSERT INTO user_notification (userid, senderid, bookid) VALUES ($jsObject->bookSeller, $jsObject->bookBuyer, $jsObject->bookId)";
    mysqli_query($conn,$sql);