<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Pedlar - User Profile</title>
    <link rel="icon" href="Images/Icon.png" type="image/x-icon">
    <link rel="stylesheet" href="Styles/styles.css?v=27">
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
                    <a href='about.html' class='linkAni'>About Us</a>
                </div>");
        echo("</div>");  // Header Div

        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "book_pedlar";
        $userid=$_SESSION['userid'];
        if(isset($_GET['DelId'])){
            $delId=$_GET['DelId'];
        }else{
            $delId=0;
        }

        $conn = mysqli_connect($host, $username, $password, $database);
        if (!$conn) {
            die("Connection failed");
        }
    ?>
        <!-- User Profile Section -->
        <div class="out-profile-books">
          <div class="profile" style="height:auto;">
            <h1>YOUR PROFILE</h1>
            <div class="pic" id="picture">
            </div>
            <div class="user-info">
                <?php
                    $sql1 = "SELECT * FROM user_data WHERE id='$userid'";
                    $result1 = mysqli_query($conn,$sql1);
                    $row1 = mysqli_fetch_assoc($result1);
                    $follow_sql1="SELECT * FROM user_follow WHERE userid=$userid";
                    $follow_result1=mysqli_query($conn,$follow_sql1);
                    $follow_count1=mysqli_num_rows($follow_result1);
                    $follower_sql2="SELECT * FROM user_follow WHERE followingid=$userid";
                    $follower_result2=mysqli_query($conn,$follower_sql2);
                    $follower_count2=mysqli_num_rows($follower_result2);
                    $user_name=$row1['username'];
                    $e_mail=$row1['email'];
                    echo("<p style='text-align:center;'>".$user_name."<br>".$e_mail."</p>");
                    echo("<p id='place-details' style='text-align:center;'></p><br>");
                    $uploadedFileName=$row1['profileImage'];
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
                ?>
            </div>
            <div class="pic-form">
                <form action="" method="POST" enctype="multipart/form-data" id="uploadForm">
                    <label for="profilePicture">Upload Profile Picture</label><br>
                    <input type="file" name="profilePicture" id="profilePicture" accept=".jpg, .jpeg, .png, .gif">
                    <input type="submit" value="Upload" id="upload-btn">
                </form>
                <?php
                    if (isset($_FILES["profilePicture"]) && $_FILES["profilePicture"]["error"] == 0) {
                        $UploadsDirectory = 'Uploads/';
                        $uploadedFileName = $_FILES["profilePicture"]["name"];
                        $targetFilePath = $UploadsDirectory . $uploadedFileName;
                        move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $targetFilePath);
                        $sql = "UPDATE user_data SET profileImage='$uploadedFileName' WHERE id='$userid'";
                        mysqli_query($conn,$sql);
                    }else{
                    }
                ?>
            </div>
            <div class="add-book">
                <button id="openPageButton">ADD BOOK</button>
            </div>
            <div id="delete-account">
                <button>Delete Account</button>
            </div>
            <?php
                $sql2 = "SELECT * FROM user_notification WHERE userid='$userid'";
                $result2 = mysqli_query($conn,$sql2);
                $arr4=array();
                $arr5=array();
                $arr6=array();
                $arr7=array();
                $arr8=array();
                $arr9=array();
                $arr10=array();
                $arr11=array();
                $arr12=array();
                $arr13=array();
                $arr14=array();
                echo("<div class='outside-notifications'>");
                if(mysqli_num_rows($result2)>0){         
                    echo("<div class='notifications'>
                                <H2>USER NOTIFICATIONS</H2>
                            </div>
                            <div class='new-notification'>");
                    $i=0;
                    while($row2=mysqli_fetch_assoc($result2)){
                        array_push($arr6,$row2['id']);
                        array_push($arr7,$i);
                        array_push($arr11,$row2['id']);
                        $senderId=$row2['senderid'];
                        $sql3="SELECT * FROM user_data WHERE id='$senderId'";
                        $result3=mysqli_query($conn,$sql3);
                        $row3=mysqli_fetch_assoc($result3);
                        $senderName=$row3['username'];
                        array_push($arr13,$row3['id']);
                        array_push($arr4,$row3['profileImage']);
                        array_push($arr5,$senderId);
                        $bookId=$row2['bookid'];
                        $sql5="SELECT * FROM book_data WHERE id='$bookId'";
                        $result5=mysqli_query($conn,$sql5);
                        $row5=mysqli_fetch_assoc($result5);
                        array_push($arr14,$row5['id']);
                        $bookName=$row5['bookname'];
                        array_push($arr12,$row5['author']);
                        $bookPhoto=$row5['photo'];
                        array_push($arr8,$bookName);
                        array_push($arr9,$senderName);
                        array_push($arr10,$bookPhoto);
                        echo("  <div class='notify' id='$i'>
                                    <div class='small-buyer-pic' id='$senderId-$i'>
                                    </div>
                                    <div class='notification-content'><b>$senderName</b> is interested to buy <b>$bookName</b></div> 
                                </div>");
                        $i++;
                    }
                    echo("</div>");
                }
                $book_arr1=array();
                $book_arr2=array();
                $book_arr3=array();
                $book_arr4=array();
                $book_arr5=array();
                $book_arr6=array();
                $book_arr7=array();
                $sql7="SELECT * FROM book_notification WHERE (userid='$userid' && email=1)";
                $result7=mysqli_query($conn,$sql7);
                if(mysqli_num_rows($result7)>0){
                    echo("<div class='notifications'>
                                <H2>BOOK NOTIFICATIONS</H2>
                            </div>
                            <div class='new-notification'>");
                    $k=0;
                    while($row7=mysqli_fetch_assoc($result7)){
                        $sql8="SELECT * FROM book_data WHERE id=$row7[bookid]";
                        $result8=mysqli_query($conn,$sql8);
                        $row8=mysqli_fetch_assoc($result8);
                        $sql10="SELECT * FROM user_data WHERE id=$row8[userid]";
                        $result10=mysqli_query($conn,$sql10);
                        $row10=mysqli_fetch_assoc($result10);
                        echo(" <div class='notify' id='book-$k'>
                                <div class='book-pic-small' id='book-pic-$k'>
                                </div>");
                        echo("<div class='notification-content'>
                                    <span class='content-bookname'><b>$row8[bookname]</b></span>
                                    <span class='content-author'> $row8[author]</span>
                                    <span class='content-genre'> ($row8[genre])</span>
                                </div>
                            </div>");
                        array_push($book_arr1,$row8['photo']);
                        array_push($book_arr5,$row8['bookname']);
                        array_push($book_arr6,$row10['username']);
                        array_push($book_arr7,$row10['profileImage']);
                        array_push($book_arr2,$k);
                        array_push($book_arr3,$row8['id']);
                        array_push($book_arr4,$row7['id']);
                        $k++;
                    }
                    echo("</div>");
                }
                echo("</div>");
            ?>
        </div>

        <!-- User Uploaded Book Section -->
        <div class="user-block-list">
            <div class='block-head'>
                <p>Blocked Users</p>
            </div>
        <?php
            $BlockingId=$_GET['id'];
            $block_sql1="SELECT * FROM user_block WHERE userid=$BlockingId";
            $block_result1=mysqli_query($conn,$block_sql1);
            $b=0;
            $block_arr1=array();
            $block_arr2=array();
            while($block_row1=mysqli_fetch_assoc($block_result1)){
                $block_sql2="SELECT * FROM user_data WHERE id=$block_row1[blockedid]";
                $block_result2=mysqli_query($conn,$block_sql2);
                $block_row2=mysqli_fetch_assoc($block_result2);
                array_push($block_arr1,$block_row2['profileImage']);
                array_push($block_arr2,$block_row1['blockedid']);
                ?>
                    <div class="blocked-user" id="<?php echo($b."blocked"); ?>">
                        <div class="block-pic" id="<?php echo($b."block-pic"); ?>"></div>
                        <div class="block-name"><?php echo($block_row2['username']); ?></div>
                        <div class="block-option" id="<?php echo($b."block-option"); ?>">
                            <p>UNBLOCK</p>
                        </div>
                    </div>
                <?php
                $b++;
            }
        ?>
        </div>

        <?php
            echo("</div>");
            require("./Components/footer.php");
            echo("</div>"); //content div

            $sql6 = "SELECT * FROM user_notification WHERE userid='$userid'";
            $result6 = mysqli_query($conn,$sql6);
            $j=0;
            while($row6=mysqli_fetch_assoc($result6)){
        ?>
            <div class="box" id="<?php echo($j.'j'); ?>">
                <div class="notify-head">
                    <div class="notify-text"><h4>NOTIFICATION</h4></div>
                    <div class="notify-close-icon" id="<?php echo('j'.$j); ?>">
                        <i class="fa-solid fa-square-xmark close-icon" title="Close Notification"></i>
                    </div>
                </div>
                <div class="notify-content">
                    <div class="user-interested">
                        <div class="user-interested-pic" id="<?php echo($j.'0'); ?>"></div>
                        <div class="user-interested-name" id="<?php echo($j.'1'); ?>"><h6>Sample Name</h6></div>
                    </div>
                    <div class="interested-text"><p style="font-size:0.85rem;">Is looking forward to buy your Book</p></div>
                    <div class="interested-book">
                        <div class="interested-book-pic" id="<?php echo($j.'2'); ?>"></div>
                        <div class="interested-book-name" id="<?php echo($j.'3'); ?>"><h6>Sample Book Name</h6></div>
                    </div>
                </div>
                <div class="notify-btns">
                    <button class="notify-btn-approve" id="<?php echo('ApproveBtn'.$j); ?>">Approve Request & Start Chat</button>                    
                    <button class="notify-btn-delete" id="<?php echo('DelBtn'.$j); ?>">Delete Notification</button>                    
                </div>
            </div>
        <?php
                $j++;
            }
            $sql9 = "SELECT * FROM book_notification WHERE userid='$userid'";
            $result9 = mysqli_query($conn,$sql9);
            $m=0;
            while($row9=mysqli_fetch_assoc($result9)){
        ?>
                <div class="box2" id="<?php echo($m.'Box2'); ?>">
                    <div class="notify-head">
                        <div class="notify-text"><h4>NOTIFICATION</h4></div>
                        <div class="notify-close-icon" id="<?php echo('Close'.$m); ?>">
                            <i class="fa-solid fa-square-xmark close-icon" title="Close Notification"></i>
                        </div>
                    </div>
                    <div class="notify-content">
                        <div class="interested-book">
                            <div class="interested-book-pic" id="<?php echo($m.'2Box2'); ?>"></div>
                            <div class="interested-book-name" id="<?php echo($m.'3Box2'); ?>"><h6>Sample Book Name</h6></div>
                        </div>
                        <div class="interested-text"><p style="font-size:0.85rem;">Has Been Uploaded By User</p></div>
                        <div class="user-interested">
                            <div class="user-interested-pic" id="<?php echo($m.'0Box2'); ?>"></div>
                            <div class="user-interested-name" id="<?php echo($m.'1Box2'); ?>"><h6>Sample Name</h6></div>
                        </div>
                    </div>
                    <div class="notify-btns">
                        <button class="notify-btn-approve" id="<?php echo('BookApproveBtn'.$m); ?>">Book Details</button>                    
                        <button class="notify-btn-delete" id="<?php echo('BookDelBtn'.$m); ?>">Delete Notification</button>                    
                    </div>
                </div>
        <?php
                $m++;
            }
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

        // Get User Coordinates
        let userId=<?php echo json_encode($userid); ?>;
        navigator.geolocation.getCurrentPosition((position)=>{
        let latitude=position.coords.latitude;
        let longitude=position.coords.longitude;
        console.log(latitude+"  "+longitude);
        let jsObject1={};
        jsObject1.lati=latitude;
        jsObject1.longi=longitude;
        jsObject1.id=userId;
        $.ajax({
            url:"coordinates.php",
            method:"POST",
            data:{ jsObject1: JSON.stringify(jsObject1)},
            success:function(response){
                console.log(response);
            }
        });

        // Get User Location Details
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

                    if (city) {
                        placeDetails += `City: ${city}`;
                    }

                    if (state) {
                        placeDetails += (placeDetails ? ', ' : '') + `State: ${state}`;
                    }

                    if (country) {
                        placeDetails += (placeDetails ? ', ' : '') + `Country: ${country}`;
                    }
                    //const placeDetails = `City(${city || 'N/A'}), State(${state || 'N/A'}), Country(${country || 'N/A'})`;
                    placeDetailsDisplay.innerText="Location \n"+placeDetails;
                } else {
                    document.getElementById('result').textContent = 'Unable to fetch place details.';
                }
            })
            .catch(error => {
                console.error('Error fetching place details:', error);
            });
        }
        getPlaceDetails(latitude,longitude);
        });
    </script>

    <script src="JS/script.js"></script>

    <script>
        // Open Book Form Page
        document.addEventListener("DOMContentLoaded", function() {
            var openPageButton = document.getElementById("openPageButton");
            openPageButton.addEventListener("click", function() {
                window.location.href = "addBook.php";
            });
        });

        // Upload Notification Pics
        let jsSmallPhoto=<?php echo json_encode($arr4); ?>;
        let jsSmallSenderId=<?php echo json_encode($arr5); ?>;
        for(let i=0;i<jsSmallPhoto.length;i++){
            let jsSmallPhotoTag=document.getElementById(jsSmallSenderId[i]+'-'+i);
            let userNotifyPic=document.getElementById(i+"0");
            if(jsSmallPhoto[i]!=''){    
                jsSmallPhotoTag.style.backgroundImage="url('Uploads/"+jsSmallPhoto[i]+"')";
                jsSmallPhotoTag.style.backgroundSize="56px 56px";
                userNotifyPic.style.backgroundImage="url('Uploads/"+jsSmallPhoto[i]+"')";
                userNotifyPic.style.backgroundSize="80px 80px";
            }else{
                jsSmallPhotoTag.style.backgroundImage="url('Images/ProfileImg.jpg')";
                jsSmallPhotoTag.style.backgroundSize="56px 56px";
                userNotifyPic.style.backgroundImage="url('Images/ProfileImg.jpg')";
                userNotifyPic.style.backgroundSize="80px 80px";
            }
        }

        // User Notification Click Event
        let jsNotifyClick = <?php echo json_encode($arr6); ?>;
        let jsNotifyId = <?php echo json_encode($arr7); ?>;
        let bookNotifyNames=<?php echo json_encode($arr8); ?>;
        let userNotifyNames=<?php echo json_encode($arr9); ?>;
        let bookNotifyPics=<?php echo json_encode($arr10); ?>;

        let content = document.querySelector('.content');
        for(let i=0; i<jsNotifyId.length;i++){
            let jsNotifyBar=document.getElementById(jsNotifyId[i]);

            let userNotifyName=document.getElementById(i+"1");
            let bookNotifyName=document.getElementById(i+"3");
            let bookNotifyPic=document.getElementById(i+"2");

            let box=document.getElementById(i+"j");

            jsNotifyBar.addEventListener("click",function(event){
                console.log(i);
                var viewportWidth = window.innerWidth;
                var viewportHeight = window.innerHeight;
                var centerX = viewportWidth / 2;
                var centerY = viewportHeight / 2;

                content.classList.add('blur');
                content.style.pointerEvents = 'none';
                document.body.style.overflow = 'hidden';

                box.style.display="flex";
                box.style.flexDirection="column";
                box.style.transform = 'scale(2)';
                box.style.position = 'fixed';
                box.style.left = centerX - box.offsetWidth / 2 + 'px';
                box.style.top = centerY - box.offsetHeight / 2 + 'px';
                userNotifyName.innerHTML="<h6>"+userNotifyNames[i]+"</h6>";
                bookNotifyName.innerHTML="<h6>"+bookNotifyNames[i]+"</h6>";
                bookNotifyPic.style.backgroundImage="url('Uploads/"+bookNotifyPics[i]+"')";
                bookNotifyPic.style.backgroundSize="80px 80px";
            }); 
            let closeIcon=document.getElementById("j"+i);
            closeIcon.addEventListener("click",function(){
                box.style.display="none";
                content.classList.remove('blur');
                content.style.pointerEvents = 'auto';
                document.body.style.overflow = 'auto';
            });

            // Notification Delete Button
            let notifyDelIds = <?php echo json_encode($arr11); ?>;
            let DelBtn=document.getElementById("DelBtn"+i);
            DelBtn.addEventListener("click",function(){
                console.log("Delete Button Pressed");
                let jsNotifyObject={};
                jsNotifyObject.id=notifyDelIds[i];
                $.ajax({
                    url:"deleteNotification.php",
                    method:"POST",
                    data:{ jsNotifyObject: JSON.stringify(jsNotifyObject)},
                    success:function(response){
                        console.log(response);
                    }
                });
                let notifyBox=document.getElementById(i);
                notifyBox.style.backgroundColor="Red";
                setTimeout(function(){
                    location.reload()},2000);
            });

            // Notification Approve Button
            let senderid = <?php echo json_encode($userid); ?>;
            let bookAuthors = <?php echo json_encode($arr12); ?>;
            let userNotifyIds = <?php echo json_encode($arr13); ?>;
            let BookIds = <?php echo json_encode($arr14); ?>;
            let ApproveBtn=document.getElementById("ApproveBtn"+i);
            ApproveBtn.addEventListener("click",function(){
                let notifyBox=document.getElementById(i);
                notifyBox.style.backgroundColor="Green";
                let jsNotifyObject2={};
                jsNotifyObject2.senderid=senderid;
                jsNotifyObject2.recieverid=userNotifyIds[i];
                jsNotifyObject2.bookName=bookNotifyNames[i];
                jsNotifyObject2.bookAuthor=bookAuthors[i];
                jsNotifyObject2.bookId=BookIds[i];
                $.ajax({
                    url:"approveMessage.php",
                    method:"POST",
                    data:{ jsNotifyObject2: JSON.stringify(jsNotifyObject2)},
                    success:function(response){
                        console.log(response);
                    }
                });
                setTimeout(function(){
                    location.reload();
                    alert("Check Messages for Further Updates");
                },2000);
            });
        }

        // Alert for No Messages
        var queryParams = new URLSearchParams(window.location.search);
        var myVariable = queryParams.get('noMessages');
        if(myVariable=='y'){
            alert("You Have No Messages Yet");
            var urlParams = new URLSearchParams(window.location.search);
            urlParams.delete('noMessages');
            window.history.replaceState({}, '', `${window.location.pathname}?${urlParams}`);
        }  

        // Delete Account Button
        let jsSessionDel=<?php echo json_encode($delId); ?>;
        let delAccBtn=document.getElementById("delete-account");
        if(jsSessionDel==0){
            delAccBtn.addEventListener("click",function(){
                alert("Press Delete Account Again to Confirm");
                window.location.href="dashboard.php?DelId=1";
            });
        }else{
            setTimeout(() => {
                window.location.href="dashboard.php?DelId=0";
            }, 25000);
            delAccBtn.addEventListener("click",function(){
                window.location.href="deleteAccount.php";
            });
        }

        // Upload Book Notification Pics
        let jsSmallBookPics=<?php echo json_encode($book_arr1); ?>;
        for(let i=0;i<jsSmallBookPics.length;i++){
            let jsSmallBookTag=document.getElementById("book-pic-"+i);
            let BookNotifyPic=document.getElementById(i+"2Box2");
            jsSmallBookTag.style.backgroundImage="url('Uploads/"+jsSmallBookPics[i]+"')";
            jsSmallBookTag.style.backgroundSize="56px 56px";
            jsSmallBookTag.style.border="0.1rem solid black";
            BookNotifyPic.style.backgroundImage="url('Uploads/"+jsSmallBookPics[i]+"')";
            BookNotifyPic.style.backgroundSize="80px 80px";
        }

        // Book Notification Click Event
        let jsBookNotifyId = <?php echo json_encode($book_arr2); ?>;
        let BookNotifyNames=<?php echo json_encode($book_arr5); ?>;
        let UserNotifyNames=<?php echo json_encode($book_arr6); ?>;
        let UserNotifyPics=<?php echo json_encode($book_arr7); ?>;
        for(let i=0; i<jsBookNotifyId.length;i++){
            let jsBookNotifyBar=document.getElementById("book-"+i);

            let UserNotifyName=document.getElementById(i+"1Box2");
            let BookNotifyName=document.getElementById(i+"3Box2");
            let UserNotifyPic=document.getElementById(i+"0Box2");

            let box2=document.getElementById(i+"Box2");

            jsBookNotifyBar.addEventListener("click",function(event){
                console.log(i);
                var viewportWidth = window.innerWidth;
                var viewportHeight = window.innerHeight;
                var centerX = viewportWidth / 2;
                var centerY = viewportHeight / 2;

                content.classList.add('blur');
                content.style.pointerEvents = 'none';
                document.body.style.overflow = 'hidden';

                box2.style.display="flex";
                box2.style.flexDirection="column";
                box2.style.transform = 'scale(2)';
                box2.style.position = 'fixed';
                box2.style.left = centerX - box2.offsetWidth / 2 + 'px';
                box2.style.top = centerY - box2.offsetHeight / 2 + 'px';
                UserNotifyName.innerHTML="<h6>"+UserNotifyNames[i]+"</h6>";
                BookNotifyName.innerHTML="<h6>"+BookNotifyNames[i]+"</h6>";
                if(jsSmallPhoto[i]!=''){
                    UserNotifyPic.style.backgroundImage="url('Uploads/"+UserNotifyPics[i]+"')";
                    UserNotifyPic.style.backgroundSize="80px 80px";
                }else{
                    UserNotifyPic.style.backgroundImage="url('Images/ProfileImg.jpg')";
                    UserNotifyPic.style.backgroundSize="80px 80px";
            }
            }); 
            let BookCloseIcon=document.getElementById("Close"+i);
            BookCloseIcon.addEventListener("click",function(){
                box2.style.display="none";
                content.classList.remove('blur');
                content.style.pointerEvents = 'auto';
                document.body.style.overflow = 'auto';
            });
            // Notification Delete Button
            let BookNotifyDelIds = <?php echo json_encode($book_arr4); ?>;
            let BookDelBtn=document.getElementById("BookDelBtn"+i);
            BookDelBtn.addEventListener("click",function(){
                console.log("Delete Button Pressed");
                let jsBookNotifyObj={};
                jsBookNotifyObj.id=BookNotifyDelIds[i];
                $.ajax({
                    url:"deleteBookNotification.php",
                    method:"POST",
                    data:{ jsBookNotifyObj: JSON.stringify(jsBookNotifyObj)},
                    success:function(response){
                        console.log(response);
                    }
                });
                let BookNotifyBox=document.getElementById("book-"+i);
                BookNotifyBox.style.backgroundColor="Red";
                setTimeout(function(){
                    location.reload()},2000);
            });
            // Book Details Button
            let bookIdsApprove = <?php echo json_encode($book_arr3); ?>;
            let BookApproveBtn=document.getElementById("BookApproveBtn"+i);
            BookApproveBtn.addEventListener("click",function(){
                window.location.href="FullBookInfo.php?book_id="+bookIdsApprove[i]+"&again=0";
            });
        }

        // Upload Blocked User Pics
        let jsBlockPics=<?php echo json_encode($block_arr1); ?>;
        console.log(jsBlockPics);
        for(let i=0;i<jsBlockPics.length;i++){
            let jsBlockPicTag=document.getElementById(i+"block-pic");
            if(jsBlockPics[i]!=''){
                jsBlockPicTag.style.backgroundImage="url('Uploads/"+jsBlockPics[i]+"')";
                jsBlockPicTag.style.backgroundSize="112px 112px";
            }else{
                jsBlockPicTag.style.backgroundImage="url('Images/ProfileImg.jpg')";
                jsBlockPicTag.style.backgroundSize="112px 112px";
            }
        }

        // UNBLOCK Click
        let jsBlockIds=<?php echo json_encode($block_arr2); ?>;
        for(let i=0;i<jsBlockPics.length;i++){
            document.getElementById(i+"block-option").addEventListener("click",function(){
                document.getElementById(i+"block-option").innerHTML="<p style='font-size: 1rem;'>BLOCK</p>";
                let jsUnblockUser={};
                jsUnblockUser.userid=<?php echo json_encode($userid); ?>;
                jsUnblockUser.blockedid=jsBlockIds[i];
                $.ajax({
                    url:"unblockUser.php",
                    method:"POST",
                    data:{ jsUnblockUser: JSON.stringify(jsUnblockUser)},
                    success:function(response){
                        console.log(response);
                    }
                });
                setTimeout(function(){
                    location.reload()},1000);
            });
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</HTML>