<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Pedlar - Edit Book</title>
    <link rel="icon" href="Images/Icon.png" type="image/x-icon">
    <link rel="stylesheet" href="Styles/styles.css?v=6">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php
        require("./Components/loader.php");  //Loader Component
    ?>    
    <div class="content">
    <?php
        require("./Components/header.php");  //Header Component

        //<!-- Navigation List -->
        echo("<div class='navList'>
                    <a href='index.php' class='linkAni'>Home</a>
                    <a href='dashboard.php' class='linkAni'>Profile</a>
                    <a href='#' class='linkAni'>Messages</a>
                    <a href='about.html' class='linkAni'>About Us</a>
                </div>");

        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "book_pedlar";

        $conn = mysqli_connect($host, $username, $password, $database);
            
        if (!$conn) {
            die("Connection failed");}

        $sql="SELECT * FROM book_data WHERE id='$_GET[id]'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);
    ?>

    <div class="container" style="display:flex;background-color: #fff;border-radius: 8px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);overflow: hidden;width: 350rem;max-width: 90%;padding: 2rem;box-sizing: border-box;justify-content:space-evenly;">
        <div class="photo-section" style='margin:2rem;margin-right:6rem;'>
            <div id='book-photo-alone' style='width: 272px;height:320px;margin-top:2rem;border:0.6rem solid black;'>
            </div>
        </div>
        <div class="edit-section1">
            <h2 style="text-align:center;">BOOK EDIT</h2>
            <br><br>
            <label for="BookName">Book Name: </label><input type="text" name="BookName" class="book-input" placeholder="<?php echo($row['bookname']); ?>"><br>
            <label for="AuthorName">Author Name: </label><input type="text" name="AuthorName" class="book-input" placeholder="<?php echo($row['author']); ?>"><br>
        </div>
        <!-- <div class="edit-section2"></div> -->
    </div>

    <script src="JS/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>