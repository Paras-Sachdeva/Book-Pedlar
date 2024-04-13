<?php
    $jsBookNotifyObj= json_decode($_POST['jsBookNotifyObj']);

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "book_pedlar";
    
    $conn = mysqli_connect($host, $username, $password, $database);
            
    if (!$conn) {
        die("Connection failed");}
    
    $sql="DELETE FROM book_notification where id='$jsBookNotifyObj->id'";
    mysqli_query($conn,$sql);