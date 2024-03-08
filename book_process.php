<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Pedlar - Book Details</title>
</head>
<body>
     <?php
            require("./Components/header.php");  //Header Component
            
            $host = "localhost";
            $username = "root";
            $password = "";
            $database = "book_pedlar";
            $userid=$_SESSION['userid'];

            $conn = mysqli_connect($host, $username, $password, $database);
            if (!$conn) {
                die("Connection failed");}
  
            $fileName = $_FILES["bookPicture"]["name"];
            $fileTmpName = $_FILES["bookPicture"]["tmp_name"];
            $fileSize = $_FILES["bookPicture"]["size"];
            $fileType = $_FILES["bookPicture"]["type"];

            $destination = "uploads/" . $fileName;
            move_uploaded_file($fileTmpName, $destination);

            $book_name=$_REQUEST["bookName"];
            $capitalize_book_name=ucwords($book_name);
            $author_name=$_REQUEST["authorName"];
            $capitalize_author_name=ucwords($author_name);
            $publisher=$_REQUEST["publisher"];
            $capitalize_publisher=ucwords($publisher);
            $mrp=$_REQUEST["mrp"];
            $selling_price=$_REQUEST["sellingPrice"];
            $genre=$_REQUEST["genre"];
            $condition=$_REQUEST["condition"];
            $additional_info=$_REQUEST["additionalInfo"];
        
            $sql="INSERT INTO book_data (bookname,userid,author,publisher,actualprice,sellprice,bookstatus,genre,bookcondition,addinfo,photo) VALUES ('$capitalize_book_name','$userid','$capitalize_author_name','$capitalize_publisher',$mrp,$selling_price,'Available','$genre','$condition','$additional_info','$fileName')";

            mysqli_query($conn,$sql);
            header("Location: Dashboard.php");
    ?>
</body>
</html>