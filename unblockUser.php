<?php
    $jsUnblockUser= json_decode($_POST['jsUnblockUser']);

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "book_pedlar";
    
    $conn = mysqli_connect($host, $username, $password, $database);
            
    if (!$conn) {
        die("Connection failed");}
    
    $sql="DELETE FROM user_block where userid=$jsUnblockUser->userid AND blockedid=$jsUnblockUser->blockedid";
    mysqli_query($conn,$sql);