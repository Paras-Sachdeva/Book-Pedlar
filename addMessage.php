<?php
    $jsMessageObject= json_decode($_POST['jsMessageObject']);

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "book_pedlar";
    
    $conn = mysqli_connect($host, $username, $password, $database);
            
    if (!$conn) {
        die("Connection failed");}
    
    $sql="INSERT INTO user_chat (senderid, recieverid, message) VALUES ($jsMessageObject->senderid, $jsMessageObject->recieverid, '$jsMessageObject->message')";
    mysqli_query($conn,$sql);