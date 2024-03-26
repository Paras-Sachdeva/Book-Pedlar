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
    $bookStatus=$_REQUEST['status'];
    // $changeBookPic=$_REQUEST["changeBookPic"];
    $bookId=$_GET['id'];

    $fileName = $_FILES["changeBookPic"]["name"];
    $fileTmpName = $_FILES["changeBookPic"]["tmp_name"];
    $fileSize = $_FILES["changeBookPic"]["size"];
    $fileType = $_FILES["changeBookPic"]["type"];

    if($fileName==""){
        $sql1="UPDATE book_data SET bookname='$book_name',author='$author_name',publisher='$publisher',actualprice=$mrp,sellprice=$selling_price,bookstatus='$bookStatus',genre='$genre',bookcondition='$condition',addinfo='$additional_info' WHERE id='$bookId'";
        mysqli_query($conn,$sql1);
    }else{
        $sql2="UPDATE book_data SET bookname='$book_name',author='$author_name',publisher='$publisher',actualprice=$mrp,sellprice=$selling_price,bookstatus='$bookStatus',genre='$genre',bookcondition='$condition',addinfo='$additional_info', photo='$fileName' WHERE id='$bookId'";
        mysqli_query($conn,$sql2);
        $destination = "Uploads/" . $fileName;
        move_uploaded_file($fileTmpName, $destination);
    }

    header("Location: dashboard.php");