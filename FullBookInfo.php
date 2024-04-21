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
            if(isset($_SESSION['userid'])){
                echo("<div class='navList'>
                            <a href='dashboard.php' class='linkAni'>Profile</a>
                            <a href='addBook.php' class='linkAni'>Add Book</a>
                            <a href='messages.php' class='linkAni'>Messages</a>
                            <a href='feed.php' class='linkAni'>Feed</a>
                        </div>");
                echo("</div>");  // Header Div
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
                        $sellerId=$row9['id'];
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
                        echo("<div class='search-results'>$book_name7</div><div class='outside-book-info'>");
                        echo("<div id='book-photo-alone'></div>
                        <div id='book-full-info'>
                            <h2>Book Details</h2><br>
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
                        </div>");
                        if($_GET['again']==0){
                            echo("<div id='book-seller-info'>
                                        <div id='seller-text'>
                                            <h2>Seller</h2>
                                            <br>
                                        </div>
                                        <div id='seller-pic'>
                                        </div>
                                        <div id='seller-info-text'>
                                            <ul>
                                                <li>Username: <b>$seller_username9</b></li><br>
                                                <li>Email: <b>$seller_email9</b></li><br>
                                                <li>Location: <b>$Final_distance</b></li>
                                            </ul>
                                        </div>
                                        <div>
                                            <button class='book-info-buttons' id='visit-seller-btn'>Visit Seller Profile</button>
                                        </div>
                                    </div>");                            
                        }
            }
            mysqli_close($conn);
            echo("</div>");
            require("./Components/footer.php");  
            echo("</div>");

    ?> 
        <script>
            // Display Seller Book Pic & Profile Pic
            let jsBookId=<?php echo json_encode($selected_bookid); ?>;
            let jsBookPhoto=<?php echo json_encode($photo7); ?>;
            let divPhoto=document.getElementById("book-photo-alone");
            divPhoto.style.backgroundImage="url('"+jsBookPhoto+"')";
            divPhoto.style.backgroundSize="275px 320px";    

            let jsCheckPhoto = <?php echo json_encode($seller_image9); ?>;
            console.log(jsCheckPhoto);
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

            // Interested Book Button
            let jsSmallPhotos=<?php echo json_encode($selected_bookid); ?>;
            let InterestedBtn=document.getElementById("interested-btn");
            InterestedBtn.addEventListener("click",function(){
                let jsObject={};
                jsObject.bookSeller=<?php echo json_encode($user_id7); ?>;
                jsObject.bookBuyer=<?php echo json_encode($userid); ?>;
                jsObject.bookId=<?php echo json_encode($selected_bookid); ?>;
                $.ajax({
                    url:"sendNotification.php",
                    method:"POST",
                    data:{ jsObject: JSON.stringify(jsObject)},
                    success:function(response){
                        console.log(response);
                    }
                });
                alert("The Book Seller has been notified.\nCheck Messages for further Updates.");
            });

            // Visit Seller Profile Button
            let visitSeller=document.getElementById("visit-seller-btn");
            visitSeller.addEventListener("click",function(){
                let sellerId=<?php echo json_encode($sellerId); ?>;
                window.location.href="sellerProfile.php?id="+sellerId;
            });
        </script>
        <script src="JS/script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>