<?php
    $jsObject= json_decode($_POST['jsNotifyObject2']);

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "book_pedlar";
    
    $conn = mysqli_connect($host, $username, $password, $database);
            
    if (!$conn) {
        die("Connection failed");}

    echo("Hi");
    
    $message="Conversation Started for Book: Name - ".$jsObject->bookName.", Author - ".$jsObject->bookAuthor;    
    
    $sql="INSERT INTO user_chat (senderid, recieverid, message) VALUES ($jsObject->senderid, $jsObject->recieverid,'$message')";
    mysqli_query($conn,$sql);

    $sql1="DELETE FROM user_notification WHERE (userid=$jsObject->senderid && senderid=$jsObject->recieverid && bookid=$jsObject->bookId)";
    mysqli_query($conn,$sql1);