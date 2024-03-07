<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Book Pedlar - Book Details</title>
    <link rel="stylesheet" href="styles.css?v=4">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="loader">
            <img src="Images/page-turning-book-animation-17.gif" alt="loading Image">
    </div>

<?php
            require("./Components/header.php");
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
                    // $status=$_REQUEST["status"];
                    $genre=$_REQUEST["genre"];
                    $condition=$_REQUEST["condition"];
                    $additional_info=$_REQUEST["additionalInfo"];
        
                    $sql="INSERT INTO book_data (bookname,userid,author,publisher,actualprice,sellprice,bookstatus,genre,bookcondition,addinfo,photo) VALUES ('$capitalize_book_name','$userid','$capitalize_author_name','$capitalize_publisher',$mrp,$selling_price,'Available','$genre','$condition','$additional_info','$fileName')";

                    mysqli_query($conn,$sql);
                    header("Location: Dashboard.php");
?>
<?php
        require("./Components/footer.php");
    ?>
</div>
<script src="script.js"></script>
</body>
</html>