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
    ?>

    <div class="container">
    </div>

    <script src="JS/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>