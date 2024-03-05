<?php
    $jsObject= json_decode($_POST['jsObject']);
    print_r($jsObject);
    echo($jsObject->id);

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "book_pedlar";
    
    $conn = mysqli_connect($host, $username, $password, $database);
            
    if (!$conn) {
        die("Connection failed");}
    
    $sql="DELETE FROM book_data where id='$jsObject->id'";
    mysqli_query($conn,$sql);