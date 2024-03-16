<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Pedlar - Book Info</title>
    <link rel="icon" href="Images/Icon.png" type="image/x-icon">
    <link rel="stylesheet" href="Styles/styles.css?v=5">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php
            require("./Components/loader.php");  //Loader Component

            echo('<div class="content">');
    
            require("./Components/header.php");  //Header Component

            // <!-- Navigation List -->
            echo("<div class='navList'>
                        <a href='dashboard.php' class='linkAni'>Profile</a>
                        <a href='addBook.php' class='linkAni'>Add Book</a>
                        <a href='#' class='linkAni'>Messages</a>
                        <a href='about.html' class='linkAni'>About Us</a>
                   </div>");

            $host = "localhost";
            $username = "root";
            $password = "";
            $database = "book_pedlar";
            $userid=$_SESSION['userid'];

            $conn = mysqli_connect($host, $username, $password, $database);
            if (!$conn) {
                die("Connection failed");
            }

            $selected_bookid=$_GET['book_id'];
            $sql7="SELECT * FROM book_data WHERE id='$selected_bookid'";
            $sql8="SELECT * FROM user_data WHERE id='$userid'";
            $query_result7=mysqli_query($conn,$sql7);
            $row7=mysqli_fetch_array($query_result7);
            $book_name7=$row7['bookname'];
            $author7=$row7['author'];
            $publisher7=$row7['publisher'];
            $actual_price7=$row7['actualprice'];
            $sell_price7=$row7['sellprice'];
            $book_status7=$row7['bookstatus'];
            $genre7=$row7['genre'];
            $book_condition7=$row7['bookcondition'];
            $add_info7=$row7['addinfo'];
            $photo7="uploads/".$row7['photo'];
            $user_id7=$row7['userid'];
            $sql9="SELECT * FROM user_data WHERE id='$user_id7'";
            $query_result8=mysqli_query($conn,$sql8);
            $row8=mysqli_fetch_array($query_result8);
            $query_result9=mysqli_query($conn,$sql9);
            $row9=mysqli_fetch_array($query_result9);
            $seller_image9=$row9['profileImage'];
            $seller_username9=$row9['username'];
            $seller_email9=$row9['email'];
            $lat1=$row8['latitude'];
            $lat2=$row9['latitude'];
            $lon1=$row8['longitude'];
            $lon2=$row9['longitude'];
            $discount7=(int)((($actual_price7-$sell_price7)/$actual_price7)*100);
            function calculateDistance($lat1, $lon1, $lat2, $lon2) {
                $earthRadius = 6371;
            
                $latFrom = deg2rad($lat1);
                $lonFrom = deg2rad($lon1);
                $latTo = deg2rad($lat2);
                $lonTo = deg2rad($lon2);
            
                $latDelta = $latTo - $latFrom;
                $lonDelta = $lonTo - $lonFrom;
            
                $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
            
                $distance = $angle * $earthRadius;
            
                return $distance;
            }
            $Final_distance=(int)calculateDistance($lat1,$lon1,$lat2,$lon2);
            if($Final_distance==0){
                $Final_distance="Within 1km";
            }else{
                $Final_distance=$Final_distance."kms away";
            }
            echo("<div class='search-results'>$book_name7</div><div class='outside-book-info' style='width=100%;padding-bottom:5em;display: flex;flex-wrap: wrap;padding-left: 10rem;padding-right: 10rem;padding-top: 2rem;justify-content:space-around'>");
            echo("<div id='book-photo-alone' style='width: 272px;height:320px;margin-top:2rem;border:0.6rem solid black;'></div>
            <div id='book-full-info'>
                <h2 style='text-decoration:none;'>Book Details</h2><br>
                <ul>
                    <li>Author: <b>$author7</b></li><br>
                    <li>Publisher: <b>$publisher7</b></li><br>
                    <li>Genre: <b>$genre7</b></li><br>
                    <li>Condition of Book: <b>$book_condition7</b></li><br>
                    <li>MRP on Book: <b style='color:red;'><s>&#x20b9; $actual_price7</s></b></li><br>
                    <li>Second-Hand Price: <b style='color:green;font-size:2rem'>&#x20b9; $sell_price7</b></li><br>
                    <li>Discount: <b style='color:green;'>$discount7%</b></li><br>
                    <li>Additional Info: <b>$add_info7</b></li><br>
                    <li>Status: <b>$book_status7</b></li>
                </ul>
                <div>
                    <button class='book-info-buttons' id='interested-btn' Title='Notify the seller you are interested in this book'>INTERESTED</button>
                </div>
            </div>
            <div id='book-seller-info' style='padding-left:70px'>
                <div>
                    <h2 style='text-align:left;margin-left:3.5rem;text-decoration:none'>Seller</h2>
                    <br>
                </div>
                <div id='seller-pic' style='margin-top: 0.5rem;margin-left:1.5rem;height: 8.75rem;width: 8.75rem;border: 0.2rem solid black;border-radius: 50%;background-color: black; background-image:url('Images/ProfileImg.jpg'); background-size: 140px 140px;'>
                </div>
                <div style='margin-top:2rem;line-height:1rem;align-self:baseline;'>
                    <ul >
                        <li>Username: <b>$seller_username9</b></li><br>
                        <li>Email: <b>$seller_email9</b></li><br>
                        <li>Location: <b>$Final_distance</b></li>
                    </ul>
                </div>
                <div>
                    <button class='book-info-buttons' id='visit-seller-btn'>Visit Seller Profile</button>
                </div>
            </div>");
            mysqli_close($conn);
            require("./Components/footer.php");  
            echo("</div></div>");
    ?> 
        <script>
            let jsBookId=<?php echo json_encode($selected_bookid); ?>;
            let jsBookPhoto=<?php echo json_encode($photo7); ?>;
            let divPhoto=document.getElementById("book-photo-alone");
            divPhoto.style.backgroundImage="url('"+jsBookPhoto+"')";
            divPhoto.style.backgroundSize="325px 350px";    

            let jsCheckPhoto = <?php echo json_encode($seller_image9); ?>;
            console.log(jsCheckPhoto);
            if(jsCheckPhoto!=''){    
                    let uploading=document.getElementById("seller-pic");
                    uploading.style.backgroundImage="url('uploads/"+jsCheckPhoto+"')";
                    uploading.style.backgroundSize="140px 140px";
            }else{
                let uploading=document.getElementById("seller-pic");
                uploading.style.backgroundImage="url('Images/ProfileImg.jpg')";
                uploading.style.backgroundSize="140px 140px";
            }

            // Store Notification Details When User clicks Interested Button
            let InterestedBtn=document.getElementById("interested-btn");
            InterestedBtn.addEventListener("click",function(){
                alert("The Seller has been Notified, They will Contact You Shortly.\nCheck Your Message Box For Updates.");
                    let jsInterestedBook=<?php echo json_decode($selected_bookid); ?>;
                    let jsInterestedSeller=<?php echo json_decode($user_id7); ?>;
                    let jsInterestedBuyer=<?php echo json_decode($userid); ?>;
                    let jsObject={};
                    jsObject.bookId=jsInterestedBook;
                    jsObject.bookSeller=jsInterestedSeller;
                    jsObject.bookBuyer=jsInterestedBuyer;
                    $.ajax({
                        url:"sendNotification.php",
                        method:"POST",
                        data:{ jsObject: JSON.stringify(jsObject)},
                            success:function(response){
                                console.log(response);
                            }
                    });
            }); 
        </script>
        <script src="JS/script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>