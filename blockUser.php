<?php
    $jsBlockUserObj= json_decode($_POST['jsBlockUserObj']);

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "book_pedlar";
    
    $conn = mysqli_connect($host, $username, $password, $database);
            
    if (!$conn) {
        die("Connection failed");}
    
    $sql="INSERT INTO user_block (userid, blockedid) VALUES ($jsBlockUserObj->userid, $jsBlockUserObj->blockedid)";
    mysqli_query($conn,$sql);
