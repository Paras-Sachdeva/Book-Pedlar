<?php
    $jsDelMessageObj= json_decode($_POST['jsDelMessageObj']);

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "book_pedlar";
    
    $conn = mysqli_connect($host, $username, $password, $database);
            
    if (!$conn) {
        die("Connection failed");}
    
    $sql="DELETE FROM user_chat where (senderid=$jsDelMessageObj->firstuserid AND recieverid=$jsDelMessageObj->seconduserid) OR (senderid=$jsDelMessageObj->seconduserid AND recieverid=$jsDelMessageObj->firstuserid)";
    mysqli_query($conn,$sql);