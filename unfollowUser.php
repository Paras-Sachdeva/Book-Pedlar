<?php
    $jsUnfollowObject= json_decode($_POST['jsUnfollowObject']);

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "book_pedlar";
    
    $conn = mysqli_connect($host, $username, $password, $database);
            
    if (!$conn) {
        die("Connection failed");}
    
    $sql="DELETE FROM user_follow where (userid='$jsUnfollowObject->followingid' AND followingid='$jsUnfollowObject->followedid')";
    mysqli_query($conn,$sql);