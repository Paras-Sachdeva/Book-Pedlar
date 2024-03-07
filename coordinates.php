<?php
    $jsObject1= json_decode($_POST['jsObject1']);
    print_r($jsObject1);
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "book_pedlar";
    $conn = mysqli_connect($host, $username, $password, $database);
            
    if (!$conn) {
        die("Connection failed");}
    
    $sql7="UPDATE user_data SET latitude='$jsObject1->lati', longitude='$jsObject1->longi' WHERE id='$jsObject1->id'";
    mysqli_query($conn,$sql7);
