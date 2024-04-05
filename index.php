<!-- Home Page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Pedlar - Home Page</title>
    <link rel="icon" href="Images/Icon.png" type="image/x-icon">
    <link rel="stylesheet" href="Styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php
        require("./Components/loader.php");  //Loader Component
    ?>
    <div class="content">
        <?php
            require("./Components/header.php");  //Header Component

            // <!-- Navigation List -->
            if(isset($_SESSION['userid'])){
                echo("<div class='navList'>
                <a href='dashboard.php' class='linkAni'>Profile</a>
                <a href='addBook' class='linkAni'>Add Book</a>
                    <a href='#' class='linkAni'>Messages</a>
                    <a href='about.html' class='linkAni'>About Us</a>
                </div>");
            }else{
                echo("<div class='navList'>
                        <a href='signupPage.php' class='linkAni'>Create Profile</a>
                        <a href='loginPage.php' class='linkAni'>Buy Books</a>
                        <a href='loginPage.php' class='linkAni'>Sell Books</a>
                        <a href='about.html' class='linkAni'>About Us</a>
                    </div>");
            }
        ?>   
        <div class="outside-all-home-items">
            <div class="slider-container">
                <div class="slider">
                    <div class="slide">
                        <div class="slide-img"><img src="Images/Second Hand Book Trading Platform.jpg" alt="Slide 0"></div>
                    </div>
                    <div class="slide">
                        <div class="slide-img"><img src="Images/Steps.jpg" alt="Slide 1"></div>
                    </div>
                    <div class="slide">
                        <div class="slide-img"><img src="Images/Step1.jpg" alt="Slide 2"></div>
                    </div>
                    <div class="slide">
                        <div class="slide-img"><img src="Images/Step2.jpg" alt="Slide 3"></div>
                    </div>
                    <div class="slide">
                        <div class="slide-img"><img src="Images/Step3.jpg" alt="Slide 3"></div>
                    </div>
                    <div class="slide">
                        <div class="slide-img"><img src="Images/LastStep.jpg" alt="Slide 4"></div>
                    </div>
                </div>
                <i class="fa-solid fa-circle-chevron-left prev-slide"></i>
                <i class="fa-solid fa-circle-chevron-right next-slide"></i>
            </div>
  
        </div>
        <?php
            require("./Components/footer.php");  //Footer Component
        ?>
    </div>

    <!-- JavaScript -->
    <script src="JS/script.js"></script>
</body>
</html>