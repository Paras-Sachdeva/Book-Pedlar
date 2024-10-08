<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Pedlar - User Profile</title>
    <link rel="icon" href="Images/Icon.png" type="image/x-icon">
    <link rel="stylesheet" href="Styles/styles.css?v=44">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php
        require("./Components/loader.php");  //Loader Component

        echo("<div class='content'>");

        require("./Components/header.php");  //Header Component

        // <!-- Navigation List -->
        echo("<div class='navList'>
                    <a href='index.php' class='linkAni'>Home</a>
                    <a href='dashboard.php' class='linkAni'>Profile</a>
                    <a href='messages.php' class='linkAni'>Messages</a>
                    <a href='feed.php' class='linkAni'>Feed</a>
                </div>");
        echo("</div>");  // Header Div

        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "book_pedlar";
        $userid=$_GET['id'];

        $conn = mysqli_connect($host, $username, $password, $database);
        if (!$conn) {
            die("Connection failed");}
    ?>
        <!-- User Profile Section -->
        <div class="out-profile-books">
          <div class="profile" style="height:auto;">
            <h1>USER PROFILE</h1>
            <div class="pic" id="picture">
            </div>
            <div class="user-info">
                <?php
                    $follow_sql1="SELECT * FROM user_follow WHERE userid=$userid";
                    $follow_result1=mysqli_query($conn,$follow_sql1);
                    $follow_count1=mysqli_num_rows($follow_result1);
                    $follower_sql2="SELECT * FROM user_follow WHERE followingid=$userid";
                    $follower_result2=mysqli_query($conn,$follower_sql2);
                    $follower_count2=mysqli_num_rows($follower_result2);
                    $sql1 = "SELECT * FROM user_data WHERE id='$userid'";
                    $result1 = mysqli_query($conn,$sql1);
                    $row1 = mysqli_fetch_assoc($result1);
                    $latitude=$row1['latitude'];
                    $longitude=$row1['longitude'];
                    $user_name=$row1['username'];
                    $e_mail=$row1['email'];
                    echo("<div id='following-stats'>
                            <div id='followers'>");
                                if($follower_count2==1){
                                    echo("<p>$follower_count2 Follower</p>");
                                }else{
                                    echo("<p>$follower_count2 Followers</p>");
                                }
                    echo("</div>
                            <div id='following'>
                                <p>$follow_count1 Following</p>
                            </div>
                        </div>");
                    echo("<div class='strip' id='user-info-name'>
                                <div id='user-info-name-icon'>
                                    <i class='fa-solid fa-circle-user'></i>
                                </div>
                                <div id='user-info-name-text'>
                                    <p style='text-align:center;'>".$user_name."</p>
                                </div>
                            </div>
                            <div class='strip' id='user-info-email'>
                                <div id='user-info-email-icon'>
                                    <i class='fa-solid fa-envelope'></i>
                                </div>
                                <div id='user-info-email-text'>
                                    <p style='text-align:center;'>".$e_mail."</p>
                                </div>
                            </div>");
                    echo("<div class='strip' id='user-info-location'>
                                <div id='user-info-location-icon'>
                                    <i class='fa-solid fa-location-dot'></i>
                                </div>
                                <div id='user-info-location-text'>
                                    <p id='place-details' style='text-align:center;'></p>
                                </div>
                            </div>");
                    $uploadedFileName=$row1['profileImage'];
                ?>
            </div>
            <div class="follow-user">
                <?php 
                    $follow_sql="SELECT * FROM user_follow WHERE userid=$_SESSION[userid] AND followingid=$userid";
                    $follow_result=mysqli_query($conn, $follow_sql);
                    if(mysqli_num_rows($follow_result)>0){
                ?>
                        <button id="followUnfollow" style="margin-left:5rem;">UNFOLLOW</button>
                <?php
                    }else{
                ?>
                        <button id="followUnfollow" style="margin-left:5rem;">FOLLOW</button>
                <?php
                    }
                ?>
            </div>
        </div>
            
        <!-- User Uploaded Book Section -->
        <div class="user-books">
            <?php
                $sql4 = "SELECT * FROM book_data WHERE userid='$userid'";
                $result4 = mysqli_query($conn,$sql4);

                $arr1=array();
                $arr2=array();
                $arr3=array();
                $arr4=array();
                if (mysqli_num_rows($result4) > 0) {
                    while ($row4=mysqli_fetch_assoc($result4)) {
                        $book_name4=$row4['bookname'];
                        $author4=$row4['author'];
                        $publisher4=$row4['publisher'];
                        $actual_price4=$row4['actualprice'];
                        $sell_price4=$row4['sellprice'];
                        $book_status4=$row4['bookstatus'];
                        $genre4=$row4['genre'];
                        $book_condition4=$row4['bookcondition'];
                        $add_info4=$row4['addinfo'];
                        $photo4=$row4['photo'];
                        $book_id4=$row4['id'];
                        $flag=false;
                        $discount4=(int)((($actual_price4-$sell_price4)/$actual_price4)*100);
                        echo("<div class='book-outer'  id='book-outer-$book_id4'>
                                    <div class='book-inner1' id='book-$book_id4'></div>
                                    <div class='book-inner2'>
                                        <div class='heading-book' style='text-align:center;'>
                                            <b>\"$book_name4\"</b>
                                        </div>
                                        <div class='details-book'>
                                            <h5>Author</h5> $author4<br><br>

                                            <h5>Publisher</h5> $publisher4<br><br>
                                        
                                            <h5>Genre</h5> $genre4<br>
                                        </div>
                                        <div class='price-book'>
                                            <h2 style='color:green;text-decoration:none;display:inline;'>&#x20b9;$sell_price4</h2><br>
                                            <h6 style='color:red;text-decoration:line-through;display:inline;'>&#x20b9;$actual_price4</h6>
                                            <h4 style='color:green;display:inline;'>$discount4%</h4><h4 style='display:inline;'>off</h4>
                                        </div>
                                    </div>
                                </div>");
                        if($book_status4=='Sold'){
                            $flag=true;
                        }else{
                            $flage=false;
                        }
                        array_push($arr2,$book_id4);
                        array_push($arr1,$photo4);
                        array_push($arr3,$flag); 
                        array_push($arr4,$book_id4); 
                    }
                } else {
                    echo("<div class='no-books' style='background-color:#f5f5f5'>
                                User has not added any books
                            </div>");
                }        
            ?>
        </div>
        <?php
            echo("</div>");
            require("./Components/footer.php");
            echo("</div>"); //content div
            mysqli_close($conn);
        ?>
        <!-- JavaScript -->
        <script>
            // Upload Profile Photo
            let jsCheckPhoto = <?php echo json_encode($uploadedFileName); ?>;
            console.log(jsCheckPhoto);
            if(jsCheckPhoto!=''){    
                let uploading=document.getElementById("picture");
                uploading.style.backgroundImage="url('Uploads/"+jsCheckPhoto+"')";
                uploading.style.backgroundSize="300px 300px";
            }else{
                let uploading=document.getElementById("picture");
                uploading.style.backgroundImage="url('Images/ProfileImg.jpg')";
                uploading.style.backgroundSize="300px 300px";
            }

            // Upload User Book Photos
            let jsphoto=<?php echo json_encode($arr1); ?>;
            let jsphotoid=<?php echo json_encode($arr2); ?>;
            let jssoldphoto=<?php echo json_encode($arr3); ?>;
            let jsBookId=<?php echo json_encode($arr4); ?>;
            console.log(jsphoto);
            console.log(jsphotoid);
            for(let i=0;i<jsphoto.length;i++){
                let jsupload=document.getElementById("book-"+jsphotoid[i]);
                jsupload.style.backgroundImage="url('Uploads/"+jsphoto[i]+"')";
                jsupload.style.backgroundSize="280px 325px"; 
                let clickableDiv=document.getElementById("book-outer-"+jsBookId[i]);
                if(jssoldphoto[i]==true){
                    jsupload.innerHTML="<img src='Images/sold-rubber-stamp-free-png.webp' height='320px' width='280px'>";
                    clickableDiv.addEventListener("click",function(){
                        alert("Sorry, this book has been sold");
                    });
                }else{
                    clickableDiv.addEventListener("click",function(){
                        window.location.href = "FullBookInfo.php?book_id="+jsBookId[i]+"&again=1";
                    });
                }
            }

            // Get User Location Details
            let jsLatitude=<?php echo json_encode($latitude); ?>;
            let jsLongitude=<?php echo json_encode($longitude); ?>;
            function getPlaceDetails(latitude, longitude) {
                const apiUrl = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`;
                let placeDetailsDisplay = document.getElementById("place-details");
                fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    if (data && data.address) {
                        const city = data.address.city || data.address.village || data.address.town;
                        const state = data.address.state;
                        const country = data.address.country;
                        let placeDetails = '';

                        if (state) {
                            placeDetails += (placeDetails ? ', ' : '') + `State: ${state}`;
                        }else if (city) {
                            placeDetails += `City: ${city}`;
                        }
                        
                        if (country) {
                            placeDetails += (placeDetails ? ', ' : '') + `Country: ${country}`;
                        }
                        placeDetailsDisplay.innerText=placeDetails;
                    } else {
                        document.getElementById('result').textContent = 'Unable to fetch place details.';
                    }
                })
                .catch(error => {
                    console.error('Error fetching place details:', error);
                });
            }
            getPlaceDetails(jsLatitude,jsLongitude);
        </script>

        <script src="JS/script.js"></script>

        <script>
            // Follow/Unfollow click
            let followUnfollowBtn=document.getElementById("followUnfollow");
            let jsfollowingid=<?php echo json_encode($_SESSION['userid']); ?>;
            let jsfollowedid=<?php echo json_encode($userid); ?>;
            followUnfollowBtn.addEventListener("click",function(){
                if(followUnfollowBtn.innerText=="UNFOLLOW"){
                    let jsUnfollowObject={};
                    jsUnfollowObject.followingid=jsfollowingid;
                    jsUnfollowObject.followedid=jsfollowedid;
                    $.ajax({
                        url:"unfollowUser.php",
                        method:"POST",
                        data:{ jsUnfollowObject: JSON.stringify(jsUnfollowObject)},
                        success:function(response){
                            console.log(response);
                        }
                    });
                    setTimeout(function(){
                        location.reload();
                        followUnfollowBtn.innerText="FOLLOW";
                    },1000);
                }else if(followUnfollowBtn.innerText=="FOLLOW"){
                    let jsfollowObject={};
                    jsfollowObject.followingid=jsfollowingid;
                    jsfollowObject.followedid=jsfollowedid;
                    $.ajax({
                        url:"followUser.php",
                        method:"POST",
                        data:{ jsfollowObject: JSON.stringify(jsfollowObject)},
                        success:function(response){
                            console.log(response);
                        }
                    });
                    setTimeout(function(){
                        location.reload();
                        followUnfollowBtn.innerText="UNFOLLOW";
                    },1000);
                }
            });

            // Follower/Following Click
            let jsFollower=document.getElementById("followers");
            jsFollower.addEventListener("click",function(){
                window.location.href="userFollowList.php?id="+<?php echo json_encode($userid); ?>+"&scroll=No";
            });
            let jsFollowing=document.getElementById("following");
            jsFollowing.addEventListener("click",function(){
                window.location.href="userFollowList.php?id="+<?php echo json_encode($userid); ?>+"&scroll=Yes";
            });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</HTML>