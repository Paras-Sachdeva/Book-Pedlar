<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Pedlar - User Profile</title>
    <link rel="icon" href="Images/Icon.png" type="image/x-icon">
    <link rel="stylesheet" href="Styles/styles.css?v=2">
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
                    <a href='addBook.php' class='linkAni'>Add Book</a>
                    <a href='messages.php' class='linkAni'>Messages</a>
                    <a href='about.html' class='linkAni'>About Us</a>
                </div>");

        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "book_pedlar";
        $userid=$_SESSION['userid'];

        $conn = mysqli_connect($host, $username, $password, $database);
        if (!$conn) {
            die("Connection failed");}
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
                    $user_name=$row1['username'];
                    $e_mail=$row1['email'];
                    echo("<p style='text-align:center;'>".$user_name."<br>".$e_mail."</p>");
                    echo("<p id='place-details' style='text-align:center;'></p>");
                    $uploadedFileName=$row1['profileImage'];
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
                if(mysqli_num_rows($result2)>0){            
                    echo("<div class='outside-notifications'>
                                <div class='notifications'>
                                    <H2>NOTIFICATIONS</H2>
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
                                    <div class='notification-content'><b>$senderName</b> is interested to buy <b>\"$bookName\"</b></div> 
                                </div>");
                        $i++;
                    }
                    echo("</div></div>");
                }
            ?>
        </div>
        <!-- User Uploaded Book Section -->
        <div class="user-books">
            <?php
                $sql4 = "SELECT * FROM book_data WHERE userid='$userid'";
                $result4 = mysqli_query($conn,$sql4);

                $arr1=array();
                $arr2=array();
                $arr3=array();
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
                        echo("<div class='book-outer'>
                                    <div class='book-inner1' id='book-$book_id4'></div>
                                    <div class='book-inner2'>
                                        <div class='heading-book' style='text-align:center;'>
                                            <b>\"$book_name4\"</b>
                                        </div>
                                        <div class='details-book'>
                                            <h5>Author</h5> $author4<br><br>
                                        
                                            <h5>Genre</h5> $genre4<br>
                                        </div>
                                        <div class='price-book'>
                                            <h2 style='color:green;text-decoration:none;display:inline;'>&#x20b9;$sell_price4</h2><br>
                                            <h6 style='color:red;text-decoration:line-through;display:inline;'>&#x20b9;$actual_price4</h6>
                                            <h4 style='color:green;display:inline;'>$discount4%</h4><h4 style='display:inline;'>off</h4>
                                        </div>
                                        <div class='deleteEdit-book'>
                                            <br>
                                            <button name='editbook' class='edit-book' id='$book_id4!'>Edit Book</button>
                                            <button name='removebook' class='remove-book' id='$book_id4'>Remove Book</button>
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
                    }
                } else {
                    echo("<div class='no-books' style='background-color:#f5f5f5'>
                                You have not added any books<br>Click on <h2 style='text-decoration:none;text-align:center'>ADD BOOK</h2>
                            </div>");
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
                <div id="notify-head">
                    <div id="notify-text"><h4>NOTIFICATION</h4></div>
                    <div class="notify-close-icon" id="<?php echo('j'.$j); ?>">
                        <i class="fa-solid fa-square-xmark close-icon" title="Close Notification"></i>
                    </div>
                </div>
                <div id="notify-content">
                    <div id="user-interested">
                        <div class="user-interested-pic" id="<?php echo($j.'0'); ?>"></div>
                        <div class="user-interested-name" id="<?php echo($j.'1'); ?>"><h6>Sample Name</h6></div>
                    </div>
                    <div id="interested-text"><p style="font-size:0.85rem;">Is looking forward to buy your Book</p></div>
                    <div id="interested-book">
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
            console.log(jsphoto);
            console.log(jsphotoid);
            for(let i=0;i<jsphoto.length;i++){
                let jsupload=document.getElementById("book-"+jsphotoid[i]);
                console.log(jsupload);
                jsupload.style.backgroundImage="url('Uploads/"+jsphoto[i]+"')";
                jsupload.style.backgroundSize="280px 325px";    
                if(jssoldphoto[i]==true){
                    jsupload.innerHTML="<img src='Images/sold-rubber-stamp-free-png.webp' height='320px' width='280px'>";
                }
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

            // Remove a Book
            let removebookbtn=document.getElementsByClassName("remove-book");
            for(let i=0; i<removebookbtn.length;i++){
                removebookbtn[i].addEventListener("click",function() {
                    let jsbookid=removebookbtn[i].getAttribute("id");
                    console.log("Book id to remove:"+jsbookid);
                    let jsObject={};
                    jsObject.id=jsbookid;
                    $.ajax({
                        url:"removeBook.php",
                        method:"POST",
                        data:{ jsObject: JSON.stringify(jsObject)},
                        success:function(response){
                            console.log(response);
                        }
                    });
                    setTimeout(function(){
                        location.reload()},2500);
                });
            }

            // Edit Book Details
            let editbookbtn=document.getElementsByClassName("edit-book");
            for(let i=0; i<editbookbtn.length;i++){
                editbookbtn[i].addEventListener("click",function() {
                    let jsbookid=editbookbtn[i].getAttribute("id");
                    console.log("Book id to edit:"+jsbookid);
                    let newjsbookid = jsbookid.substring(0, jsbookid.length - 1);
                    console.log("Book id to edit:"+newjsbookid);
                    window.location.href = "editBook.php?id="+newjsbookid;
                });
            }

            // Upload Notification Pics
            let jsSmallPhoto=<?php echo json_encode($arr4); ?>;
            console.log(jsSmallPhoto);
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

            // Notification Click Event
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
            console.log(myVariable);   
            if(myVariable=='y'){
                alert("You Have No Messages Yet");
                var urlParams = new URLSearchParams(window.location.search);
                urlParams.delete('noMessages');
                window.history.replaceState({}, '', `${window.location.pathname}?${urlParams}`);
            }  
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</HTML>