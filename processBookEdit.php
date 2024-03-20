<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "book_pedlar";
    
    $conn = mysqli_connect($host, $username, $password, $database);
            
    if (!$conn) {
        die("Connection failed");}

    $book_name=$_REQUEST["BookName"];
    $author_name=$_REQUEST["Author"];
    $publisher=$_REQUEST["Publisher"];
    $mrp=$_REQUEST["mrp"];
    $selling_price=$_REQUEST["sellPrice"];
    $genre=$_REQUEST["genre"];
    $condition=$_REQUEST["condition"];
    $additional_info=$_REQUEST["addInfo"];
    $changeBookPic=$_REQUEST["changeBookPic"];

    if($_REQUEST['changeBookPic']==""){
        echo "No file uploaded or an error occurred during upload.";
    }else{
        echo($_REQUEST['changeBookPic']);
    }