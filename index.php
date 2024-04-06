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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
                        <a href='about.php' class='linkAni'>About Us</a>
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
            <div class="ribbon">
                <div class="quote1">
                    <p>"Bringing Books to Life, Second Hand, First Choice"</p>
                </div>
            </div>
            <div class="ribbon">
                <div class="quote2">
                    <p>"Cultivating Green Minds, One Book at a Time"</p>
                </div>
            </div>
            <div class="ribbon">
                <div class="quote3">
                    <p>"Your Gateway to Affordable Reading Pleasure"</p>
                </div>
            </div>
            <div class="ribbon">
                <div class="quote4">
                    <p>"Building Bridges Between Book Lovers and Bargain Hunters"</p>
                </div>
            </div>
        </div>
        <?php
            require("./Components/footer.php");  //Footer Component
        ?>
    </div>

    <!-- JavaScript -->
    <script src="JS/script.js"></script>
    <script>
        // Image Slider
        $(document).ready(function() {
            var slideIndex = 0;
            var slides = $('.slide');
            var totalSlides = slides.length;
            var slideInterval = 4000; // 4 seconds
            var slideTimer;

            // Function to move to the next slide
            function nextSlide() {
            slideIndex = (slideIndex + 1) % totalSlides;
            updateSlider();
            }

            // Function to move to the previous slide
            function prevSlide() {
              slideIndex = (slideIndex - 1 + totalSlides) % totalSlides;
              updateSlider();
            }

            // Set interval to move to the next slide
            function startSlideTimer() {
              slideTimer = setInterval(nextSlide, slideInterval);
            }

            // Start the slide timer
            startSlideTimer();

            // Pause slide transition on hover
            $('.slider-container').hover(
                function() {
                clearInterval(slideTimer);
                },
                function() {
                startSlideTimer();
                }
            );

            // Previous slide button click event
            $('.prev-slide').click(function() {
              clearInterval(slideTimer);
              prevSlide();
              startSlideTimer();
            });

            // Next slide button click event
            $('.next-slide').click(function() {
              clearInterval(slideTimer);
              nextSlide();
              startSlideTimer();
            });

            // Function to update slider position
            function updateSlider() {
            var slideWidth = $('.slide').width();
            var slidePosition = -slideIndex * slideWidth;
            $('.slider').css('transform', 'translateX(' + slidePosition + 'px)');
            }
        });
    </script>
</body>
</html>