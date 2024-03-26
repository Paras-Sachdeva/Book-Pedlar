<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Pedlar - Messages</title>
    <link rel="icon" href="Images/Icon.png" type="image/x-icon">
    <link rel="stylesheet" href="Styles/styles.css?v=7">
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
                    <a href='addBook.php' class='linkAni'>Add Book</a>
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

        $sql1="SELECT DISTINCT user_id
            FROM (
                SELECT senderid AS user_id
                FROM user_chat WHERE recieverid=$userid
                UNION
                SELECT recieverid AS user_id
                FROM user_chat WHERE senderid=$userid
            ) AS unique_users";
        $result1=mysqli_query($conn,$sql1);
    ?>
    <div class='search-results'>
        MESSAGES
    </div>   
        <div class="message-container">
            <div class="message-ppl">
                <div class="message-search-ppl">
                    <div class="message-search-container">
                        <div class="message-search-icon">
                            <i class="fa-solid fa-magnifying-glass search-ppl-icon" title="Search"></i>
                        </div>
                        <div class="message-search">
                            <form action="" method="POST">
                                <input type="text" placeholder="Search" id="message-search-input">
                            </form>
                        </div>
                    </div>
                </div>
    <?php 
        $j=0;
        $arr1=array();
        $arr2=array();
        $arr3=array();
        $arr4=array();
        if(isset($_GET['id'])){
            $sql4="SELECT * FROM user_data WHERE id=$_GET[id]";
            $result4=mysqli_query($conn,$sql4);
            $row4=mysqli_fetch_assoc($result4);
            array_push($arr4,$row4['profileImage']);
            array_push($arr2,$row4['username']);
        }else{
            for($k=1;$k<2;$k++){
                $sql5="SELECT DISTINCT user_id
                        FROM (
                            SELECT senderid AS user_id
                            FROM user_chat WHERE recieverid=$userid
                            UNION
                            SELECT recieverid AS user_id
                            FROM user_chat WHERE senderid=$userid
                        ) AS unique_users LIMIT 1";
                $result5=mysqli_query($conn,$sql5);
                $row5=mysqli_fetch_assoc($result5);
                $sql6="SELECT * FROM user_data WHERE id=$row5[user_id]";
                $result6=mysqli_query($conn,$sql6);
                $row6=mysqli_fetch_assoc($result6);
                array_push($arr4,$row6['profileImage']);
                array_push($arr2,$row6['username']);
            }
        }
        while($row1=mysqli_fetch_array($result1)){
            $sql2="SELECT * FROM user_data WHERE id=$row1[user_id]";
            $result2=mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_assoc($result2);
            array_push($arr1,$row2['profileImage']);
            array_push($arr3,$row2['id']);
    ?>
                <div class="message-ppl-list">
                    <div class="message-ppl-pic" id="<?php echo($j.'1'); ?>"></div>
                    <div class="message-ppl-name" id="<?php echo($j.'2'); ?>"><?php echo($row2['username']); ?></div>
                </div>
    <?php
            $j++;
        }
        $sql7="SELECT * FROM user_chat WHERE (senderid=(SELECT id FROM user_data WHERE username='$arr2[0]') && recieverid=$userid) || (senderid=$userid && recieverid=(SELECT id FROM user_data WHERE username='$arr2[0]'))";
        $result7=mysqli_query($conn,$sql7);
        while($row7=mysqli_fetch_assoc($result7)){
            // echo($row7['message']);
        }
    ?>
            </div>
            <div class="message-box">
                <div class="message-current-info">
                    <div id="message-current-pic"></div>
                    <div id="message-current-name"></div>
                </div>
                <div class="message-box-content">
                    <div class="message-box-display"></div>
                    <div class="message-box-textarea">
                        <div class="message-textarea">
                            <i class="fa-solid fa-paper-plane send-icon"></i>
                            <form action="" method="POST">
                                <input type="text" placeholder="Type Here..." id="message-input-box">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    <?php
        require("./Components/footer.php");
        echo("</div>"); //content div
        mysqli_close($conn);
    ?>

    <script>
        // User Pics in Messages
        let jsSmallPhotos=<?php echo json_encode($arr1); ?>;
        for(let i=0;i<jsSmallPhotos.length;i++){
            let jsSmallPhoto=document.getElementById(i+"1");
            if(jsSmallPhotos[i]!=''){    
                jsSmallPhoto.style.backgroundImage="url('Uploads/"+jsSmallPhotos[i]+"')";
                jsSmallPhoto.style.backgroundSize="56px 56px";
            }else{
                jsSmallPhoto.style.backgroundImage="url('Images/ProfileImg.jpg')";
                jsSmallPhoto.style.backgroundSize="56px 56px";
            }
        }

        // User Click
        let jsUserIds=<?php echo json_encode($arr3); ?>;
        let messagePplList=document.getElementsByClassName("message-ppl-list");
        for(let i=0;i<jsUserIds.length;i++){
            messagePplList[i].addEventListener("click",function(){
                window.location.search = "id=" + encodeURIComponent(jsUserIds[i]);
            });
        }

        // Upload Current User Details & Messages
        let jsUserNames=<?php echo json_encode($arr2); ?>;
        let jsUserPhotos=<?php echo json_encode($arr4); ?>;
        let messageCurrent=document.getElementById("message-current-name");
        let jsBigPhoto=document.getElementById("message-current-pic");
        messageCurrent.innerText=jsUserNames[0];
        if(jsUserPhotos[0]!=''){    
            jsBigPhoto.style.backgroundImage="url('Uploads/"+jsUserPhotos[0]+"')";
            jsBigPhoto.style.border="0.1rem solid black";
            jsBigPhoto.style.backgroundSize="112px 112px";
        }else{
            jsBigPhoto.style.backgroundImage="url('Images/ProfileImg.jpg')";
            jsBigPhoto.style.border="0.1rem solid black";
            jsBigPhoto.style.backgroundSize="112px 112px";
        }
    </script>
    <script src="JS/script.js"></script>    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</HTML>