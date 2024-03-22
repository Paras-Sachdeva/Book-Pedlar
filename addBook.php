<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Pedlar - Book Details</title>
    <link rel="icon" href="Images/Icon.png" type="image/x-icon">
    <link rel="stylesheet" href="Styles/styles.css?v=3">
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
        <h2 id="book-h2">Book Details Form</h2>
        <form action="book_process.php" method="post" enctype="multipart/form-data" id="book-form">
            <!-- Book Picture Input -->
            <label for="bookPicture">Book Picture:</label>
            <input type="file" id="bookPicture" name="bookPicture" accept=".jpg, .jpeg, .png, .gif" class="book-input">

            <!-- Book Name Input -->
            <label for="bookName">Book Name:</label>
            <input type="text" id="bookName" name="bookName" required class="book-input">

            <!-- Author Name Input -->
            <label for="authorName">Author Name:</label>
            <input type="text" id="authorName" name="authorName" required class="book-input">

            <!-- Publisher Input -->
            <label for="publisher">Publisher:</label>
            <input type="text" id="publisher" name="publisher" class="book-input">

            <!-- MRP on Book Input -->
            <label for="mrp">MRP on Book:</label>
            <input type="number" id="mrp" name="mrp" required class="book-input">

            <!-- User Selling Price Input -->
            <label for="sellingPrice">Your Selling Price:</label>
            <input type="number" id="sellingPrice" name="sellingPrice" required class="book-input">

            <!-- Genre of Book (Select Tag) -->
            <label for="genre">Genre of Book:</label>
            <select id="genre" name="genre" required class="book-select">
                <option value="Fiction">Fiction</option>
                <option value="Non-Fiction">Non-Fiction</option>
                <option value="Romance">Romance</option>
                <option value="Science-Fiction (Sci-Fi)">Science Fiction (Sci-Fi)</option>
                <option value="Educational">Educational</option>
                <option value="Current Affairs">Current Affairs</option>
                <option value="Technology">Technology</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Horror">Horror</option>
                <option value="Thriller">Thriller</option>
                <option value="Historical Fiction">Historical Fiction</option>
                <option value="Biography">Biography</option>
                <option value="Autobiography">Autobiography</option>
                <option value="Poetry">Poetry</option>
                <option value="Self Help">Self-Help</option>
                <option value="Business & Economics">Business & Economics</option>
                <option value="Science">Science</option>
                <option value="Philosophy">Philosophy</option>
                <option value="Travel">Travel</option>
                <option value="Children">Children's</option>
                <option value="Young Adult">Young Adult</option>
                <option value="Classics">Classics</option>
            </select>

            <!-- Book Condition (Select Tag) -->
            <label for="condition">Book Condition:</label>
            <select id="condition" name="condition" required class="book-select">
                <option value="New">New</option>
                <option value="Like New">Like New</option>
                <option value="Very Good">Very Good</option>
                <option value="Good">Good</option>
                <option value="Acceptable">Acceptable</option>
                <option value="Fair">Fair</option>
                <option value="Poor">Poor</option>
            </select>

            <!-- Additional Info (Textarea) -->
            <label for="additionalInfo">Additional Info:</label>
            <textarea id="additionalInfo" name="additionalInfo" rows="4" class="book-textarea"></textarea>

            <!-- Submit Button -->
            <input type="submit" id="book-btn"></input>
        </form>
    </div>
    <?php
        require("./Components/footer.php");
    ?>
</div>
<script src="JS/script.js"></script>
</body>
</html>