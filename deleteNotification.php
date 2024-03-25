<?php
    $jsNotifyObject= json_decode($_POST['jsNotifyObject']);

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "book_pedlar";
    
    $conn = mysqli_connect($host, $username, $password, $database);
            
    if (!$conn) {
        die("Connection failed");}
    
    $sql="DELETE FROM user_notification where id='$jsNotifyObject->id'";
    mysqli_query($conn,$sql);