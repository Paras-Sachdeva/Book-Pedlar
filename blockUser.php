<?php
    $jsBlockUserObj= json_decode($_POST['jsBlockUserObj']);

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "book_pedlar";
    
    $conn = mysqli_connect($host, $username, $password, $database);
            
    if (!$conn) {
        die("Connection failed");}
    
    $sql1="INSERT INTO user_block (userid, blockedid) VALUES ($jsBlockUserObj->userid, $jsBlockUserObj->blockedid)";
    mysqli_query($conn,$sql1);

    $sql2="DELETE FROM user_follow WHERE ((userid=$jsBlockUserObj->userid AND followingid=$jsBlockUserObj->blockedid) OR (userid=$jsBlockUserObj->blockedid AND followingid=$jsBlockUserObj->userid))";
    mysqli_query($conn,$sql2);