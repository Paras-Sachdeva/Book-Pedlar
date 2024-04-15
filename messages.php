<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Pedlar - Messages</title>
    <link rel="icon" href="Images/Icon.png" type="image/x-icon">
    <link rel="stylesheet" href="Styles/styles.css?v=25">
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
        echo("</div>");  // Header Div

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
        $count=mysqli_num_rows($result1);
        if($count==0){
            header("Location: dashboard.php?noMessages=y");
        }
    ?>
    <div class='search-results'>
        MESSAGES
    </div>   
        <div class="message-container">
            <div class="message-ppl">
                <div class="message-search-ppl">
                    <div class="message-search-container">
                        <div class="message-search-icon"  id="search-chat-icon">
                            <i class="fa-solid fa-magnifying-glass search-ppl-icon" title="Search"></i>
                        </div>
                        <div class="message-search">
                            <form action="messageSearchResults.php" method="POST" id="message-search-form">
                                <input type="text" name="messageSearchInput" placeholder="Search" id="message-search-input" autocomplete="off">
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
            $recieverId=$_GET['id'];
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
                $recieverId=$row6['id'];
            }
        }
        while($row1=mysqli_fetch_array($result1)){
            $sql2="SELECT * FROM user_data WHERE id=$row1[user_id]";
            $result2=mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_assoc($result2);
            array_push($arr1,$row2['profileImage']);
            array_push($arr3,$row2['id']);
    ?>
                <div class="message-ppl-list" id="<?php echo($row2['id']); ?>">
                    <div class="message-ppl-pic" id="<?php echo($j.'1'); ?>"></div>
                    <div class="message-ppl-name" id="<?php echo($j.'2'); ?>"><?php echo($row2['username']); ?></div>
                </div>
    <?php
            $j++;
        }
        $sql7="SELECT * FROM user_chat WHERE (senderid=(SELECT id FROM user_data WHERE username='$arr2[0]') && recieverid=$userid) || (senderid=$userid && recieverid=(SELECT id FROM user_data WHERE username='$arr2[0]'))";
        $result7=mysqli_query($conn,$sql7);
    ?>
            </div>
            <div class="message-box">
                <div class="message-current-info">
                    <div id="message-current-pic"></div>
                    <div id="message-current-name"></div>
                </div>
                <div class="message-box-content" id="messageContent">
                    <div id="scroll-messages">
    <?php
        $i=0;
        $countS=0;
        $countR=0;
        $arr5=array();
        while($row7=mysqli_fetch_assoc($result7)){
            $sql8="SELECT * FROM user_data WHERE id='$row7[senderid]'";
            $result8=mysqli_query($conn,$sql8);
            $row8=mysqli_fetch_assoc($result8);
            $originalDate = $row7['chatTime'];
            $newDate = date("d-m-Y", strtotime($originalDate));
            $originalTime = strtotime($row7['chatTime']);
            $newTime = date("h:i A", $originalTime);
            if($row7['senderid']==$userid){
                echo("<div class='message-box-display-sender'>
                            <div class='message-outer-sender'>
                              <div class='sender-name' id='s-$i-1'>$row8[username]</div>
                              <div class='message-content' id='s-$i-2'>$row7[message]</div>
                              <div class='timestamp' id='s-$i-3'><br>$newDate $newTime</div>
                            </div>
                        </div>");
                $countS++;
                array_push($arr5,$i);
            }else{
                echo("<div class='message-box-display-reciever'>
                            <div class='message-outer-reciever'>
                              <div class='sender-name' id='r-$i-1'>$row8[username]</div>
                              <div class='message-content' id='r-$i-2'>$row7[message]</div>
                              <div class='timestamp' id='r-$i-3'><br>$newDate $newTime</div>
                            </div>
                        </div>");
                $countR++;
            }
            $i++;
        }
        $cS=$countS;
        $cR=$countR;
    ?>
                    </div>
                    <div class="message-box-textarea" id="messageTextArea">
                        <div class="message-textarea">
                            <i class="fa-solid fa-paper-plane send-icon" id="send-message"></i>
                                <input type="text" name="messageInput" placeholder="Type Here..." autocomplete="off" id="message-input-box">
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
            // Context Menu
            messagePplList[i].addEventListener('contextmenu', function(event) {
                event.preventDefault(); // Prevent the default context menu
            
                // Create a context menu
                let contextMenu = document.createElement('div');
                contextMenu.innerHTML = `
                    <div id='delete-user-chat'>
                        <p>Delete Chat</p>
                    </div>
                    <div id='block-user'>
                        <p>Block User</p>
                    </div>
                    <div id='follow-user'">
                        <p>Follow User</p>
                    </div>
                `;

                contextMenu.style.position = 'absolute';
                contextMenu.style.top = `${event.clientY}px`;
                contextMenu.style.left = `${event.clientX}px`;

                // Close the context menu when clicking outside of it
                document.addEventListener('click', function(e) {
                    if (!contextMenu.contains(e.target) && e.target !== messagePplList[i]) {
                        contextMenu.remove();
                    }
                });
                
                // Append the context menu to the body
                document.body.appendChild(contextMenu);
            });

            // User Click
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

        // Styling Messages
        let jsSenderMessages=<?php echo json_encode($cS); ?>;
        let jsRecieverMessages=<?php echo json_encode($cR); ?>;
        let jsSenderPosition=<?php echo json_encode($arr5); ?>;
        for(let i=0,j=0;i<(jsSenderMessages+jsRecieverMessages);i++){
            if(i==jsSenderPosition[j]){
                let sendername=document.getElementById("s-"+i+"-1");
                let senderMessage=document.getElementById("s-"+i+"-2");
                let senderTimeStamp=document.getElementById("s-"+i+"-3");
                sendername.style.fontWeight="bold";
                sendername.style.marginBottom="5px";
                senderTimeStamp.style.fontSize="0.8em";
                senderTimeStamp.style.color="#888";
                j++;
            }else{
                let recievername=document.getElementById("r-"+i+"-1");
                let recieverMessage=document.getElementById("r-"+i+"-2");
                let recieverTimeStamp=document.getElementById("r-"+i+"-3");
                recievername.style.fontWeight="bold";
                recievername.style.marginBottom="5px";
                recieverTimeStamp.style.fontSize="0.8em";
                recieverTimeStamp.style.color="#888";
            }
        }

        // Send Message 
        let sendMessage=document.getElementById("send-message");
        let inputBox=document.getElementById("message-input-box");
        sendMessage.addEventListener("click",function(){
            let text1=inputBox.value;
            let str =text1;
            let replacedStr0 = str.replace(/'/g, "''");
            let replacedStr1 = replacedStr0.replace(/</g, "&lt;");
            let replacedStr = replacedStr1.replace(/>/g, "&gt;");
            let text = replacedStr.trim();
            let senderid = <?php echo json_encode($userid); ?>;
            let recieverId = <?php echo json_encode($recieverId); ?>;
            if(text!=""){
                let jsMessageObject={};
                jsMessageObject.senderid=senderid;
                jsMessageObject.recieverid=recieverId;
                jsMessageObject.message=text;
                $.ajax({
                    url:"addMessage.php",
                    method:"POST",
                    data:{ jsMessageObject: JSON.stringify(jsMessageObject)},
                    success:function(response){
                        console.log(response);
                    }
                });
                sessionStorage.setItem('scrollPosition', window.scrollY);
                window.location.reload();
            }
        });
        inputBox.addEventListener("keypress",function(event){
            if (event.key === 'Enter') {
                let text1=inputBox.value;
                let str =text1;
                let replacedStr0 = str.replace(/'/g, "''");
                let replacedStr1 = replacedStr0.replace(/</g, "&lt;");
                let replacedStr = replacedStr1.replace(/>/g, "&gt;");
                let text = replacedStr.trim();
                let senderid = <?php echo json_encode($userid); ?>;
                let recieverId = <?php echo json_encode($recieverId); ?>;
                if(text!=""){
                    let jsMessageObject={};
                    jsMessageObject.senderid=senderid;
                    jsMessageObject.recieverid=recieverId;
                    jsMessageObject.message=text;
                    $.ajax({
                        url:"addMessage.php",
                        method:"POST",
                        data:{ jsMessageObject: JSON.stringify(jsMessageObject)},
                        success:function(response){
                            console.log(response);
                        }
                    });
                    sessionStorage.setItem('scrollPosition', window.scrollY);
                    window.location.reload();
                }
            }
        });

        // Scroll to where the User left
        window.onload = function() {
            var scrollPosition = sessionStorage.getItem('scrollPosition');
            console.log(scrollPosition);
            setTimeout(() => {
                if (scrollPosition !== null) {
                    window.scrollTo(0, scrollPosition);
                    sessionStorage.removeItem('scrollPosition');
                } 
                var elem = document.getElementById('scroll-messages');
                elem.scrollTop = elem.scrollHeight;
            }, 1000);
        };

        // Darken Selected User
        let recieverId = <?php echo json_encode($recieverId); ?>;
        let selUserEle=document.getElementById(recieverId);
        console.log(selUserEle);
        selUserEle.style.backgroundColor="rgb(202, 197, 197)";

        // Search User chat
        let searchIconClick=document.getElementById("search-chat-icon");
            searchIconClick.addEventListener("click",function(){
                console.log("Search Icon is clicked");
                let FormData=document.getElementById("message-search-form");
                FormData.submit();
            });

        // Alert for Search Fail
        var queryParams = new URLSearchParams(window.location.search);
        var myVariable = queryParams.get('notFound');
        var myVariable2 = queryParams.get('name');
        if(myVariable=='y'){
            alert("No Chat Found with User '"+myVariable2+"'");
            var urlParams = new URLSearchParams(window.location.search);
            urlParams.delete('noMessages');
            window.history.replaceState({}, '', `${window.location.pathname}?${urlParams}`);
        }  
    </script>
    <script src="JS/script.js"></script>    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</HTML>