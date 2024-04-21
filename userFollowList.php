<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Pedlar - User Follow List</title>
    <link rel="icon" href="Images/Icon.png" type="image/x-icon">
    <link rel="stylesheet" href="Styles/styles.css?v=43">
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
          <div class="profile" style="height:auto; flex-shrink:0.5;">
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
                        <button id="followUnfollow">UNFOLLOW</button>
                <?php
                    }else{
                ?>
                        <button id="followUnfollow">FOLLOW</button>
                <?php
                    }
                ?>
            </div>
        </div>

        <div class="follower-following">
            <!-- Followers List -->
            <div class="user-follower-list">
                <div class='follower-head'>
                    <p>FOLLOWERS</p>
                </div>
            <?php
                $MainUserId=$userid;
                $follow_sql1="SELECT * FROM user_follow WHERE followingid=$MainUserId";
                $follow_result1=mysqli_query($conn,$follow_sql1);
                $b=0;
                $follow_arr1=array();
                $follow_arr2=array();
                if(mysqli_num_rows($follow_result1)>0){
                    $follower_exist=1;
                    while($follow_row1=mysqli_fetch_assoc($follow_result1)){
                        $follow_sql2="SELECT * FROM user_data WHERE id=$follow_row1[userid]";
                        $follow_result2=mysqli_query($conn,$follow_sql2);
                        $follow_row2=mysqli_fetch_assoc($follow_result2);
                        array_push($follow_arr1,$follow_row2['profileImage']);
                        array_push($follow_arr2,$follow_row1['userid']);
                        ?>
                            <div class="follower-user" id="<?php echo($b."follower"); ?>">
                                <div class="follower-pic" id="<?php echo($b."follower-pic"); ?>"></div>
                                <div class="follower-name"><?php echo($follow_row2['username']); ?></div>
                            </div>
                        <?php
                        $b++;
                    }
                }else{
                    $follower_exist=0;
                    echo("<p style='font-size: 2rem;margin-left:24.5rem;margin-bottom:2.5rem;'>No Followers Found</p>");
                }
            ?>
            </div>
    
            <!-- Following List -->
            <div id="user-following-list">
                <div class='following-head' id='following-head'>
                    <p>FOLLOWING</p>
                </div>
            <?php
                $follow_sql3="SELECT * FROM user_follow WHERE userid=$MainUserId";
                $follow_result3=mysqli_query($conn,$follow_sql3);
                $c=0;
                $follow_arr3=array();
                $follow_arr4=array();
                if(mysqli_num_rows($follow_result3)>0){
                    $following_exist=1;
                    while($follow_row3=mysqli_fetch_assoc($follow_result3)){
                        $follow_sql4="SELECT * FROM user_data WHERE id=$follow_row3[followingid]";
                        $follow_result4=mysqli_query($conn,$follow_sql4);
                        $follow_row4=mysqli_fetch_assoc($follow_result4);
                        array_push($follow_arr3,$follow_row4['profileImage']);
                        array_push($follow_arr4,$follow_row3['followingid']);
                        ?>
                            <div class="following-user" id="<?php echo($c."following"); ?>">
                                <div class="following-pic" id="<?php echo($c."following-pic"); ?>"></div>
                                <div class="following-name"><?php echo($follow_row4['username']); ?></div>
                            </div>
                        <?php
                        $c++;
                    }
                }else{
                    $following_exist=0;
                    echo("<p style='font-size: 2rem;margin-left:24.5rem;margin-bottom:2.5rem;'>Not Following Any User</p>");
                }
            ?>
            </div>
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

            let jsFollowerExist=<?php echo json_encode($follower_exist); ?>;
            let jsFollowerIds=<?php echo json_encode($follow_arr2); ?>;
            if(jsFollowerExist==1){
                // Upload Follower User Pics
                let jsFollowerPics=<?php echo json_encode($follow_arr1); ?>;
                for(let i=0;i<jsFollowerPics.length;i++){
                    let jsFollowerPicTag=document.getElementById(i+"follower-pic");
                    if(jsFollowerPics[i]!=''){
                        jsFollowerPicTag.style.backgroundImage="url('Uploads/"+jsFollowerPics[i]+"')";
                        jsFollowerPicTag.style.backgroundSize="112px 112px";
                    }else{
                        jsFollowerPicTag.style.backgroundImage="url('Images/ProfileImg.jpg')";
                        jsFollowerPicTag.style.backgroundSize="112px 112px";
                    }
                }
    
                // Username or Pic Click
                let followerPics=document.getElementsByClassName("follower-pic");
                let followerNames=document.getElementsByClassName("follower-name");
                for(let i=0;i<jsFollowerPics.length;i++){
                    followerPics[i].addEventListener("click",function(){
                        window.location.href="userProfile.php?id="+jsFollowerIds[i];
                    });
                    followerNames[i].addEventListener("click",function(){
                        window.location.href="userProfile.php?id="+jsFollowerIds[i];
                    });
                }
            }
            
            let jsFollowingExist=<?php echo json_encode($following_exist); ?>;
            let jsFollowingIds=<?php echo json_encode($follow_arr4); ?>;
            if(jsFollowingExist==1){
                // Upload Following User Pics
                let jsFollowingPics=<?php echo json_encode($follow_arr3); ?>;
                for(let i=0;i<jsFollowingPics.length;i++){
                    let jsFollowingPicTag=document.getElementById(i+"following-pic");
                    if(jsFollowingPics[i]!=''){
                        jsFollowingPicTag.style.backgroundImage="url('Uploads/"+jsFollowingPics[i]+"')";
                        jsFollowingPicTag.style.backgroundSize="112px 112px";
                    }else{
                        jsFollowingPicTag.style.backgroundImage="url('Images/ProfileImg.jpg')";
                        jsFollowingPicTag.style.backgroundSize="112px 112px";
                    }
                }
    
                // Username or Pic Click
                let followingPics=document.getElementsByClassName("following-pic");
                let followingNames=document.getElementsByClassName("following-name");
                for(let i=0;i<jsFollowingPics.length;i++){
                    followingPics[i].addEventListener("click",function(){
                        window.location.href="userProfile.php?id="+jsFollowingIds[i];
                    });
                    followingNames[i].addEventListener("click",function(){
                        window.location.href="userProfile.php?id="+jsFollowingIds[i];
                    });
                }
            }
            
            let queryParameter = new URLSearchParams(window.location.search);
            let jsScroll = queryParameter.get('scroll');
            if(jsScroll=="Yes" && jsFollowerExist==1){
                let jsFollowerPicsScroll=<?php echo json_encode($follow_arr1); ?>;
                let followerLength=jsFollowerPicsScroll.length-1;
                setTimeout(() => {
                    document.getElementById(followerLength+"follower").scrollIntoView({ behavior: "smooth" });
                }, 1500);
            }
    
            // Following Click
            let jsFollowing=document.getElementById("following");
            jsFollowing.addEventListener("click",function(){
                window.location.href="userFollowList.php?id="+<?php echo json_encode($userid); ?>+"&scroll=Yes";
            });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</HTML>