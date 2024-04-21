<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Pedlar - Feed</title>
    <link rel="icon" href="Images/Icon.png" type="image/x-icon">
    <link rel="stylesheet" href="Styles/styles.css?v=37">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
        <?php
            require("./Components/loader.php");  //Loader Component

            echo('<div class="content">');
    
            require("./Components/header.php");  //Header Component

            // <!-- Navigation List -->
            echo("<div class='navList'>
                        <a href='index.php' class='linkAni'>Home</a>
                        <a href='dashboard.php' class='linkAni'>Profile</a>
                        <a href='addBook.php' class='linkAni'>Add Book</a>
                        <a href='messages.php' class='linkAni'>Messages</a>
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

            $feed_sql1="SELECT * FROM user_follow WHERE userid=$userid";
            $feed_result1=mysqli_query($conn,$feed_sql1);
            $feed_count1=mysqli_num_rows($feed_result1);
            if($feed_count1==0){
                header("Location: dashboard.php?noFeed=Y");
            }
            while($feed_row1=mysqli_fetch_assoc($feed_result1)){
                if($feed_count1>1){
                    $whereClause.="userid=$feed_row1[followingid] OR ";
                    $feed_count1--;
                }else{
                    $whereClause.="userid=$feed_row1[followingid]";
                    $feed_count1--;
                }
            }
            $feed_sql2="SELECT * FROM book_data WHERE $whereClause";
            $feed_result2=mysqli_query($conn,$feed_sql2);

            echo("<div class='search-results' style='margin-top: 7rem;'>FEED</div>");
        ?> 
        <?php
            echo("<div class='outside-all-books'>");
            $feed_arr1=array();
            $feed_arr2=array();
            $feed_arr3=array();
            while($feed_row2=mysqli_fetch_assoc($feed_result2)){
                $feed_sql3="SELECT * FROM user_data WHERE id=$feed_row2[userid]";
                $feed_result3=mysqli_query($conn,$feed_sql3);
                $feed_row3=mysqli_fetch_assoc($feed_result3);
                $feed_discount2=(int)((($feed_row2['actualprice']-$feed_row2['sellprice'])/$feed_row2['actualprice'])*100);
                array_push($feed_arr1,$feed_row2['id']);
                array_push($feed_arr2,"uploads/".$feed_row2['photo']);
                if($feed_row2['bookstatus']=="Available"){
                    array_push($feed_arr3,false);
                }else{
                    array_push($feed_arr3,true);
                }
                echo("<div class='book-outer' id='book-outer-$feed_row2[id]'>
                            <div class='book-inner1' id='book-$feed_row2[id]'></div>
                            <div class='book-inner2'>
                                <div class='heading-book' style='text-align:center;'>
                                    <b>\"$feed_row2[bookname]\"</b>
                                </div>
                                <div class='details-book'>
                                    <h5>Author</h5> $feed_row2[author]<br><br>
                                    <h5>Genre</h5> $feed_row2[genre]<br><br>
                                    <h5>Added By</h5> $feed_row3[username]<br>
                                </div>
                                <div class='price-book'>
                                    <h2>&#x20b9;$feed_row2[actualprice]</h2><br>
                                    <h6>&#x20b9;$feed_row2[sellprice]</h6>
                                    <h4 style='color:green;'>$feed_discount2%</h4><h4>off</h4>
                                </div> 
                            </div>
                        </div>");
            }
            mysqli_close($conn);
            echo("</div>");
            require("./Components/footer.php");
            echo("</div>");
        ?>
    <script src="JS/script.js"></script>
    <script>
        // Display Book Pics
        let jsBookId=<?php echo json_encode($feed_arr1); ?>;
        let jsBookPhoto=<?php echo json_encode($feed_arr2); ?>;
        console.log(jsBookPhoto);
        let jsSoldBook=<?php echo json_encode($feed_arr3); ?>;
        for(let i=0;i<jsBookId.length;i++){
            let divInner1=document.getElementById("book-"+jsBookId[i]);
            divInner1.style.backgroundImage="url('"+jsBookPhoto[i]+"')";
            divInner1.style.backgroundSize="280px 325px";    
            let clickableDiv=document.getElementById("book-outer-"+jsBookId[i]);
            if(jsSoldBook[i]==true){
                divInner1.innerHTML="<img src='Images/sold-rubber-stamp-free-png.webp' height='320px' width='280px'>";
                clickableDiv.addEventListener("click",function(){
                    alert("Sorry, this book has been sold");
            });
            }else{
                clickableDiv.addEventListener("click",function(){
                        window.location.href = "FullBookInfo.php?book_id="+jsBookId[i]+"&again=0";
                });
            }
        }
    </script>
</body>
</HTML>