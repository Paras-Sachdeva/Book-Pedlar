<?php
    $jsfollowObject= json_decode($_POST['jsfollowObject']);

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "book_pedlar";
    
    $conn = mysqli_connect($host, $username, $password, $database);
            
    if (!$conn) {
        die("Connection failed");}
    
    $sql1="INSERT INTO user_follow (userid, followingid) VALUES ($jsfollowObject->followingid, $jsfollowObject->followedid)";
    mysqli_query($conn,$sql1);