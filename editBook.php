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
        $photo=$row['photo'];
        $bookIdChange=$_GET['id'];
    ?>

    <div class="container" style="display:flex;background-color: #fff;border-radius: 8px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);overflow: hidden;width: 60rem;max-width: 90%;padding: 2rem;box-sizing: border-box;justify-content:space-evenly;">
        <div class="photo-section" style='margin:2rem; margin-right:6rem; width:30%'>
            <div id='book-photo-alone' style='width: 272px;height:320px;margin-top:2rem;border:0.6rem solid black;'></div>
            <div class="form-section" style="margin-top:2rem;">
            <?php
                echo("<form action='processBookEdit.php?id=$bookIdChange' method='POST' id='form1'>"); ?>
                    <label for="changeBookPic">Change Book Picture</label><br>
                    <input type="file" name="changeBookPic" id="changeBookPic" accept=".jpg, .jpeg, .png, .gif">
                    <div id="image-preview" style="margin: 1rem;"></div>
            </div>
        </div>
        <div class="edit-section1">
            <h2 style="text-align:center; font-weight:700;">BOOK EDIT</h2>
            <br><br>
            <label for="BookName">Book Name: </label><input type="text" id="BookName" name="BookName" class="book-input" value="<?php echo($row['bookname']); ?>"><br>
            <label for="Author">Author: </label><input type="text" id="Author" name="Author" class="book-input" value="<?php echo($row['author']); ?>"><br>
            <label for="Publisher">Publisher: </label><input type="text" id="Publisher" name="Publisher" class="book-input" value="<?php echo($row['publisher']); ?>"><br>
            <label for="mrp">MRP on Book: </label><input type="number" id="mrp" name="mrp" class="book-input" value="<?php echo($row['actualprice']); ?>"><br>
            <label for="sellPrice">Your Seling Price: </label><input type="number" id="sellPrice" name="sellPrice" class="book-input" value="<?php echo($row['sellprice']); ?>"><br>
            <label for="genre">Genre: </label><select id="genre" name="genre" class="book-select">
            <option value="<?php echo($row['genre']); ?>" selected><?php echo($row['genre']); ?></option>
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
            </select><br>
            <label for="condition">Book Condition: </label><select id="condition" name="condition" class="book-select">
                <option value="ogcondition" selected><?php echo($row['bookcondition']); ?></option>
                <option value="New">New</option>
                <option value="Like New">Like New</option>
                <option value="Very Good">Very Good</option>
                <option value="Good">Good</option>
                <option value="Acceptable">Acceptable</option>
                <option value="Fair">Fair</option>
                <option value="Poor">Poor</option>
            </select><br>
            <label for="status">Status of Book:</label>
            <select id="status" name="status" class="book-select">
                <option value="Available" selected>Available</option>
                <option value="Sold">Sold</option>
            </select><br>
            <label for="addInfo">Additional Info: </label><textarea id="addInfo" name="addInfo" rows="4" class="book-textarea"><?php echo($row['addinfo']); ?></textarea><br>
            </form>
            <button id="submitEditBook" style="margin-left:20rem;">Save Changes</button>
        </div>
    </div>

    <script>
        // Display Original Book Pic
        let jsBookPhoto="uploads/"+<?php echo json_encode($photo); ?>;
        let divPhoto=document.getElementById("book-photo-alone");
        divPhoto.style.backgroundImage="url('"+jsBookPhoto+"')";
        divPhoto.style.backgroundSize="325px 350px";

        // Book Pic Preview
        document.getElementById('changeBookPic').addEventListener('change', function() {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    var imgElement = document.createElement('img');
                    imgElement.src = event.target.result;
                    imgElement.style.maxWidth = '100%';
                    imgElement.style.maxHeight = '100%';
                    var previewContainer = document.getElementById('image-preview');
                    previewContainer.innerHTML = '';
                    previewContainer.appendChild(imgElement);
                };
                reader.readAsDataURL(file);
            }
        });

        // Submit Book Edit Form
        let submitBtn=document.getElementById("submitEditBook");
        submitBtn.addEventListener("click",function(){
            let form1=document.getElementById("form1");
            let form=document.getElementById("form2");
            form1.submit();
        })
        </script>
    <script src="JS/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>